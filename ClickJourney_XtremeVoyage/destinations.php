<?php
// Démarrage de la session pour gérer les informations utilisateur
session_start();

// Récupération du nom d'utilisateur depuis la session s'il existe
$username = $_SESSION['username'] ?? null;

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
            case 'Portugal':
                header("Location: portugal-activites.php");
                break;
            case 'Italie':
                header("Location: italie-activites.php");
                break;
            case 'Maroc':
                header("Location: maroc-activites.php");
                break;
            case 'Grèce':
                header("Location: grece-activites.php");
                break;
            case 'Cuba':
                header("Location: cuba-activites.php");
                break;
            default:
                header("Location: destinations.php");
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
    <title>Voyages à Petites Sensations - Xtreme Voyage</title>
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
        <h1 class="main-title">Voyages à Petites Sensations</h1>
        <img src="https://res.cloudinary.com/lastminute-contenthub/s--vw-G23ct--/c_crop,h_2582,w_3873,x_0,y_0/c_limit,h_999999,w_1920/f_auto/q_auto:eco/v1/DAM/Photos/Destinations/Europe/Turkey/Cappadocia/shutterstock_212571667-v469" alt="Pays petite sensations">
    </header>

    <main>
        <!-- Section principale listant les destinations -->
        <section class="destination-section">
            <h2>Nos destinations</h2>
            <div class="country-list">
                
                <!-- Carte pour le Portugal -->
                <form method="POST" action="destinations.php" class="country-card">
                    <input type="hidden" name="pays" value="Portugal">
                    <button type="submit" class="country-button">
                        <img src="https://th.bing.com/th/id/OIP.z_5GW1akknUaQdS3XdN-hQHaFE?rs=1&pid=ImgDetMain" alt="Portugal">
                        <h3>Portugal</h3>
                    </button>
                </form>

                <!-- Carte pour l'Italie -->
                <form method="POST" action="destinations.php" class="country-card">
                    <input type="hidden" name="pays" value="Italie">
                    <button type="submit" class="country-button">
                        <img src="https://th.bing.com/th/id/OIP.vGoEKHSkX9Boje3wcbwPMQHaE8?rs=1&pid=ImgDetMain" alt="Italie">
                        <h3>Italie</h3>
                    </button>
                </form>

                <!-- Carte pour le Maroc -->
                <form method="POST" action="destinations.php" class="country-card">
                    <input type="hidden" name="pays" value="Maroc">
                    <button type="submit" class="country-button">
                        <img src="https://th.bing.com/th/id/OIP.O55q5-Xvhdkb9Cmkn9cvhAHaE8?rs=1&pid=ImgDetMain" alt="Maroc">
                        <h3>Maroc</h3>
                    </button>
                </form>

                <!-- Carte pour la Grèce -->
                <form method="POST" action="destinations.php" class="country-card bottom-row">
                    <input type="hidden" name="pays" value="Grèce">
                    <button type="submit" class="country-button">
                        <img src="https://th.bing.com/th/id/OIP.TpSON0jWSCM_dwM6Kpxa_AHaE8?w=1536&h=1024&rs=1&pid=ImgDetMain" alt="Grèce">
                        <h3>Grèce</h3>
                    </button>
                </form>

                <!-- Carte pour Cuba -->
                <form method="POST" action="destinations.php" class="country-card bottom-row">
                    <input type="hidden" name="pays" value="Cuba">
                    <button type="submit" class="country-button">
                        <img src="https://th.bing.com/th/id/R.2d671e508b442feb3d40e67d14ee4827?rik=RTv1eCgRqtQCZA&pid=ImgRaw&r=0" alt="Cuba">
                        <h3>Cuba</h3>
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
