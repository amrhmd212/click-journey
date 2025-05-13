<?php
session_start();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pays_selectionne = $_POST['pays'] ?? '';

    if (!empty($pays_selectionne)) {
        unset($_SESSION['activites_selectionnees']);
        unset($_SESSION['departure_date']);
        unset($_SESSION['return_date']);
        unset($_SESSION['num_people']);
        unset($_SESSION['vol']);
        unset($_SESSION['prix_vol']);
        unset($_SESSION['vol_retour']);
        unset($_SESSION['prix_vol_retour']);
        unset($_SESSION['hotel']);
        unset($_SESSION['prix_hotel']);
        unset($_SESSION['options_supplementaires']);

        $_SESSION['pays_selectionne'] = $pays_selectionne;

        switch ($pays_selectionne) {
            case 'Népal':
                header("Location: nepal-activites.php");
                break;
            case 'Afrique-du-sud':
                header("Location: afrique-du-sud-activites.php");
                break;
            case 'Indonésie':
                header("Location: indonesie-activites.php");
                break;
            case 'Japon':
                header("Location: japon-activites.php");
                break;
            case 'etats-unis':
                header("Location: etats-unis-activites.php");
                break;
            default:
                header("Location: destinations3.php");
                break;
        }
        exit();
    } else {
        echo "Erreur : Aucun pays sélectionné.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voyage à Sensation Extrême - Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="destinations.css">
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
        <h1 class="main-title">Voyage à Sensation Extrême</h1>
        <img src="https://tcsvoyages.ch/wp-content/uploads/2020/05/shutterstock-1050996575-mont-fuji-du-sakura-et-du-chureito-dans-la-prefecture-de-yamanashi-au-japon-scaled.jpg" alt="Pays Xtreme Sensations">
    </header>

    <main>
        <section class="destination-section">
            <h2>Nos destinations extrêmes</h2>
            <div class="country-list">
                <form method="POST" action="destinations3.php" class="country-card">
                    <input type="hidden" name="pays" value="Népal">
                    <button type="submit" class="country-button">
                        <img src="https://api.quotatrip.com/storage/trip_days/11646/9155b4a859dd0dd02ff99aac0ebce967.jpeg" alt="Népal">
                        <h3>Népal</h3>
                    </button>
                </form>
                <form method="POST" action="destinations3.php" class="country-card">
                    <input type="hidden" name="pays" value="Afrique-du-sud">
                    <button type="submit" class="country-button">
                        <img src="https://th.bing.com/th/id/R.8d6dec68ed3fc9d1d69d05f4ec8cfd65?rik=35qeT1PhTAOOnQ&pid=ImgRaw&r=0" alt="Afrique du Sud">
                        <h3>Afrique du Sud</h3>
                    </button>
                </form>
                <form method="POST" action="destinations3.php" class="country-card">
                    <input type="hidden" name="pays" value="Indonésie">
                    <button type="submit" class="country-button">
                        <img src="https://th.bing.com/th/id/R.4a165d41b616b501e890adfdc06fb62a?rik=QTSulegN%2bOOVOw&pid=ImgRaw&r=0" alt="Indonésie">
                        <h3>Indonésie</h3>
                    </button>
                </form>
                <form method="POST" action="destinations3.php" class="country-card bottom-row">
                    <input type="hidden" name="pays" value="Japon">
                    <button type="submit" class="country-button">
                        <img src="https://th.bing.com/th/id/OIP.7CVJ2d29GvD0CjmojqgOQAHaE8?rs=1&pid=ImgDetMain" alt="Japon">
                        <h3>Japon</h3>
                    </button>
                </form>
                <form method="POST" action="destinations3.php" class="country-card bottom-row">
                    <input type="hidden" name="pays" value="etats-unis">
                    <button type="submit" class="country-button">
                        <img src="https://wallpaper.forfun.com/fetch/f3/f35b23ab600283703d93145aa17d9aff.jpeg" alt="États-Unis">
                        <h3>États-Unis</h3>
                    </button>
                </form>
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
