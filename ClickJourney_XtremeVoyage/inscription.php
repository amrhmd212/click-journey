<?php
ini_set('display_errors', 1); // Active l'affichage des erreurs
ini_set('display_startup_errors', 1); // Active l'affichage des erreurs au démarrage
error_reporting(E_ALL); // Définit le niveau de rapport d'erreurs

session_start(); // Démarre la session pour gérer les messages d'erreur et de succès

// Récupère les messages d'erreur et de succès depuis la session
$error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';

// Supprime les messages d'erreur et de succès après les avoir récupérés
unset($_SESSION['error']);
unset($_SESSION['success']);

// Chemin vers le fichier JSON contenant les utilisateurs
$file_path = __DIR__ . '/data/users.json';
if (!file_exists($file_path)) { // Si le fichier n'existe pas, il est créé avec un tableau vide
    file_put_contents($file_path, '[]');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si la requête est de type POST
    // Récupération et validation des données du formulaire
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm-password'] ?? '';
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $address = htmlspecialchars(trim($_POST['address'] ?? ''));

    // Définition des valeurs par défaut pour les nouveaux utilisateurs
    $vip_status = isset($_POST['subscribe_vip']) ? 'Actif' : 'Inactif';
    $join_date = date('Y-m-d'); // Date d'inscription
    $profile_picture = 'https://th.bing.com/th/id/OIP.jAJJPOd3jC4EmG8cmmoNugHaHa?rs=1&pid=ImgDetMain'; // Image par défaut
    $is_admin = false; // Par défaut, l'utilisateur n'est pas administrateur

    // Chargement des utilisateurs existants
    $users = json_decode(file_get_contents($file_path), true);

    // Vérification des doublons (email, nom d'utilisateur, téléphone)
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $_SESSION['error'] = "Cette adresse email est déjà utilisée.";
            header("Location: inscription.php");
            exit();
        }
        if ($user['username'] === $username) {
            $_SESSION['error'] = "Ce nom d'utilisateur est déjà pris.";
            header("Location: inscription.php");
            exit();
        }
        if ($user['phone'] === $phone) {
            $_SESSION['error'] = "Ce numéro de téléphone est déjà utilisé.";
            header("Location: inscription.php");
            exit();
        }
    }

    // Cryptage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    if ($hashed_password === false) { // Vérifie si le cryptage a échoué
        header("Location: inscription.php");
        exit();
    }

    // Création d'un nouvel utilisateur
    $new_user = [
        'email' => $email,
        'username' => $username,
        'password' => $hashed_password,
        'phone' => $phone,
        'address' => $address,
        'vip_status' => 'Inactif',
        'join_date' => $join_date,
        'profile_picture' => $profile_picture,
        'is_admin' => $is_admin
    ];

    // Ajout du nouvel utilisateur au tableau des utilisateurs
    $users[] = $new_user;

    // Sauvegarde des utilisateurs dans le fichier JSON
    if (file_put_contents($file_path, json_encode($users, JSON_PRETTY_PRINT)) === false) {
        header("Location: inscription.php");
        exit();
    }

    // Redirection vers la page de paiement si l'utilisateur souscrit au VIP
    if ($vip_status === 'Actif') {
        header("Location: carte-paiement.php?montant=50&username=" . urlencode($username) . "&vip=true");
        exit();
    }

    // Message de succès et redirection vers la page de connexion
    $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
    header("Location: connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Xtreme Voyage</title>
    <!-- Liens vers les polices et les styles -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="inscription.css">
</head>
<body>
    <nav>
        <ul>
            <!-- Menu de navigation -->
            <li><a href="index.php">Accueil</a></li>
            <li><a href="presentation.php">Présentation</a></li>
            <li><a href="quisommesnous.php">Qui sommes-nous</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="connexion.php" class="login-btn no-effect">Connexion</a></li>
            <li><a href="recherche.php"><i class="fas fa-search search-icon"></i></a></li>
        </ul>
    </nav>

    <div class="register-container">
        <h1>Inscription</h1>

        <!-- Affichage des messages d'erreur ou de succès -->
        <?php if (!empty($error)) : ?>
            <div class="error-message" style="color: red;">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)) : ?>
            <div class="success-message">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <div id="form-message" style="margin-bottom: 20px;"></div>

        <!-- Formulaire d'inscription -->
        <form id="register-form" action="inscription.php" method="POST" novalidate>
            <!-- Champ pour le nom d'utilisateur -->
            <div class="input-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required maxlength="30">
                <small id="username-count" class="char-counter"></small>
                <small id="username-error" class="error-message" style="color: red;"></small>
            </div>

            <!-- Champ pour l'adresse email -->
            <div class="input-group">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" required maxlength="50">
                <small id="email-count" class="char-counter"></small>
                <small id="email-error" class="error-message" style="color: red;"></small>
            </div>

            <!-- Champ pour le mot de passe -->
            <div class="input-group" style="position: relative;">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required maxlength="30">
                <i class="fas fa-eye toggle-password" data-target="password"></i>
                <small id="password-count" class="char-counter"></small>
                <small id="password-error" class="error-message" style="color: red;"></small>
            </div>

            <!-- Champ pour la confirmation du mot de passe -->
            <div class="input-group" style="position: relative;">
                <label for="confirm-password">Confirmation du mot de passe</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="••••••••" required maxlength="30">
                <i class="fas fa-eye toggle-password" data-target="confirm-password"></i>
                <small id="confirm-password-count" class="char-counter"></small>
                <small id="confirm-password-error" class="error-message" style="color: red;"></small>
            </div>

            <!-- Champ pour le numéro de téléphone -->
            <div class="input-group">
                <label for="phone">Téléphone</label>
                <input type="text" id="phone" name="phone" placeholder="Entrez votre numéro de téléphone" required maxlength="15">
                <small id="phone-count" class="char-counter"></small>
                <small id="phone-error" class="error-message" style="color: red;"></small>
            </div>

            <!-- Champ pour l'adresse -->
            <div class="input-group">
                <label for="address">Adresse</label>
                <input type="text" id="address" name="address" placeholder="Entrez votre adresse" required maxlength="255">
                <small id="address-count" class="char-counter"></small>
                <small id="address-error" class="error-message" style="color: red;"></small>
            </div>

            <!-- Case pour souscrire au VIP -->
            <div class="input-group">
                <input type="checkbox" id="subscribe_vip" name="subscribe_vip" value="1">
                <label for="subscribe_vip">Souscrire au VIP (50€)</label>
            </div>

            <!-- Bouton pour créer un compte -->
            <button type="submit">Créer un compte</button>
            <div class="terms">
                En créant un compte, vous acceptez nos <a href="#">Conditions générales</a> et notre <a href="#">Politique de confidentialité</a>.
            </div>
        </form>

        <!-- Lien pour se connecter si déjà inscrit -->
        <div class="login-link">
            Déjà enregistré ? <a href="connexion.php">Se connecter</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
    
    <!-- Scripts JavaScript -->
    <script src="js/theme.js"></script>
    <script src="js/inscription.js"></script>
</body>
</html>