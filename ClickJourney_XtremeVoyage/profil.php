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

function updateUserFile($file_path, $old_username, $new_data) {
    $users = json_decode(file_get_contents($file_path), true);
    foreach ($users as &$user) {
        if ($user['username'] === $old_username) {
            $user['email'] = $new_data['email'] ?? $user['email'];
            $user['username'] = $new_data['username'] ?? $user['username'];
            $user['phone'] = $new_data['phone'] ?? $user['phone'];
            $user['address'] = $new_data['address'] ?? $user['address'];
            $user['vip_status'] = $new_data['vip_status'] ?? $user['vip_status'];
            $user['join_date'] = $new_data['join_date'] ?? $user['join_date'];
            $user['profile_picture'] = $new_data['profile_picture'] ?? $user['profile_picture'];
            break;
        }
    }
    file_put_contents($file_path, json_encode($users, JSON_PRETTY_PRINT));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['field'])) {
    $field = $_POST['field'];
    $new_value = trim($_POST['new_value'] ?? '');
    $old_username = $username;

    switch ($field) {
        case 'username':
            if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $new_value)) {
                $_SESSION['error'] = "Nom d'utilisateur invalide.";
                header("Location: profil.php");
                exit();
            }
            $_SESSION['username'] = $new_value;
            $username = $new_value;
            break;

        case 'email':
            $new_value = filter_var($new_value, FILTER_SANITIZE_EMAIL);
            if (!filter_var($new_value, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Adresse email invalide.";
                header("Location: profil.php");
                exit();
            }
            $_SESSION['email'] = $new_value;
            $email = $new_value;
            break;

        case 'phone':
            if (!empty($new_value) && !preg_match('/^\+?[0-9]{10,15}$/', $new_value)) {
                $_SESSION['error'] = "Téléphone invalide.";
                header("Location: profil.php");
                exit();
            }
            $_SESSION['phone'] = $new_value;
            $phone = $new_value;
            break;

        case 'address':
            if (strlen($new_value) > 255) {
                $_SESSION['error'] = "Adresse trop longue.";
                header("Location: profil.php");
                exit();
            }
            $_SESSION['address'] = $new_value;
            $address = $new_value;
            break;

        case 'vip_status':
            if (!in_array($new_value, ['Actif', 'Inactif'])) {
                $_SESSION['error'] = "Statut VIP invalide.";
                header("Location: profil.php");
                exit();
            }
            $_SESSION['vip_status'] = $new_value;
            $vip_status = $new_value;
            break;
    }

    updateUserFile($file_path, $old_username, [
        'username' => $username,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'vip_status' => $vip_status,
        'join_date' => $join_date,
        'profile_picture' => $profile_picture
    ]);

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
        
        <div class="profile-details">
            <div class="profile-field">
                <div class="field-info">
                    <h3>Nom</h3>
                    <p><?php echo htmlspecialchars($username); ?></p>
                </div>
                <form method="POST" action="profil.php" style="display:inline;">
                    <input class="profile-input" type="text" name="new_value" placeholder="Nouveau nom" required>
                    <input type="hidden" name="field" value="username">
                    <button type="submit" class="edit-btn"><i class="fas fa-pencil-alt"></i></button>
                </form>
            </div>
            <div class="profile-field">
                <div class="field-info">
                    <h3>Email</h3>
                    <p><?php echo htmlspecialchars($email); ?></p>
                </div>
                <form method="POST" action="profil.php" style="display:inline;">
                    <input class="profile-input" type="email" name="new_value" placeholder="Nouvel email" required>
                    <input type="hidden" name="field" value="email">
                    <button type="submit" class="edit-btn"><i class="fas fa-pencil-alt"></i></button>
                </form>
            </div>
            <div class="profile-field">
                <div class="field-info">
                    <h3>Téléphone</h3>
                    <p><?php echo htmlspecialchars($phone); ?></p>
                </div>
                <form method="POST" action="profil.php" style="display:inline;">
                    <input class="profile-input" type="text" name="new_value" placeholder="Nouveau téléphone" required>
                    <input type="hidden" name="field" value="phone">
                    <button type="submit" class="edit-btn"><i class="fas fa-pencil-alt"></i></button>
                </form>
            </div>
            <div class="profile-field">
                <div class="field-info">
                    <h3>Adresse</h3>
                    <p><?php echo htmlspecialchars($address); ?></p>
                </div>
                <form method="POST" action="profil.php" style="display:inline;">
                    <input class="profile-input" type="text" name="new_value" placeholder="Nouvelle adresse" required>
                    <input type="hidden" name="field" value="address">
                    <button type="submit" class="edit-btn"><i class="fas fa-pencil-alt"></i></button>
                </form>
            </div>
            <div class="profile-field">
                <div class="field-info">
                    <h3>Statut VIP</h3>
                    <p><?php echo htmlspecialchars($vip_status); ?></p>
                </div>
                <form method="POST" action="profil.php" style="display:inline;">
                    <input type="hidden" name="field" value="vip_status">
                    <select class="profile-input" name="new_value" required>
                        <option value="Actif" <?php echo ($vip_status === 'Actif') ? 'selected' : ''; ?>>Actif</option>
                        <option value="Inactif" <?php echo ($vip_status === 'Inactif') ? 'selected' : ''; ?>>Inactif</option>
                    </select>
                    <button type="submit" class="edit-btn"><i class="fas fa-pencil-alt"></i></button>
                </form>
            </div>
        </div>
        
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
</body>
</html>