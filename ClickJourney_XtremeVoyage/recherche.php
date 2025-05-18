<?php

session_start(); // Démarrage de la session pour gérer les données utilisateur

// Vérifier si l'utilisateur est connecté
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Définition des pays avec leurs informations (nom, lien, image, description, etc.)
$countries = [
    // Exemple de pays : Portugal
    [
        "name" => "Portugal",
        "link" => "portugal-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.z_5GW1akknUaQdS3XdN-hQHaFE?rs=1&pid=ImgDetMain",
        "alt"  => "Portugal",
        "description" => "Découvrez des paysages à couper le souffle et une culture riche.",
        "keywords" => "Europe, plage, océan, culture, Lisbonne, Porto, Algarve",
        "stars" => 5,
        "sensation" => "petites",
        "landscape" => "plage",
        "continent" => "europe",
    ],
    [
        "name" => "Italie",
        "link" => "italie-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.vGoEKHSkX9Boje3wcbwPMQHaE8?rs=1&pid=ImgDetMain",
        "alt"  => "Italie",
        "description" => "Paysages magnifiques et détente entre art, histoire et gastronomie.",
        "keywords" => "Europe, Rome, Venise, Florence, Toscane, culture, historique",
        "stars" => 3,
        "sensation" => "petites",
        "landscape" => "ville",
        "continent" => "europe",
    ],
    [
        "name" => "Maroc",
        "link" => "maroc-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.O55q5-Xvhdkb9Cmkn9cvhAHaE8?rs=1&pid=ImgDetMain",
        "alt"  => "Maroc",
        "description" => "Un mélange envoûtant de déserts, montagnes et villes impériales.",
        "keywords" => "Afrique, Marrakech, désert, montagne, culture, souks",
        "stars" => 5,
        "sensation" => "petites",
        "landscape" => "ville",
        "continent" => "afrique",
    ],
    [
        "name" => "Grèce",
        "link" => "grece-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.TpSON0jWSCM_dwM6Kpxa_AHaE8?w=1536&h=1024&rs=1&pid=ImgDetMain",
        "alt"  => "Grèce",
        "description" => "Îles paradisiaques et sites historiques classés au patrimoine mondial.",
        "keywords" => "Europe, îles, Santorin, Mykonos, Athènes, antiquité",
        "stars" => 4,
        "sensation" => "petites",
        "landscape" => "nature",
        "continent" => "europe",
    ],
    [
        "name" => "Cuba",
        "link" => "cuba-activites.php",
        "img"  => "https://th.bing.com/th/id/R.2d671e508b442feb3d40e67d14ee4827?rik=RTv1eCgRqtQCZA&pid=ImgRaw&r=0",
        "alt"  => "Cuba",
        "description" => "Vibrez au rythme de la salsa dans ce pays coloré et authentique.",
        "keywords" => "Caraïbes, La Havane, plage, musique, culture, vintage",
        "stars" => 4,
        "sensation" => "petites",
        "landscape" => "plage",
        "continent" => "amerique",
    ],
    [
        "name" => "Albanie",
        "link" => "albanie-activites.php",
        "img"  => "https://cdn.generationvoyage.fr/2023/10/Albanie.jpeg",
        "alt"  => "Albanie",
        "description" => "Joyau méconnu des Balkans aux paysages préservés et sauvages.",
        "keywords" => "Europe, Balkans, montagne, plage, Riviera albanaise",
        "stars" => 2,
        "sensation" => "moyennes",
        "landscape" => "plage",
        "continent" => "europe",
    ],
    [
        "name" => "Espagne",
        "link" => "espagne-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.xL0rh_osRnKzs8TShA1O-gHaE8?rs=1&pid=ImgDetMain",
        "alt"  => "Espagne",
        "description" => "Entre fêtes animées, architecture avant-gardiste et plages ensoleillées.",
        "keywords" => "Europe, Barcelone, Madrid, Costa Brava, fêtes, Gaudí",
        "stars" => 1,
        "sensation" => "moyennes",
        "landscape" => "plage",
        "continent" => "europe",
    ],
    [
        "name" => "Nouvelle-Zélande",
        "link" => "nouvelle-zelande-activites.php",
        "img"  => "https://th.bing.com/th/id/R.0219439a4cf67cdde21e9dda7457b53c?rik=KHP7iZOilHsTjw&pid=ImgRaw&r=0",
        "alt"  => "Nouvelle-Zélande",
        "description" => "Nature préservée et activités extrêmes dans des décors de films.",
        "keywords" => "Océanie, aventure, nature, Lord of the Rings, randonnée",
        "stars" => 1,
        "sensation" => "moyennes",
        "landscape" => "nature",
        "continent" => "oceanie",
    ],
    [
        "name" => "Suisse",
        "link" => "suisse-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.2dY611ZOCesq71t4k2ZQjwHaFM?rs=1&pid=ImgDetMain",
        "alt"  => "Suisse",
        "description" => "Lacs alpins, sommets enneigés et villes au charme intact.",
        "keywords" => "Europe, Alpes, montagne, ski, chocolat, précision",
        "stars" => 2,
        "sensation" => "moyennes",
        "landscape" => "montagne",
        "continent" => "europe",
    ],
    [
        "name" => "Costa Rica",
        "link" => "costa-rica-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.IstccuQIi-5ZW72OqE2CBwHaE8?rs=1&pid=ImgDetMain",
        "alt"  => "Costa Rica",
        "description" => "Pionnier de l'écotourisme avec une biodiversité exceptionnelle.",
        "keywords" => "Amérique centrale, jungle, plage, tortues, aventure, écologie",
        "stars" => 3,
        "sensation" => "moyennes",
        "landscape" => "ville",
        "continent" => "amerique",
    ],
    [
        "name" => "Népal",
        "link" => "nepal-activites.php",
        "img"  => "https://static1.evcdn.net/cdn-cgi/image/width=3840,height=3072,quality=70,fit=crop/offer/raw/2024/11/18/ff3749bb-5216-43ed-9df3-3fbb3c91996b.jpg",
        "alt"  => "Népal",
        "description" => "Terre des montagnes majestueuses et de la spiritualité bouddhiste.",
        "keywords" => "Asie, Himalaya, Everest, trekking, spiritualité, Katmandou",
        "stars" => 4,
        "sensation" => "extremes",
        "landscape" => "montagne",
        "continent" => "asie",
    ],
    [
        "name" => "Afrique du Sud",
        "link" => "afrique-du-sud-activites.php",
        "img"  => "https://th.bing.com/th/id/R.8d6dec68ed3fc9d1d69d05f4ec8cfd65?rik=35qeT1PhTAOOnQ&pid=ImgRaw&r=0",
        "alt"  => "Afrique du Sud",
        "description" => "Safaris inoubliables et paysages à couper le souffle.",
        "keywords" => "Afrique, safari, Cap Town, animaux, vin, nature",
        "stars" => 1,
        "sensation" => "extremes",
        "landscape" => "nature",
        "continent" => "afrique",
    ],
    [
        "name" => "Indonésie",
        "link" => "indonesie-activites.php",
        "img"  => "https://th.bing.com/th/id/R.4a165d41b616b501e890adfdc06fb62a?rik=QTSulegN%2bOOVOw&pid=ImgRaw&r=0",
        "alt"  => "Indonésie",
        "description" => "Archipel aux mille îles entre volcans, rizières et plages de rêve.",
        "keywords" => "Asie, Bali, Java, plage, surf, culture, aventure",
        "stars" => 3,
        "sensation" => "extremes",
        "landscape" => "nature",
        "continent" => "asie",
    ],
    [
        "name" => "Japon",
        "link" => "japon-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.7CVJ2d29GvD0CjmojqgOQAHaE8?rs=1&pid=ImgDetMain",
        "alt"  => "Japon",
        "description" => "Harmonie unique entre traditions ancestrales et innovations futuristes.",
        "keywords" => "Asie, Tokyo, Kyoto, mont Fuji, technologie, culture",
        "stars" => 4,
        "sensation" => "extremes",
        "landscape" => "montagne",
        "continent" => "asie",
    ],
    [
        "name" => "États-Unis",
        "link" => "etats-unis-activites.php",
        "img"  => "https://wallpaper.forfun.com/fetch/f3/f35b23ab600283703d93145aa17d9aff.jpeg",
        "alt"  => "États-Unis",
        "description" => "Diversité impressionnante de paysages et de cultures.",
        "keywords" => "Amérique, New York, Grand Canyon, Las Vegas, road trip",
        "stars" => 5,
        "sensation" => "extremes",
        "landscape" => "ville",
        "continent" => "amerique",
    ]
];

