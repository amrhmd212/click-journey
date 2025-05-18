<?php
// Démarrage de la session pour gérer les informations utilisateur
session_start();

// Récupération du nom d'utilisateur depuis la session s'il existe
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Traitement du formulaire lors de la sélection d'un pays
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pays_selectionne = $_POST['pays'] ?? '';

    if (!empty($pays_selectionne)) {
        // Réinitialisation des anciennes sélections dans la session
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

        // Redirection vers la page d'activités du pays choisi
        switch ($pays_selectionne) {
            case 'Albanie':
                header("Location: albanie-activites.php");
                break;
            case 'Espagne':
                header("Location: espagne-activites.php");
                break;
            case 'Nouvelle-Zélande':
                header("Location: nouvelle-zelande-activites.php");
                break;
            case 'Suisse':
                header("Location: suisse-activites.php");
                break;
            case 'Costa Rica':
                header("Location: costa-rica-activites.php");
                break;
            default:
                header("Location: destinations2.php");
                break;
        }
        exit();
    } else {
        // Message d'erreur si aucun pays n'est sélectionné
        echo "Erreur : Aucun pays sélectionné.";
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voyage à Moyenne Sensation - Xtreme Voyage</title>
    <!-- Import des polices et des icônes -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="destinations.css">
</head>
<body>

    <!-- Barre de navigation principale -->
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="presentation.php">Présentation</a></li>
            <li><a href="quisommesnous.php">Qui sommes-nous</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li>
                <?php // Affichage du bouton profil ou connexion selon l'état de connexion de l'utilisateur ?>
                <?php if ($username) : ?>
                    <a href="profil.php" class="login-btn no-effect">Profil (<?php echo htmlspecialchars($username); ?>)</a>
                <?php else : ?>
                    <a href="connexion.php" class="login-btn no-effect">Connexion</a>
                <?php endif; ?>
            </li>
            <li><a href="recherche.php"><i class="fas fa-search search-icon"></i></a></li>
        </ul>
    </nav>

    <!-- En-tête de la page avec titre et image -->
    <header>
        <h1 class="main-title">Voyage à Moyenne Sensation</h1>
        <img src="https://www.10wallpaper.com/wallpaper/2560x1600/1702/New_Zealand_National_Park_Fjord-High_Quality_Wallpaper_2560x1600.jpg" alt="Pays Moyenne Sensations">
    </header>

    <main>
        <!-- Section principale listant les destinations -->
        <section class="destination-section">
            <h2>Nos destinations</h2>
            <div class="country-list">
                <!-- Carte pour l'Albanie -->
                <form method="POST" action="destinations2.php" class="country-card">
                    <input type="hidden" name="pays" value="Albanie">
                    <button type="submit" class="country-button">
                        <img src="https://cdn.generationvoyage.fr/2023/10/Albanie.jpeg" alt="Albanie">
                        <h3>Albanie</h3>
                    </button>
                </form>
                <!-- Carte pour l'Espagne -->
                <form method="POST" action="destinations2.php" class="country-card">
                    <input type="hidden" name="pays" value="Espagne">
                    <button type="submit" class="country-button">
                        <img src="https://th.bing.com/th/id/OIP.xL0rh_osRnKzs8TShA1O-gHaE8?rs=1&pid=ImgDetMain" alt="Espagne">
                        <h3>Espagne</h3>
                    </button>
                </form>
                <!-- Carte pour la Nouvelle-Zélande -->
                <form method="POST" action="destinations2.php" class="country-card">
                    <input type="hidden" name="pays" value="Nouvelle-Zélande">
                    <button type="submit" class="country-button">
                        <img src="https://th.bing.com/th/id/R.0219439a4cf67cdde21e9dda7457b53c?rik=KHP7iZOilHsTjw&pid=ImgRaw&r=0" alt="Nouvelle-Zélande">
                        <h3>Nouvelle-Zélande</h3>
                    </button>
                </form>
                <!-- Carte pour la Suisse -->
                <form method="POST" action="destinations2.php" class="country-card bottom-row">
                    <input type="hidden" name="pays" value="Suisse">
                    <button type="submit" class="country-button">
                        <img src="https://th.bing.com/th/id/OIP.2dY611ZOCesq71t4k2ZQjwHaFM?rs=1&pid=ImgDetMain" alt="Suisse">
                        <h3>Suisse</h3>
                    </button>
                </form>
                <!-- Carte pour le Costa Rica -->
                <form method="POST" action="destinations2.php" class="country-card bottom-row">
                    <input type="hidden" name="pays" value="Costa Rica">
                    <button type="submit" class="country-button">
                        <img src="https://th.bing.com/th/id/OIP.IstccuQIi-5ZW72OqE2CBwHaE8?rs=1&pid=ImgDetMain" alt="Costa Rica">
                        <h3>Costa Rica</h3>
                    </button>
                </form>
            </div>
        </section>
    </main>

    <!-- Pied de page avec informations légales et contact -->
    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
    <!-- Script pour la gestion du thème (sombre/clair) -->
    <script src="js/theme.js"></script>
</body>
</html>
