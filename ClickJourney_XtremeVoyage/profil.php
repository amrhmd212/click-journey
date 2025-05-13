<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}

$file_path = __DIR__ . '/data/users.json';
if (!file_exists($file_path)) {
    die("Erreur : Fichier des utilisateurs introuvable.");
}

$users = json_decode(file_get_contents($file_path), true);
$username = $_SESSION['username'];
$user_data = null;
foreach ($users as $user) {
    if ($user['username'] === $username) {
        $user_data = $user;
        break;
    }
}
if (!$user_data) {
    die("Erreur : Utilisateur introuvable.");
}

$email = $user_data['email'] ?? 'Non défini';
$phone = $user_data['phone'] ?? 'Non défini';
$address = $user_data['address'] ?? 'Non défini';
$vip_status = $user_data['vip_status'] ?? 'Inactif';
$join_date = $user_data['join_date'] ?? 'Janvier 2023';
$profile_picture = $user_data['profile_picture'] ?? 'https://th.bing.com/th/id/OIP.jAJJPOd3jC4EmG8cmmoNugHaHa?rs=1&pid=ImgDetMain';

if ($vip_status === 'Banni') {
    header("Location: banned.php");
    exit();
}


$file_path_transactions = __DIR__ . '/data/transactions.json';
$file_path_users = __DIR__ . '/data/users.json';

if (file_exists($file_path_transactions) && file_exists($file_path_users)) {
    $transactions = json_decode(file_get_contents($file_path_transactions), true);
    $users = json_decode(file_get_contents($file_path_users), true);

    foreach ($transactions as $transaction) {
        if ($transaction['username'] === $username && $transaction['status'] === 'accepted') {
            foreach ($users as &$user) {
                if ($user['username'] === $username) {
                    $user['vip_status'] = 'Actif';
                    break;
                }
            }
            file_put_contents($file_path_users, json_encode($users, JSON_PRETTY_PRINT));
            break;
        }
    }
}

function updateUserFile($file_path, $old_username, $new_data) {
    if (!file_exists($file_path)) {
        error_log("Erreur : Le fichier $file_path n'existe pas");
        return false;
    }
    
    $users = json_decode(file_get_contents($file_path), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("Erreur lors du décodage JSON du fichier $file_path : " . json_last_error_msg());
        return false;
    }
    
    $updated = false;
    foreach ($users as &$user) {
        if ($user['username'] === $old_username) {
            $user['email'] = $new_data['email'] ?? $user['email'];
            $user['username'] = $new_data['username'] ?? $user['username'];
            $user['phone'] = $new_data['phone'] ?? $user['phone'];
            $user['address'] = $new_data['address'] ?? $user['address'];
            $user['vip_status'] = $new_data['vip_status'] ?? $user['vip_status'];
            $updated = true;
            break;
        }
    }
    
    if (!$updated) {
        error_log("Erreur : Utilisateur $old_username non trouvé dans le fichier $file_path");
        return false;
    }
    
    $result = file_put_contents($file_path, json_encode($users, JSON_PRETTY_PRINT));
    if ($result === false) {
        error_log("Erreur lors de l'écriture dans le fichier $file_path");
        return false;
    }
    
    return true;
}