// Récupération des paramètres de recherche depuis l'URL
$search_term = $_GET['search'] ?? ''; // Terme de recherche saisi par l'utilisateur
$stars = $_GET['stars'] ?? ''; // Filtre par nombre d'étoiles
$sensation = $_GET['sensation'] ?? ''; // Filtre par type de sensations
$landscape = $_GET['landscape'] ?? ''; // Filtre par type de paysage
$continent = $_GET['continent'] ?? ''; // Filtre par continent

// Filtrage des pays en fonction des critères de recherche
$filtered_countries = array_filter($countries, function($country) use ($search_term, $stars, $sensation, $landscape, $continent) {
    // Recherche par mot-clé dans le nom, la description et les mots-clés
    if (!empty($search_term)) {
        $search_in = $country['name'] . ' ' . $country['description'] . ' ' . $country['keywords'];
        if (stripos($search_in, $search_term) === false) { // Vérifie si le terme de recherche est présent
            return false;
        }
    }

    // Filtrage par nombre d'étoiles
    if (!empty($stars) && $country['stars'] != $stars) {
        return false;
    }

    // Filtrage par type de sensations
    if (!empty($sensation) && $country['sensation'] !== $sensation) {
        return false;
    }

    // Filtrage par type de paysage
    if (!empty($landscape) && $country['landscape'] !== $landscape) {
        return false;
    }

    // Filtrage par continent
    if (!empty($continent) && strtolower($country['continent']) !== strtolower($continent)) {
        return false;
    }

    return true; // Le pays correspond à tous les critères
});

