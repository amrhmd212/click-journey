<?php
session_start(); // Démarre la session pour gérer les messages de succès et d'erreur

// Récupère le nom d'utilisateur depuis la session, s'il existe
$username = $_SESSION['username'] ?? null;

// Récupère les messages de succès et d'erreur depuis la session
$success = $_SESSION['success'] ?? '';
$error = $_SESSION['error'] ?? '';

// Supprime les messages de succès et d'erreur après les avoir récupérés
unset($_SESSION['success']);
unset($_SESSION['error']);

// Gestion de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et validation des données du formulaire
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $sujet = filter_input(INPUT_POST, 'sujet', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Vérifie si tous les champs sont remplis
    if ($nom && $email && $sujet && $message) {
        $_SESSION['success'] = "Votre message a bien été envoyé ! Notre équipe vous répondra dans les plus brefs délais.";
    } else {
        $_SESSION['error'] = "Tous les champs sont requis.";
    }

    // Redirige vers la même page pour afficher les messages
    header("Location: contact.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Xtreme Voyage</title>
    <!-- Liens vers les polices et les styles -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="contact.css"> 
</head>
<body>
    <nav>
        <ul>
            <!-- Menu de navigation -->
            <li><a href="index.php">Accueil</a></li>
            <li><a href="presentation.php">Présentation</a></li>
            <li><a href="quisommesnous.php">Qui sommes-nous</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li>
            <!-- Affiche le lien vers le profil ou la connexion selon l'état de connexion -->
            <?php if ($username) : ?>
                <a href="profil.php" class="login-btn no-effect">Profil (<?php echo htmlspecialchars($username); ?>)</a>
            <?php else : ?>
                <a href="connexion.php" class="login-btn no-effect">Connexion</a>
            <?php endif; ?>
            </li>
            <li><a href="recherche.php"><i class="fas fa-search search-icon"></i></a></li>
        </ul>
    </nav>

    <div class="contact-container">
        <div class="contact-form">
            <h1>Contactez-nous</h1>
            <!-- Affiche un message de succès si présent -->
            <?php if ($success): ?>
                <div class="success-message" style="color: green; margin-bottom: 20px; padding: 10px; background-color: #e8f5e9; border-radius: 5px;">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>
            <!-- Affiche un message d'erreur si présent -->
            <?php if ($error): ?>
                <div class="error-message" style="color: red; margin-bottom: 20px; padding: 10px; background-color: #ffebee; border-radius: 5px;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <div id="feedback-message" style="margin-bottom: 20px;"></div>

            <!-- Formulaire de contact -->
            <form id="contact-form" method="POST" action="traitement-contact.php" novalidate>
                <div class="form-group">
                    <label for="nom">Nom complet</label>
                    <input type="text" id="nom" name="nom" required maxlength="50">
                    <small id="nom-count" class="char-counter"></small>
                    <small id="nom-error" class="error-message" style="color:red;"></small>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required maxlength="50">
                    <small id="email-count" class="char-counter"></small>
                    <small id="email-error" class="error-message" style="color:red;"></small>
                </div>

                <div class="form-group">
                    <label for="sujet">Sujet</label>
                    <input type="text" id="sujet" name="sujet" required maxlength="100">
                    <small id="sujet-count" class="char-counter"></small>
                    <small id="sujet-error" class="error-message" style="color:red;"></small>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea rows="5" id="message" name="message" required maxlength="500"></textarea>
                    <small id="message-count" class="char-counter"></small>
                    <small id="message-error" class="error-message" style="color:red;"></small>
                </div>

                <button type="submit" class="btn">Envoyer le message</button>
            </form>
        </div>

        <div class="contact-info">
            <!-- Informations de contact -->
            <div class="info-item">
                <h3>Adresse</h3>
                <p>1 Rue de l'Aventure<br>95000 Cergy, France</p>
            </div>

            <div class="info-item">
                <h3>Téléphone</h3>
                <p>+33 1 23 45 67 89</p>
            </div>

            <div class="info-item">
                <h3>Email</h3>
                <p>contact@xtremevoyage.com</p>
            </div>

            <div class="info-item">
                <h3>Horaires</h3>
                <p>Lun-Ven : 9h-19h<br>Sam : 10h-18h</p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
    
    <!-- Scripts JavaScript -->
    <script src="js/theme.js"></script>
    <script src="js/contact.js"></script>
</body>
</html>
