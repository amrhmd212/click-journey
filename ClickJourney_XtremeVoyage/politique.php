<?php
session_start();
$username = $_SESSION['username'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de Remboursement - Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="politique.css">
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
                    <?php if ($username) : ?>
                        <a href="profil.php" class="login-btn no-effect">Profil (<?php echo htmlspecialchars($username); ?>)</a>
                    <?php else : ?>
                        <a href="connexion.php" class="login-btn no-effect">Connexion</a>
                    <?php endif; ?>
                </li>
                <li><a href="recherche.php"><i class="fas fa-search search-icon"></i></a></li>
            </ul>
        </nav>
        <h1 class="main-title"><span>X</span>treme Voyage</h1>
    </header>

    <main>
        <section class="policy-section">
            <h2>Politique de Remboursement</h2>
            <p>Chez Xtreme Voyage, nous comprenons que des imprévus peuvent survenir. C'est pourquoi nous avons mis en place une politique de remboursement claire et transparente pour vous offrir une tranquillité d'esprit lors de la réservation de votre voyage.</p>

            <h3>Annulations Gratuites</h3>
            <p>Vous pouvez annuler votre réservation sans frais dans les délais suivants :</p>
            <ul>
                <li><strong>30 jours ou plus avant le départ :</strong> Remboursement intégral de votre réservation.</li>
            </ul>

            <h3>Annulations Payantes</h3>
            <p>Si vous annulez votre réservation en dehors des délais mentionnés ci-dessus, des frais d'annulation seront appliqués :</p>
            <ul>
                <li><strong>15 à 29 jours avant le départ :</strong> Remboursement de 50% du montant total.</li>
                <li><strong>8 à 14 jours avant le départ :</strong> Remboursement de 25% du montant total.</li>
                <li><strong>Moins de 7 jours avant le départ :</strong> Aucun remboursement ne sera effectué.</li>
            </ul>

            <h3>Comment Annuler une Réservation</h3>
            <p>Pour annuler votre réservation, veuillez nous contacter par email à <a href="mailto:annulations@xtremevoyage.com">annulations@xtremevoyage.com</a> ou par téléphone au <strong>01 23 45 67 89</strong>. Assurez-vous de fournir votre numéro de réservation et les détails de votre demande.</p>

            <h3>Exceptions</h3>
            <p>Certaines réservations peuvent être soumises à des conditions d'annulation spécifiques, notamment les offres promotionnelles et les forfaits spéciaux. Veuillez vérifier les conditions spécifiques lors de la réservation.</p>

            <h3>Questions ?</h3>
            <p>Si vous avez des questions concernant notre politique de remboursement, n'hésitez pas à <a href="contact.php">nous contacter</a>. Notre équipe est à votre disposition pour vous aider.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
    <script src="js/theme.js"></script>
</body>
</html>