// Si aucun critère n'est défini, afficher tous les pays
if (empty($search_term) && empty($stars) && empty($sensation) && empty($landscape)) {
    $filtered_countries = $countries;
}

// Traitement du formulaire POST pour sélectionner un pays
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pays_selectionne = $_POST['pays'] ?? ''; // Récupération du pays sélectionné

    if (!empty($pays_selectionne)) {
        // Réinitialisation des données de session liées au voyage
        unset($_SESSION['num_people']);
        unset($_SESSION['activites_selectionnees']);
        unset($_SESSION['vol']);
        unset($_SESSION['hotel']);
        unset($_SESSION['options_supplementaires']);

        // Enregistrement du pays sélectionné dans la session
        $_SESSION['pays_selectionne'] = $pays_selectionne;

        // Redirection vers la page des activités du pays sélectionné
        $link = "destinations2.php"; // Lien par défaut
        foreach ($countries as $country) {
            if ($country['name'] === $pays_selectionne) { // Recherche du lien correspondant au pays
                $link = $country['link'];
                break;
            }
        }

        header("Location: " . $link); // Redirection vers la page du pays
        exit();
    } else {
        echo "Erreur : Aucun pays sélectionné."; 
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Métadonnées et liens vers les fichiers CSS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher un pays - Xtreme Voyage</title>
    <!-- Police d'écriture -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <!-- Icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Fichier CSS principal -->
    <link rel="stylesheet" href="recherche.css">
</head>
<body>
    <!-- Barre de navigation -->
    <nav>
        <ul>
            <!-- Lien vers la page d'accueil -->
            <li><a href="index.php">Accueil</a></li>
            <!-- Lien vers la page de présentation -->
            <li><a href="presentation.php">Présentation</a></li>
            <!-- Lien vers la page "Qui sommes-nous" -->
            <li><a href="quisommesnous.php">Qui sommes-nous</a></li>
            <!-- Lien vers la page de contact -->
            <li><a href="contact.php">Contact</a></li>
            <!-- Vérifie si l'utilisateur est connecté -->
            <li>
                <?php if (isset($_SESSION['username'])) : ?>
                    <!-- Affiche le profil de l'utilisateur connecté -->
                    <a href="profil.php" class="login-btn no-effect">Profil (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
                <?php else : ?>
                    <!-- Lien de connexion si l'utilisateur n'est pas connecté -->
                    <a href="connexion.php" class="login-btn no-effect">Connexion</a>
                <?php endif; ?>
            </li>
            <!-- Icône de recherche -->
            <li><a href="recherche.php"><i class="fas fa-search search-icon"></i></a></li>
        </ul>
    </nav>

    <!-- En-tête de la page -->
    <header>
        <h1 class="main-title">Explorez le Monde</h1> <!-- Titre principal -->
    </header>

    <!-- Conteneur pour le formulaire de recherche -->
    <div class="search-container">
        <form id="filterForm" onsubmit="return false;" class="search-bar">
            <!-- Champ de recherche -->
            <input type="text" name="search" placeholder="Rechercher un pays, une description ou des mots-clés..." value="<?= htmlspecialchars($search_term) ?>">
            
            <!-- Filtre par nombre d'étoiles -->
            <select name="stars">
                <option value="">Type de voyage</option>
                <option value="1" <?= $stars == '1' ? 'selected' : '' ?>>1 étoile</option>
                <option value="2" <?= $stars == '2' ? 'selected' : '' ?>>2 étoiles</option>
                <option value="3" <?= $stars == '3' ? 'selected' : '' ?>>3 étoiles</option>
                <option value="4" <?= $stars == '4' ? 'selected' : '' ?>>4 étoiles</option>
                <option value="5" <?= $stars == '5' ? 'selected' : '' ?>>5 étoiles</option>
            </select>
            
            <!-- Filtre par type de sensations -->
            <select name="sensation">
                <option value="">Sensations</option>
                <option value="petites" <?= $sensation == 'petites' ? 'selected' : '' ?>>Petites sensations</option>
                <option value="moyennes" <?= $sensation == 'moyennes' ? 'selected' : '' ?>>Moyennes sensations</option>
                <option value="extremes" <?= $sensation == 'extremes' ? 'selected' : '' ?>>Sensations extrêmes</option>
            </select>

            <!-- Filtre par continent -->
            <select name="continent">
                <option value="">Continent</option>
                <option value="europe" <?= $continent == 'europe' ? 'selected' : '' ?>>Europe</option>
                <option value="afrique" <?= $continent == 'afrique' ? 'selected' : '' ?>>Afrique</option>
                <option value="amerique" <?= $continent == 'amerique' ? 'selected' : '' ?>>Amérique</option>
                <option value="asie" <?= $continent == 'asie' ? 'selected' : '' ?>>Asie</option>
                <option value="oceanie" <?= $continent == 'oceanie' ? 'selected' : '' ?>>Océanie</option>
            </select>

            <!-- Filtre par type de paysage -->
            <select name="landscape">
                <option value="">Type de paysage</option>
                <option value="montagne" <?= $landscape == 'montagne' ? 'selected' : '' ?>>Montagne</option>
                <option value="plage" <?= $landscape == 'plage' ? 'selected' : '' ?>>Plage</option>
                <option value="ville" <?= $landscape == 'ville' ? 'selected' : '' ?>>Ville</option>
                <option value="nature" <?= $landscape == 'nature' ? 'selected' : '' ?>>Nature</option>
            </select>
            
            <!-- Bouton pour lancer la recherche -->
            <button type="button" id="filterBtn">Rechercher</button>

            <!-- Bouton pour réinitialiser les filtres -->
            <a href="recherche.php" class="reset-btn">Réinitialiser</a>
        </form>
    </div>

    <!-- Section des résultats de la recherche -->
    <main>
        <div class="results-grid" id="resultsContainer">
            <?php if (empty($filtered_countries)) : ?>
                <!-- Message affiché si aucun résultat n'est trouvé -->
                <p class="no-results">Aucun résultat trouvé pour votre recherche.</p>
            <?php else : ?>
                <?php foreach ($filtered_countries as $country) : ?>
                    <!-- Carte pour chaque pays correspondant aux critères -->
                    <form method="POST" action="" class="country-form">
                        <!-- Champ caché pour envoyer le nom du pays sélectionné -->
                        <input type="hidden" name="pays" value="<?= htmlspecialchars($country['name']) ?>">
                        <button type="submit" class="country-card">
                            <!-- Image du pays -->
                            <img src="<?= htmlspecialchars($country['img']) ?>" alt="<?= htmlspecialchars($country['alt']) ?>">
                            <div class="country-info">
                                <!-- Nom du pays -->
                                <h3 class="country-name"><?= htmlspecialchars($country['name']) ?></h3>
                                <!-- Étoiles représentant le type de voyage -->
                                <div class="country-stars">
                                    <?php for ($i = 0; $i < $country['stars']; $i++) : ?>
                                        <i class="fas fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                                <!-- Description du pays -->
                                <p class="country-description"><?= htmlspecialchars($country['description']) ?></p>
                                <!-- Tags pour les sensations, paysages et continents -->
                                <div class="country-tags">
                                    <span class="tag sensation-<?= $country['sensation'] ?>">
                                        <?= ucfirst($country['sensation']) ?> sensations
                                    </span>
                                    <span class="tag landscape-<?= $country['landscape'] ?>">
                                        <?= ucfirst($country['landscape']) ?>
                                    </span>
                                    <span class="tag continent-<?= $country['continent'] ?>">
                                        <?= ucfirst($country['continent']) ?>
                                    </span>
                                </div>
                            </div>
                        </button>
                    </form>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <!-- Pied de page -->
    <footer>
        <!-- Informations sur les droits et politique -->
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
    <!-- Scripts JavaScript -->
    <script src="js/theme.js"></script> <!-- Script pour gérer le thème -->
    <script src="js/recherche.js"></script> <!-- Script pour gérer la recherche -->
</body>
</html>