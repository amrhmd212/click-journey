<?php
// Démarrage (ou reprise) de la session afin de suivre l'état de connexion de l'utilisateur
session_start();

// Vérification si l'utilisateur est connecté, sinon redirection vers la page de connexion
if (!isset($_SESSION['username'])) {
    // Si aucune session n'est active pour l'utilisateur, redirige vers la page de connexion
    header("Location: connexion.php");
    exit(); // Arrête l'exécution du script pour éviter tout traitement ultérieur
}

// Définition du chemin vers le fichier JSON contenant les données utilisateurs
$file_path = __DIR__ . '/data/users.json';
if (!file_exists($file_path)) {
    // Si le fichier des utilisateurs n'existe pas, arrête le script avec un message d'erreur
    die("Erreur : Fichier des utilisateurs introuvable.");
}

// Lecture et décodage du fichier JSON pour récupérer le tableau des utilisateurs
$users = json_decode(file_get_contents($file_path), true);

// Récupération du nom d'utilisateur depuis la session
$username = $_SESSION['username'];
$user_data = null;
// Boucle pour trouver les données correspondant à l'utilisateur connecté
foreach ($users as $user) {
    if ($user['username'] === $username) {
        // Si une correspondance est trouvée, on stocke les données de l'utilisateur
        $user_data = $user;
        break;
    }
}
// Si aucune donnée n'est trouvée pour cet utilisateur, on arrête le script avec un message d'erreur
if (!$user_data) {
    die("Erreur : Utilisateur introuvable.");
}

// Extraction des informations essentielles de l'utilisateur avec des valeurs par défaut
$email = $user_data['email'] ?? 'Non défini'; // Email de l'utilisateur ou "Non défini" si absent
$phone = $user_data['phone'] ?? 'Non défini'; // Téléphone de l'utilisateur ou "Non défini" si absent
$address = $user_data['address'] ?? 'Non défini'; // Adresse de l'utilisateur ou "Non défini" si absente
$vip_status = $user_data['vip_status'] ?? 'Inactif'; // Statut VIP de l'utilisateur ou "Inactif" par défaut
$join_date = $user_data['join_date'] ?? 'Janvier 2023'; // Date d'inscription ou valeur par défaut
$profile_picture = $user_data['profile_picture'] ?? 'https://th.bing.com/th/id/OIP.jAJJPOd3jC4EmG8cmmoNugHaHa?rs=1&pid=ImgDetMain'; // Photo de profil par défaut

// Redirection immédiate si l'utilisateur est banni
if ($vip_status === 'Banni') {
    // Si le statut VIP est "Banni", redirige vers une page dédiée
    header("Location: banned.php");
    exit();
}

// Définition des chemins pour les fichiers de transactions et utilisateurs
$file_path_transactions = __DIR__ . '/data/transactions.json';
$file_path_users = __DIR__ . '/data/users.json';

if (file_exists($file_path_transactions) && file_exists($file_path_users)) {
    // Si les fichiers de transactions et utilisateurs existent, on les lit et les décode
    $transactions = json_decode(file_get_contents($file_path_transactions), true);
    $users = json_decode(file_get_contents($file_path_users), true);

    foreach ($transactions as $transaction) {
        // Vérifie que la transaction concerne l'utilisateur, est acceptée et de type 'vip'
        if ($transaction['username'] === $username && $transaction['status'] === 'accepted' && $transaction['type'] === 'vip') {
            foreach ($users as &$user) {
                if ($user['username'] === $username) {
                    // Si une transaction VIP acceptée est trouvée, on active le statut VIP de l'utilisateur
                    $user['vip_status'] = 'Actif';
                    break;
                }
            }
            // Mise à jour du fichier des utilisateurs avec les nouvelles données
            file_put_contents($file_path_users, json_encode($users, JSON_PRETTY_PRINT));
            break;
        }
    }
}

