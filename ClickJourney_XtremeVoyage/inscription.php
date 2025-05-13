<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';

unset($_SESSION['error']);
unset($_SESSION['success']);


$file_path = __DIR__ . '/data/users.json';
if (!file_exists($file_path)) {
    file_put_contents($file_path, '[]');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm-password'] ?? '';
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $address = htmlspecialchars(trim($_POST['address'] ?? ''));

    $vip_status = isset($_POST['subscribe_vip']) ? 'Actif' : 'Inactif';
    $join_date = date('Y-m-d');
    $profile_picture = 'https://th.bing.com/th/id/OIP.jAJJPOd3jC4EmG8cmmoNugHaHa?rs=1&pid=ImgDetMain';
    $is_admin = false;


    $users = json_decode(file_get_contents($file_path), true);
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            header("Location: inscription.php");
            exit();
        }
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    if ($hashed_password === false) {
        header("Location: inscription.php");
        exit();
    }

    $new_user = [
        'email' => $email,
        'username' => $username,
        'password' => $hashed_password,
        'phone' => $phone,
        'address' => $address,
        'vip_status' => $vip_status,
        'join_date' => $join_date,
        'profile_picture' => $profile_picture,
        'is_admin' => $is_admin
    ];

    $users[] = $new_user;

    if (file_put_contents($file_path, json_encode($users, JSON_PRETTY_PRINT)) === false) {
        header("Location: inscription.php");
        exit();
    }

    if ($vip_status === 'Actif') {
        header("Location: carte-paiement.php?montant=50&username=" . urlencode($username) . "&vip=true");
        exit();
    }

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
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="inscription.css">
</head>
<body>
    <nav>
        <ul>
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


        <form id="register-form" action="inscription.php" method="POST" novalidate>


            <div class="input-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required maxlength="30">
                <small id="username-count" class="char-counter"></small>
                <small id="username-error" class="error-message" style="color: red;"></small>
            </div>


            <div class="input-group">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" required maxlength="50">
                <small id="email-count" class="char-counter"></small>
                <small id="email-error" class="error-message" style="color: red;"></small>
            </div>

            <div class="input-group" style="position: relative;">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required maxlength="30">
                <i class="fas fa-eye toggle-password" data-target="password"></i>

                <small id="password-count" class="char-counter"></small>
                <small id="password-error" class="error-message" style="color: red;"></small>
            </div>

            <div class="input-group" style="position: relative;">
                <label for="password">Confirmation du mot de passe</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="••••••••" required maxlength="30">
                <i class="fas fa-eye toggle-password" data-target="password"></i>

                <small id="confirm-password-count" class="char-counter"></small>
                <small id="confirm-password-error" class="error-message" style="color: red;"></small>
            </div>


            <div class="input-group">
                <label for="phone">Téléphone</label>
                <input type="text" id="phone" name="phone" placeholder="Entrez votre numéro de téléphone" required maxlength="10">
                <small id="phone-count" class="char-counter"></small>
                <small id="phone-error" class="error-message" style="color: red;"></small>
            </div>


            <div class="input-group">
                <label for="address">Adresse</label>
                <input type="text" id="address" name="address" placeholder="Entrez votre adresse" required maxlength="255">
                <small id="address-count" class="char-counter"></small>
                <small id="address-error" class="error-message" style="color: red;"></small>
            </div>

            <div class="input-group">
                <button type="submit" name="subscribe_vip" class="vip-btn">S'inscrire et souscrire au VIP (50€)</button>
            </div>

            <button type="submit">Créer un compte</button>
            <div class="terms">
                En créant un compte, vous acceptez nos <a href="#">Conditions générales</a> et notre <a href="#">Politique de confidentialité</a>.
            </div>
        </form>

        <div class="login-link">
            Déjà enregistré ? <a href="connexion.php">Se connecter</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
    
    <script src="js/theme.js"></script>
    <script src="js/inscription.js"></script>
</body>
</html>