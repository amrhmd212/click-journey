<?php
session_start(); // Démarre la session pour accéder aux variables de session

// Récupère les messages d'erreur et de succès depuis la session
$error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';

// Supprime les messages d'erreur et de succès de la session après les avoir récupérés
unset($_SESSION['error']);
unset($_SESSION['success']);

// Chemin vers le fichier contenant les utilisateurs
$file_path = __DIR__ . '/data/users.json';
if (!file_exists($file_path)) { // Vérifie si le fichier des utilisateurs existe
    die("Erreur : Fichier des utilisateurs introuvable."); // Arrête l'exécution si le fichier est introuvable
}

// Charge les utilisateurs depuis le fichier JSON
$users = json_decode(file_get_contents($file_path), true);
$username = $_SESSION['username'] ?? null; // Récupère le nom d'utilisateur depuis la session

// Vérifie si l'utilisateur est banni
foreach ($users as $user) {
    if ($user['username'] === $username && $user['vip_status'] === 'Banni') {
        header("Location: banned.php"); // Redirige vers une page de bannissement
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
    <!-- Liens vers les polices et les styles -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="connexion.css"> 
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

    <div class="login-container">
        <h1>Connexion</h1>

        <!-- Affiche un message d'erreur si il y en a un -->
        <?php if (!empty($error)) : ?>
            <div class="error-message" style="color: red;">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <!-- Affiche un message de succès  il y en a un -->
        <?php if (!empty($success)) : ?>
            <div class="success-message">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <form id="login-form" action="login.php" method="POST" novalidate>
            <!-- Champ pour le nom d'utilisateur -->
            <div class="input-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required maxlength="30">
                <!-- Compteur de caractères pour le champ du nom d'utilisateur -->
                <small id="username-count" class="char-counter"></small>
                <!-- Message d'erreur pour le champ du nom d'utilisateur -->
                <small id="username-error" class="error-message" style="color: red;"></small>
            </div>

            <!-- Champ pour le mot de passe -->
            <div class="input-group">
                <label for="password">Mot de passe</label>

                <div class="password-wrapper">
                    <!-- Champ de saisie pour le mot de passe -->
                    <input type="password" id="password" name="password" placeholder="••••••••" required maxlength="30">
                    <!-- Icône pour afficher/masquer le mot de passe -->
                    <i class="fas fa-eye toggle-password" data-target="password"></i>
                </div>

                <!-- Compteur de caractères pour le champ du mot de passe -->
                <small id="password-count" class="char-counter"></small>
                <!-- Message d'erreur pour le champ du mot de passe -->
                <small id="password-error" class="error-message" style="color: red;"></small>
            </div>

            <!-- Bouton pour soumettre le formulaire -->
            <button type="submit">Connexion</button>
        </form>

        <!-- Lien pour créer un nouveau compte -->
        <div class="links">
            <a href="inscription.php">Créer un compte</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>

    <!-- Scripts JavaScript -->
    <script src="js/theme.js"></script>
    <script src="js/connexion.js"></script>
</body>
</html>
