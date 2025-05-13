<?php

session_start();


$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

$countries = [
    [
        "name" => "Portugal",
        "link" => "portugal-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.z_5GW1akknUaQdS3XdN-hQHaFE?rs=1&pid=ImgDetMain",
        "alt"  => "Portugal",
        "description" => "Découvrez des paysages à couper le souffle et une culture riche.",
        "keywords" => "Europe, plage, océan, culture"
    ],
    [
        "name" => "Népal",
        "link" => "nepal-activites.php",
        "img"  => "https://static1.evcdn.net/cdn-cgi/image/width=3840,height=3072,quality=70,fit=crop/offer/raw/2024/11/18/ff3749bb-5216-43ed-9df3-3fbb3c91996b.jpg",
        "alt"  => "Népal",
        "description" => "Terre des montagnes majestueuses et de la spiritualité.",
        "keywords" => "Asie, montagne, Himalaya, aventure, spiritualité"
    ],
    [
        "name" => "Afrique du Sud",
        "link" => "afrique-du-sud-activites.php",
        "img"  => "https://th.bing.com/th/id/R.8d6dec68ed3fc9d1d69d05f4ec8cfd65?rik=35qeT1PhTAOOnQ&pid=ImgRaw&r=0",
        "alt"  => "Afrique du Sud",
        "description" => "Un mélange de safaris et de paysages à couper le souffle.",
        "keywords" => "Afrique, safari, nature, montagne"
    ],
    [
        "name" => "Indonésie",
        "link" => "indonesie-activites.php",
        "img"  => "https://th.bing.com/th/id/R.4a165d41b616b501e890adfdc06fb62a?rik=QTSulegN%2bOOVOw&pid=ImgRaw&r=0",
        "alt"  => "Indonésie",
        "description" => "Un paradis tropical avec des îles exotiques.",
        "keywords" => "Asie, plage, îles, tropical"
    ],
    [
        "name" => "États-Unis",
        "link" => "etats-unis-activites.php",
        "img"  => "https://wallpaper.forfun.com/fetch/f3/f35b23ab600283703d93145aa17d9aff.jpeg",
        "alt"  => "États-Unis",
        "description" => "Un pays de diversité et d'opportunités infinies.",
        "keywords" => "Amérique du Nord, divers, ville, montagne, plage"
    ],
    [
        "name" => "Italie",
        "link" => "italie-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.vGoEKHSkX9Boje3wcbwPMQHaE8?rs=1&pid=ImgDetMain",
        "alt"  => "Italie",
        "description" => "La patrie de l'art, de la culture et de la gastronomie.",
        "keywords" => "Europe, culture, gastronomie, historique, plage"
    ],
    [
        "name" => "Maroc",
        "link" => "maroc-activites.php",
        "img"  => "https://www.cbd.fr/blog/wp-content/uploads/2021/03/maroc-cannabis-medical-legalise-cbd-fr.jpeg",
        "alt"  => "Maroc",
        "description" => "Un voyage sensoriel entre désert et médinas vibrantes.",
        "keywords" => "Afrique, désert, culture, médina"
    ],
    [
        "name" => "Grèce",
        "link" => "grece-activites.php",
        "img"  => "https://www.tourmag.com/photo/art/grande/73862889-51376911.jpg?v=1688455433",
        "alt"  => "Grèce",
        "description" => "Berceau de la civilisation et des plages idylliques.",
        "keywords" => "Europe, plage, antiquité, mer"
    ],
    [
        "name" => "Cuba",
        "link" => "cuba-activites.php",
        "img"  => "https://th.bing.com/th/id/R.2d671e508b442feb3d40e67d14ee4827?rik=RTv1eCgRqtQCZA&pid=ImgRaw&r=0",
        "alt"  => "Cuba",
        "description" => "Un pays vibrant de musique et d'histoire.",
        "keywords" => "Amérique, plage, culture, musique"
    ],
    [
        "name" => "Albanie",
        "link" => "albanie-activites.php",
        "img"  => "https://cdn.generationvoyage.fr/2023/10/Albanie.jpeg",
        "alt"  => "Albanie",
        "description" => "Un joyau caché des Balkans.",
        "keywords" => "Europe, Balkans, montagne, plage"
    ],
    [
        "name" => "Espagne",
        "link" => "espagne-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.xL0rh_osRnKzs8TShA1O-gHaE8?rs=1&pid=ImgDetMain",
        "alt"  => "Espagne",
        "description" => "Une explosion de culture, de gastronomie et de plages.",
        "keywords" => "Europe, plage, culture, historique"
    ],
    [
        "name" => "Suisse",
        "link" => "suisse-activites.php",
        "img"  => "https://www.excellence-linguistique.fr/wp-content/uploads/2021/01/voyage-linguistique-suisse-scaled.jpg",
        "alt"  => "Suisse",
        "description" => "Un écrin de nature et de luxe au cœur de l'Europe.",
        "keywords" => "Europe, montagne, nature, luxe"
    ],
    [
        "name" => "Costa Rica",
        "link" => "costa-rica-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.IstccuQIi-5ZW72OqE2CBwHaE8?rs=1&pid=ImgDetMain",
        "alt"  => "Costa Rica",
        "description" => "Un sanctuaire de biodiversité et d'aventure.",
        "keywords" => "Amérique centrale, plage, forêt, aventure"
    ],
    [
        "name" => "Japon",
        "link" => "japon-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.7CVJ2d29GvD0CjmojqgOQAHaE8?rs=1&pid=ImgDetMain",
        "alt"  => "Japon",
        "description" => "Un mélange unique de tradition et de modernité.",
        "keywords" => "Asie, culture, tradition, modernité, montagne"
    ],
    [
        "name" => "Nouvelle-Zélande",
        "link" => "nouvelle-zelande-activites.php",
        "img"  => "https://th.bing.com/th/id/R.0219439a4cf67cdde21e9dda7457b53c?rik=KHP7iZOilHsTjw&pid=ImgRaw&r=",
        "alt"  => "Nouvelle-Zélande",
        "description" => "Paradis des amateurs de nature et d'aventure.",
        "keywords" => "Océanie, montagne, nature, aventure"
    ]
];

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

        
        $link = "destinations2.php"; 
        foreach ($countries as $country) {
            if ($country['name'] === $pays_selectionne) {
                $link = $country['link'];
                break;
            }
        }

        header("Location: " . $link);
        exit();
    } else {
        echo "Erreur : Aucun pays sélectionné.";
    }
}