function updateTransactionsFile($file_path, $old_username, $new_username) {
    if (file_exists($file_path)) {
        $transactions = json_decode(file_get_contents($file_path), true);
        foreach ($transactions as &$transaction) {
            if (isset($transaction['username']) && $transaction['username'] === $old_username) {
                $transaction['username'] = $new_username;
            }
        }
        file_put_contents($file_path, json_encode($transactions, JSON_PRETTY_PRINT));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modified_fields'])) {

    $_POST['username'] = preg_replace('/\s+/', '', $_POST['username']);
    $_POST['email'] = preg_replace('/\s+/', '', $_POST['email']);
    $_POST['phone'] = preg_replace('/\s+/', '', $_POST['phone']);


    if (!empty($_POST['phone']) && !preg_match('/^\d+$/', $_POST['phone'])) {
        $_SESSION['error'] = "Le numéro de téléphone doit contenir uniquement des chiffres.";
        header("Location: profil.php");
        exit();
    }

    $modified_fields = $_POST['modified_fields'];
    $old_username = $username;
    $new_data = [];
    $errors = [];

    foreach ($modified_fields as $field) {
        $value = trim($_POST[$field] ?? '');
    
        error_log("Valeur reçue pour le champ 'username' : " . $value);

       
        if (empty($value)) {
            $errors[] = "Le champ 'Nom d'utilisateur' ne peut pas être vide.";
            break;
        }
        
        switch ($field) {
            case 'username':
                if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $value)) {
                    $errors[] = "Nom d'utilisateur invalide (3-20 caractères alphanumériques).";
                    break;
                }
                $new_data['username'] = $value;
                break;

            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Adresse email invalide.";
                    break;
                }
                $new_data['email'] = $value;
                break;

            case 'phone':
                if (!empty($value) && !preg_match('/^\+?[0-9]{10,15}$/', $value)) {
                    $errors[] = "Numéro de téléphone invalide (10-15 chiffres).";
                    break;
                }
                $new_data['phone'] = $value;
                break;

            case 'address':
                if (strlen($value) > 255) {
                    $errors[] = "Adresse trop longue (max 255 caractères).";
                    break;
                }
                $new_data['address'] = $value;
                break;

            case 'vip_status':
                if (!in_array($value, ['Actif', 'Inactif'])) {
                    $errors[] = "Statut VIP invalide.";
                    break;
                }
                $new_data['vip_status'] = $value;
                break;
        }
    }

    $users = json_decode(file_get_contents(__DIR__ . '/data/users.json'), true);

    foreach ($users as $user) {
        if ($user['username'] === $_POST['username'] && $user['username'] !== $username) {
            $_SESSION['error'] = "Ce nom d'utilisateur est déjà pris.";
            header("Location: profil.php");
            exit();
        }
        if ($user['email'] === $_POST['email'] && $user['email'] !== $email) {
            $_SESSION['error'] = "Cette adresse email est déjà utilisée.";
            header("Location: profil.php");
            exit();
        }
        if (!empty($_POST['phone']) && $user['phone'] === $_POST['phone'] && $user['phone'] !== $phone) {
            $_SESSION['error'] = "Ce numéro de téléphone est déjà utilisé.";
            header("Location: profil.php");
            exit();
        }
    }

    if (empty($errors)) {
        $update_success = updateUserFile($file_path, $old_username, $new_data);
        
        if ($update_success) {
            
            if (isset($new_data['username'])) {
                $_SESSION['username'] = $new_data['username'];
                $username = $new_data['username'];
                $transactions_file = __DIR__ . '/data/transactions.json';
                updateTransactionsFile($transactions_file, $old_username, $new_data['username']);
            }
            
            $_SESSION['success'] = "Profil mis à jour avec succès!";
        } else {
            $_SESSION['error'] = "Erreur lors de la mise à jour du profil.";
        }
    } else {
        $_SESSION['error'] = implode("<br>", $errors);
    }
    
    header("Location: profil.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

$transactions_file = __DIR__ . '/data/transactions.json';
$transactions = [];
if (file_exists($transactions_file)) {
    $transactions = json_decode(file_get_contents($transactions_file), true);
}
$user_transactions = array_filter($transactions, function($t) use ($username) {
    return isset($t['username']) && $t['username'] === $username;
});
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="profil.css">
    
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="presentation.php">Présentation</a></li>
                <li><a href="quisommesnous.php">Qui sommes-nous</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li>
                    <a href="?logout" class="login-btn no-effect">Déconnexion</a>
                </li>
                <li><a href="recherche.php"><i class="fas fa-search search-icon"></i></a></li>
            </ul>
        </nav>
        <h1 class="main-title"><span>X</span>treme Voyage</h1>
    </header>

    <h1>Mon Profil</h1>
    <div class="profile-container">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert success">
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert error">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <div class="profile-header">
            <div class="profile-header-info">
                <h2><?php echo htmlspecialchars($username); ?></h2>
                <p>Membre depuis <?php echo htmlspecialchars($join_date); ?></p>
                <?php if (isset($user_data['is_admin']) && $user_data['is_admin'] === true): ?>
                    <a href="admin.php" class="admin-btn">Admin</a>
                <?php endif; ?>
            </div>
            <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Photo de profil">
        </div>
        
        <form id="profileForm" method="POST" action="profil.php">
            <input type="hidden" name="modified_fields[]" value="">
            
            <div class="profile-details">
                <div class="profile-field" data-field="username">
                    <div class="field-info">
                        <h3>Nom d'utilisateur</h3>
                        <span class="field-value"><?php echo htmlspecialchars($username); ?></span>
                        <input type="text" class="profile-input" name="username" value="<?php echo htmlspecialchars($username); ?>" 
                               pattern="[a-zA-Z0-9_]{3,20}" title="3-20 caractères alphanumériques" required>
                    </div>
                    <div class="field-actions">
                        <button type="button" class="edit-btn"><i class="fas fa-pencil-alt"></i></button>
                        <button type="button" class="save-btn"><i class="fas fa-check"></i></button>
                        <button type="button" class="cancel-btn"><i class="fas fa-times"></i></button>
                    </div>
                </div>

                <div class="profile-field" data-field="email">
                    <div class="field-info">
                        <h3>Email</h3>
                        <span class="field-value"><?php echo htmlspecialchars($email); ?></span>
                        <input type="email" class="profile-input" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    <div class="field-actions">
                        <button type="button" class="edit-btn"><i class="fas fa-pencil-alt"></i></button>
                        <button type="button" class="save-btn"><i class="fas fa-check"></i></button>
                        <button type="button" class="cancel-btn"><i class="fas fa-times"></i></button>
                    </div>
                </div>

                <div class="profile-field" data-field="phone">
                    <div class="field-info">
                        <h3>Téléphone</h3>
                        <span class="field-value"><?php echo htmlspecialchars($phone); ?></span>
                        <input type="tel" class="profile-input" name="phone" value="<?php echo htmlspecialchars($phone); ?>" 
                               pattern="\+?[0-9]{10,15}" title="10-15 chiffres">
                    </div>
                    <div class="field-actions">
                        <button type="button" class="edit-btn"><i class="fas fa-pencil-alt"></i></button>
                        <button type="button" class="save-btn"><i class="fas fa-check"></i></button>
                        <button type="button" class="cancel-btn"><i class="fas fa-times"></i></button>
                    </div>
                </div>

                <div class="profile-field" data-field="address">
                    <div class="field-info">
                        <h3>Adresse</h3>
                        <span class="field-value"><?php echo htmlspecialchars($address); ?></span>
                        <input type="text" class="profile-input" name="address" value="<?php echo htmlspecialchars($address); ?>" 
                               maxlength="255">
                    </div>
                    <div class="field-actions">
                        <button type="button" class="edit-btn"><i class="fas fa-pencil-alt"></i></button>
                        <button type="button" class="save-btn"><i class="fas fa-check"></i></button>
                        <button type="button" class="cancel-btn"><i class="fas fa-times"></i></button>
                    </div>
                </div>

                <div class="profile-field" data-field="vip_status">
                    <div class="field-info">
                        <h3>Statut VIP</h3>
                        <span class="field-value"><?php echo htmlspecialchars($vip_status); ?></span>
                    </div>
                    <div class="field-actions">
                        <?php if ($vip_status !== 'Actif'): ?>
                            <a href="carte-paiement.php?montant=50&username=<?php echo urlencode($username); ?>&vip=true" class="vip-btn">Acheter le VIP</a>
                        <?php else: ?>
                            <span class="vip-active">Vous êtes déjà VIP</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="submit-all-btn">Enregistrer les modifications</button>
        </form>
        
        <div class="transactions-section">
            <h2>Historique d'Achat</h2>
            <?php if (!empty($user_transactions)): ?>
                <table class="transactions-table">
                    <thead>
                        <tr>
                            <th>Transaction</th>
                            <th>Montant</th>
                            <th>Vendeur</th>
                            <th>Statut</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user_transactions as $trans): ?>
                            <tr>
                                <td>
                                    <a href="transaction_detail.php?transaction=<?php echo urlencode($trans['transaction'] ?? ''); ?>">
                                        <?php echo htmlspecialchars($trans['transaction'] ?? ''); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($trans['montant'] ?? ''); ?> €</td>
                                <td><?php echo htmlspecialchars($trans['vendeur'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($trans['status'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($trans['date'] ?? ''); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune transaction enregistrée.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>

    
    <script src="js/theme.js"></script>
    <script src="js/profil.js"></script>
</body>
</html>