<?php
session_start();
$username = $_SESSION['username'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="contact.css"> 
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="presentation.php">Présentation</a></li>
            <li><a href="quisommesnous.php">Qui sommes-nous</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li>
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
    
    <script src="js/theme.js"></script>
    <script src="js/contact.js"></script>
</body>
</html>