$search = "";
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

if ($search !== "") {
    $filteredCountries = array_filter($countries, function($country) use ($search) {
        return (stripos($country['name'], $search) !== false) ||
               (stripos($country['description'], $search) !== false) ||
               (stripos($country['keywords'], $search) !== false);
    });
} else {
    $filteredCountries = $countries;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher un pays - Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="presentation.css">
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

    <header>
        <h1 class="main-title">Xtreme Voyage</h1>
    </header>

    <div class="search-container">
        <form id="searchForm" onsubmit="return false;">
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Rechercher un pays...">
                <button type="button" id="searchBtn">Rechercher</button>
            </div>
        </form>

    </div>

    <main>
        <div class="results-grid" id="resultsContainer">
            <?php if (empty($filteredCountries)) : ?>
                <p>Aucun pays ne correspond à votre recherche.</p>
            <?php else: ?>
                <?php foreach ($filteredCountries as $country) : ?>
                    <form method="POST" action="" class="country-form">
                        <input type="hidden" name="pays" value="<?php echo htmlspecialchars($country['name']); ?>">
                        <button type="submit" class="country-card">
                            <img src="<?php echo $country['img']; ?>" alt="<?php echo $country['alt']; ?>">
                            <div class="country-info">
                                <h3 class="country-name"><?php echo $country['name']; ?></h3>
                                <p class="country-description"><?php echo $country['description']; ?></p>
                            </div>
                        </button>
                    </form>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>

    <script src="js/theme.js"></script>
    <script src="js/presentation.js"></script>
    

</body>
</html>
