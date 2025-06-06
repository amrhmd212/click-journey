<?php
session_start();
$username = $_SESSION['username'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qui sommes-nous - Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="quisommesnous.css">
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

    <header>
        <h1 class="main-title">Notre Histoire</h1>
    </header>

    <main>
        <section class="content-section">
            <div class="mission-card">
                <h2 class="section-title">Notre Philosophie</h2>
                <p>Chez Xtreme Voyage, nous croyons que chaque voyage doit être une aventure mémorable. Nous créons des expériences sur mesure classées par niveau d'intensité pour satisfaire tous les types de voyageurs.</p>
            </div>

            <h2 class="section-title">Nos Engagements</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">⛑️</div>
                    <h3>Sécurité Maximale</h3>
                    <p>Équipements certifiés et guides professionnels pour chaque activité</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🌍</div>
                    <h3>Expertise Locale</h3>
                    <p>Partenariats exclusifs avec des communautés locales</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">✨</div>
                    <h3>Expériences Uniques</h3>
                    <p>Accès à des activités exclusives et personnalisables</p>
                </div>
            </div>

            <h2 class="section-title">Pourquoi Nous Choisir?</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">🚀</div>
                    <h3>Innovation</h3>
                    <p>Nous utilisons les dernières technologies pour vous offrir des voyages inoubliables.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">💡</div>
                    <h3>Flexibilité</h3>
                    <p>Des voyages adaptés à vos besoins et à votre budget.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🌟</div>
                    <h3>Qualité</h3>
                    <p>Des services haut de gamme pour une expérience premium.</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
    <script src="js/theme.js"></script>
</body>
</html>