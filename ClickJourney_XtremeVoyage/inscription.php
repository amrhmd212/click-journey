<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();


$file_path = __DIR__ . '/data/users.json';


if (!file_exists($file_path)) {
    file_put_contents($file_path, '[]');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm-password'] ?? '';
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');


$username = htmlspecialchars($username);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$phone = htmlspecialchars($phone);
$address = htmlspecialchars($address);


if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    $_SESSION['error'] = "Tous les champs obligatoires doivent être remplis.";
    header("Location: inscription.php");
    exit();
}


if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
    $_SESSION['error'] = "Le nom d'utilisateur doit contenir entre 3 et 20 caractères alphanumériques.";
    header("Location: inscription.php");
    exit();
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "L'adresse email n'est pas valide.";
    header("Location: inscription.php");
    exit();
}


if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
    $_SESSION['error'] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.";
    header("Location: inscription.php");
    exit();
}


if ($password !== $confirm_password) {
    $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
    header("Location: inscription.php");
    exit();
}


if (!empty($phone) && !preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
    $_SESSION['error'] = "Le numéro de téléphone est invalide.";
    header("Location: inscription.php");
    exit();
}

if (!empty($address) && strlen($address) > 255) {
    $_SESSION['error'] = "L'adresse est trop longue (255 caractères max).";
    header("Location: inscription.php");
    exit();
}

    $vip_status = 'Inactif'; 
    $join_date = date('Y-m-d'); 
    $profile_picture = 'https://th.bing.com/th/id/OIP.jAJJPOd3jC4EmG8cmmoNugHaHa?rs=1&pid=ImgDetMain';
    $is_admin = false;

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "Tous les champs obligatoires doivent être remplis.";
        header("Location: inscription.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
        header("Location: inscription.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "L'adresse email n'est pas valide.";
        header("Location: inscription.php");
        exit();
    }

    
    $users = json_decode(file_get_contents($file_path), true);

    
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $_SESSION['error'] = "Cette adresse email est déjà utilisée.";
            header("Location: inscription.php");
            exit();
        }
    }

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    if ($hashed_password === false) {
        $_SESSION['error'] = "Erreur lors du hachage du mot de passe.";
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
        $_SESSION['error'] = "Erreur lors de l'enregistrement de l'utilisateur.";
        header("Location: inscription.php");
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

        
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error-message">
                <?php echo htmlspecialchars($_SESSION['error']); ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success-message">
                <?php echo htmlspecialchars($_SESSION['success']); ?>
            </div>
            <?php unset($_SESSION['success']);  ?>
        <?php endif; ?>

        <form action="inscription.php" method="POST">
            <div class="input-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" placeholder="Choisissez votre nom d'utilisateur" required>
            </div>

            <div class="input-group">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" required>
            </div>

            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="input-group">
                <label for="confirm-password">Confirmation du mot de passe</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="••••••••" required>
            </div>

            <div class="input-group">
                <label for="phone">Téléphone</label>
                <input type="text" id="phone" name="phone" placeholder="Entrez votre numéro de téléphone">
            </div>

            <div class="input-group">
                <label for="address">Adresse</label>
                <input type="text" id="address" name="address" placeholder="Entrez votre adresse">
            </div>

            <div class="terms">
                En créant un compte, vous acceptez nos <a href="#">Conditions générales</a> et notre <a href="#">Politique de confidentialité</a>.
            </div>

            <button type="submit">Créer un compte</button>
        </form>

        <div class="login-link">
            Déjà enregistré ? <a href="connexion.php">Se connecter</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
</body>
</html>