// Fonction qui met à jour le fichier des utilisateurs en fonction des nouvelles données
function updateUserFile($file_path, $old_username, $new_data) {
    if (!file_exists($file_path)) {
        // Si le fichier n'existe pas, on enregistre une erreur dans les logs
        error_log("Erreur : Le fichier $file_path n'existe pas");
        return false;
    }
    
    $users = json_decode(file_get_contents($file_path), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        // Si une erreur survient lors du décodage JSON, on enregistre l'erreur
        error_log("Erreur lors du décodage JSON du fichier $file_path : " . json_last_error_msg());
        return false;
    }
    
    $updated = false;
    foreach ($users as &$user) {
        if ($user['username'] === $old_username) {
            // Mise à jour sécurisée des données, en utilisant la valeur actuelle si aucune nouvelle donnée n'est fournie
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
        // Si l'utilisateur n'est pas trouvé, on enregistre une erreur
        error_log("Erreur : Utilisateur $old_username non trouvé dans le fichier $file_path");
        return false;
    }
    
    $result = file_put_contents($file_path, json_encode($users, JSON_PRETTY_PRINT));
    if ($result === false) {
        // Si une erreur survient lors de l'écriture dans le fichier, on enregistre une erreur
        error_log("Erreur lors de l'écriture dans le fichier $file_path");
        return false;
    }
    
    return true; // Retourne true si la mise à jour est réussie
}

// Fonction qui met à jour le nom d'utilisateur dans le fichier des transactions
function updateTransactionsFile($file_path, $old_username, $new_username) {
    if (file_exists($file_path)) {
        // Si le fichier des transactions existe, on le lit et le décode
        $transactions = json_decode(file_get_contents($file_path), true);
        foreach ($transactions as &$transaction) {
            if (isset($transaction['username']) && $transaction['username'] === $old_username) {
                // Mise à jour du nom d'utilisateur dans chaque transaction correspondante
                $transaction['username'] = $new_username;
            }
        }
        // Mise à jour du fichier des transactions avec les nouvelles données
        file_put_contents($file_path, json_encode($transactions, JSON_PRETTY_PRINT));
    }
}

// Traitement du formulaire de modification du profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modified_fields'])) {

    // Suppression des espaces pour uniformiser les données des champs critiques
    $_POST['username'] = preg_replace('/\s+/', '', $_POST['username']);
    $_POST['email'] = preg_replace('/\s+/', '', $_POST['email']);
    $_POST['phone'] = preg_replace('/\s+/', '', $_POST['phone']);

    // Validation du numéro de téléphone pour qu'il ne contienne que des chiffres
    if (!empty($_POST['phone']) && !preg_match('/^\d+$/', $_POST['phone'])) {
        $_SESSION['error'] = "Le numéro de téléphone doit contenir uniquement des chiffres.";
        header("Location: profil.php");
        exit();
    }

    $modified_fields = $_POST['modified_fields'];
    $old_username = $username;
    $new_data = [];
    $errors = [];

    // Pour chaque champ modifié, validation et préparation des nouvelles valeurs
    foreach ($modified_fields as $field) {
        $value = trim($_POST[$field] ?? '');
        error_log("Valeur reçue pour le champ '$field' : " . $value);
       
        if (empty($value)) {
            $errors[] = "Le champ '$field' ne peut pas être vide.";
            break;
        }
        
        // Adaptation de la validation en fonction du champ
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

    // Rechargement du fichier des utilisateurs pour vérifier l'unicité des données
    $users = json_decode(file_get_contents(__DIR__ . '/data/users.json'), true);
    foreach ($users as $user) {
        if ($user['username'] === $_POST['username'] && $user['username'] !== $username) {
            $_SESSION['error'] = "Ce nom d'utilisateur est déjà pris.";
            header("Location: profil.php");
            exit();
        }
        if ($user['email'] === $_POST['email'] && $user['email'] !== $email) {
            // Vérifie si l'email soumis par l'utilisateur existe déjà dans le fichier des utilisateurs
            // et qu'il ne correspond pas à l'email actuel de l'utilisateur connecté.
            // Si c'est le cas, une erreur est enregistrée dans la session et l'utilisateur est redirigé.
            $_SESSION['error'] = "Cette adresse email est déjà utilisée.";
            header("Location: profil.php");
            exit(); // Arrête l'exécution pour éviter tout traitement supplémentaire
        }
        if (!empty($_POST['phone']) && $user['phone'] === $_POST['phone'] && $user['phone'] !== $phone) {
            // Vérifie si le numéro de téléphone soumis par l'utilisateur existe déjà dans le fichier des utilisateurs
            // et qu'il ne correspond pas au numéro de téléphone actuel de l'utilisateur connecté.
            // Si c'est le cas, une erreur est enregistrée dans la session et l'utilisateur est redirigé.
            $_SESSION['error'] = "Ce numéro de téléphone est déjà utilisé.";
            header("Location: profil.php");
            exit(); // Arrête l'exécution pour éviter tout traitement supplémentaire
        }
    }

    // Si aucune erreur n'est survenue, mise à jour des données de l'utilisateur
    if (empty($errors)) {
        // Appelle la fonction pour mettre à jour les données de l'utilisateur dans le fichier JSON
        $update_success = updateUserFile($file_path, $old_username, $new_data);
        
        if ($update_success) {
            // Si la mise à jour est réussie, on vérifie si le nom d'utilisateur a été modifié
            if (isset($new_data['username'])) {
                // Met à jour le nom d'utilisateur dans la session pour refléter le changement
                $_SESSION['username'] = $new_data['username'];
                $username = $new_data['username'];
                
                // Met également à jour le nom d'utilisateur dans le fichier des transactions
                $transactions_file = __DIR__ . '/data/transactions.json';
                updateTransactionsFile($transactions_file, $old_username, $new_data['username']);
            }
            // Enregistre un message de succès dans la session
            $_SESSION['success'] = "Profil mis à jour avec succès!";
        } else {
            // Si la mise à jour échoue, on enregistre un message d'erreur dans la session
            $_SESSION['error'] = "Erreur lors de la mise à jour du profil.";
        }
    } else {
        // Si des erreurs ont été détectées, on les enregistre dans la session sous forme de message
        $_SESSION['error'] = implode("<br>", $errors);
    }
    
    // Redirige l'utilisateur vers la page de profil après le traitement
    header("Location: profil.php");
    exit(); // Arrête l'exécution pour éviter tout traitement supplémentaire
}

// Gestion de la déconnexion de l'utilisateur
if (isset($_GET['logout'])) {
    // Si le paramètre "logout" est présent dans l'URL, détruit la session actuelle
    session_destroy();
    // Redirige l'utilisateur vers la page d'accueil
    header("Location: index.php");
    exit(); // Arrête l'exécution pour éviter tout traitement ultérieur
}

// Chargement des transactions correspondant à l'utilisateur
$transactions_file = __DIR__ . '/data/transactions.json';
$transactions = []; // Initialise un tableau vide pour les transactions
if (file_exists($transactions_file)) {
    // Si le fichier des transactions existe, le lit et le décode en tableau associatif
    $transactions = json_decode(file_get_contents($transactions_file), true);
}
$user_transactions = array_filter($transactions, function($t) use ($username) {
    return isset($t['username']) && $t['username'] === $username;
});
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Configuration d'encodage, viewport et titre de la page -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Xtreme Voyage</title>
    <!-- Inclusion des polices et icônes externes -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="profil.css">
    <!-- ...existing head code... -->
</head>
<body>
    <header>
        <!-- Barre de navigation principale -->
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
        <!-- Titre principal du site -->
        <h1 class="main-title"><span>X</span>treme Voyage</h1>
    </header>

    <h1>Mon Profil</h1>
    <div class="profile-container">
        <!-- Message de succès éventuel -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert success">
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <!-- Message d'erreur éventuel -->
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
                <!-- Affichage du nom de l'utilisateur et de la date d'inscription -->
                <h2><?php echo htmlspecialchars($username); ?></h2>
                <p>Membre depuis <?php echo htmlspecialchars($join_date); ?></p>
                <?php if (isset($user_data['is_admin']) && $user_data['is_admin'] === true): ?>
                    <a href="admin.php" class="admin-btn">Admin</a>
                <?php endif; ?>
            </div>
            <!-- Affichage de la photo de profil -->
            <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Photo de profil">
        </div>
        
        <!-- Formulaire de mise à jour du profil -->
        <form id="profileForm" method="POST" action="profil.php">
            <!-- Champ caché pour stocker les champs modifiés -->
            <input type="hidden" name="modified_fields[]" value="">
            
            <div class="profile-details">
                <!-- Champ de modification du nom d'utilisateur avec support d'édition inline -->
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

                <!-- Champ de modification de l'email -->
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

                <!-- Champ de modification du téléphone -->
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

                <!-- Champ de modification de l'adresse -->
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

                <!-- Affichage du statut VIP avec éventuel lien pour l'achat -->
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
        
        <!-- Section affichant l'historique des transactions de l'utilisateur -->
        <div class="transactions-section">
            <h2>Historique d'Achat</h2>
            <?php if (!empty($user_transactions)): ?>
                <!-- Si l'utilisateur a des transactions, affiche un tableau avec les détails -->
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
                                    <?php if ($trans['type']=='vip'): ?>
                                        <!-- Si la transaction est de type VIP, redirige vers une page spécifique -->
                                        <a href="transaction_detail_vip.php?transaction=<?php echo urlencode($trans['transaction'] ?? ''); ?>">
                                        <?php echo htmlspecialchars($trans['transaction'] ?? ''); ?>
                                        </a>
                                    <?php else: ?>
                                        <!-- Sinon, redirige vers une page générique de détail de transaction -->
                                        <a href="transaction_detail.php?transaction=<?php echo urlencode($trans['transaction'] ?? ''); ?>">
                                            <?php echo htmlspecialchars($trans['transaction'] ?? ''); ?>
                                        </a>
                                    <?php endif; ?>
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
                <!-- Si aucune transaction n'est trouvée, affiche un message informatif -->
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