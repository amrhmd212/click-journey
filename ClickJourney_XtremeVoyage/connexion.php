<?php
session_start();

$error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';

unset($_SESSION['error']);
unset($_SESSION['success']);

$file_path = __DIR__ . '/data/users.json';
if (!file_exists($file_path)) {
    die("Erreur : Fichier des utilisateurs introuvable.");
}

$users = json_decode(file_get_contents($file_path), true);
$username = $_SESSION['username'] ?? null;

foreach ($users as $user) {
    if ($user['username'] === $username && $user['vip_status'] === 'Banni') {
        header("Location: banned.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="connexion.css"> 
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

    <div class="login-container">
        <h1>Connexion</h1>

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

        <form id="login-form" action="login.php" method="POST" novalidate>
            <div class="input-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required maxlength="30">
                <small id="username-count" class="char-counter"></small>
                <small id="username-error" class="error-message" style="color: red;"></small>
            </div>

            <div class="input-group">
                <label for="password">Mot de passe</label>

                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="••••••••" required maxlength="30">
                    <i class="fas fa-eye toggle-password" data-target="password"></i>
                </div>

                <small id="password-count" class="char-counter"></small>
                <small id="password-error" class="error-message" style="color: red;"></small>
            </div>


            <button type="submit">Connexion</button>
        </form>

        <div class="links">
            <a href="inscription.php">Créer un compte</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>

    
    <script src="js/theme.js"></script>
    <script src="js/connexion.js"></script>
    
</body>
</html>
