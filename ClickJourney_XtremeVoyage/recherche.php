<?php



session_start();


$countries = [
    [
        "name" => "Portugal",
        "link" => "portugal-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.z_5GW1akknUaQdS3XdN-hQHaFE?rs=1&pid=ImgDetMain",
        "alt"  => "Portugal",
        "description" => "Découvrez des paysages à couper le souffle et une culture riche.",
        "keywords" => "Europe, plage, océan, culture, Lisbonne, Porto, Algarve",
        "stars" => 4,
        "sensation" => "petites",
        "landscape" => "plage",
        "departure_dates" => ['2025-03-15', '2025-04-10', '2025-05-05']
    ],
    [
        "name" => "Italie",
        "link" => "italie-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.vGoEKHSkX9Boje3wcbwPMQHaE8?rs=1&pid=ImgDetMain",
        "alt"  => "Italie",
        "description" => "Paysages magnifiques et détente entre art, histoire et gastronomie.",
        "keywords" => "Europe, Rome, Venise, Florence, Toscane, culture, historique",
        "stars" => 5,
        "sensation" => "petites",
        "landscape" => "ville",
        "departure_dates" => ['2025-04-01', '2025-05-15']
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
        "landscape" => "nature",
        "departure_dates" => ['2025-04-01', '2025-05-15']
    ],
    [
        "name" => "Grèce",
        "link" => "grece-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.TpSON0jWSCM_dwM6Kpxa_AHaE8?w=1536&h=1024&rs=1&pid=ImgDetMain",
        "alt"  => "Grèce",
        "description" => "Îles paradisiaques et sites historiques classés au patrimoine mondial.",
        "keywords" => "Europe, îles, Santorin, Mykonos, Athènes, antiquité",
        "stars" => 5,
        "sensation" => "petites",
        "landscape" => "nature",
        "departure_dates" => ['2025-04-01', '2025-05-15']
    ],
    [
        "name" => "Cuba",
        "link" => "cuba-activites.php",
        "img"  => "https://th.bing.com/th/id/R.2d671e508b442feb3d40e67d14ee4827?rik=RTv1eCgRqtQCZA&pid=ImgRaw&r=0",
        "alt"  => "Cuba",
        "description" => "Vibrez au rythme de la salsa dans ce pays coloré et authentique.",
        "keywords" => "Caraïbes, La Havane, plage, musique, culture, vintage",
        "stars" => 5,
        "sensation" => "petites",
        "landscape" => "nature",
        "departure_dates" => ['2025-04-01', '2025-05-15']
    ],
    [
        "name" => "Albanie",
        "link" => "albanie-activites.php",
        "img"  => "https://cdn.generationvoyage.fr/2023/10/Albanie.jpeg",
        "alt"  => "Albanie",
        "description" => "Joyau méconnu des Balkans aux paysages préservés et sauvages.",
        "keywords" => "Europe, Balkans, montagne, plage, Riviera albanaise",
        "stars" => 5,
        "sensation" => "moyennes",
        "landscape" => "nature",
        "departure_dates" => ['2025-04-01', '2025-05-15']
    ],
    [
        "name" => "Espagne",
        "link" => "espagne-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.xL0rh_osRnKzs8TShA1O-gHaE8?rs=1&pid=ImgDetMain",
        "alt"  => "Espagne",
        "description" => "Entre fêtes animées, architecture avant-gardiste et plages ensoleillées.",
        "keywords" => "Europe, Barcelone, Madrid, Costa Brava, fêtes, Gaudí",
        "stars" => 5,
        "sensation" => "moyennes",
        "landscape" => "ville",
        "departure_dates" => ['2025-04-01', '2025-05-15']
    ],
    [
        "name" => "Nouvelle-Zélande",
        "link" => "nouvelle-zelande-activites.php",
        "img"  => "https://th.bing.com/th/id/R.0219439a4cf67cdde21e9dda7457b53c?rik=KHP7iZOilHsTjw&pid=ImgRaw&r=0",
        "alt"  => "Nouvelle-Zélande",
        "description" => "Nature préservée et activités extrêmes dans des décors de films.",
        "keywords" => "Océanie, aventure, nature, Lord of the Rings, randonnée",
        "stars" => 5,
        "sensation" => "moyennes",
        "landscape" => "nature",
        "departure_dates" => ['2025-04-01', '2025-05-15']
    ],
    [
        "name" => "Suisse",
        "link" => "suisse-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.2dY611ZOCesq71t4k2ZQjwHaFM?rs=1&pid=ImgDetMain",
        "alt"  => "Suisse",
        "description" => "Lacs alpins, sommets enneigés et villes au charme intact.",
        "keywords" => "Europe, Alpes, montagne, ski, chocolat, précision",
        "stars" => 5,
        "sensation" => "moyennes",
        "landscape" => "nature",
        "departure_dates" => ['2025-04-01', '2025-05-15']
    ],
    [
        "name" => "Costa Rica",
        "link" => "costa-rica-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.IstccuQIi-5ZW72OqE2CBwHaE8?rs=1&pid=ImgDetMain",
        "alt"  => "Costa Rica",
        "description" => "Pionnier de l'écotourisme avec une biodiversité exceptionnelle.",
        "keywords" => "Amérique centrale, jungle, plage, tortues, aventure, écologie",
        "stars" => 5,
        "sensation" => "moyennes",
        "landscape" => "nature",
        "departure_dates" => ['2025-04-01', '2025-05-15']
    ],
    [
        "name" => "Népal",
        "link" => "nepal-activites.php",
        "img"  => "https://static1.evcdn.net/cdn-cgi/image/width=3840,height=3072,quality=70,fit=crop/offer/raw/2024/11/18/ff3749bb-5216-43ed-9df3-3fbb3c91996b.jpg",
        "alt"  => "Népal",
        "description" => "Terre des montagnes majestueuses et de la spiritualité bouddhiste.",
        "keywords" => "Asie, Himalaya, Everest, trekking, spiritualité, Katmandou",
        "stars" => 5,
        "sensation" => "extremes",
        "landscape" => "montagne",
        "departure_dates" => ['2025-04-01', '2025-05-15']
    ],
    [
        "name" => "Afrique du Sud",
        "link" => "afrique-du-sud-activites.php",
        "img"  => "https://th.bing.com/th/id/R.8d6dec68ed3fc9d1d69d05f4ec8cfd65?rik=35qeT1PhTAOOnQ&pid=ImgRaw&r=0",
        "alt"  => "Afrique du Sud",
        "description" => "Safaris inoubliables et paysages à couper le souffle.",
        "keywords" => "Afrique, safari, Cap Town, animaux, vin, nature",
        "stars" => 5,
        "sensation" => "extremes",
        "landscape" => "nature",
        "departure_dates" => ['2025-04-01', '2025-05-15']
    ],
    [
        "name" => "Indonésie",
        "link" => "indonesie-activites.php",
        "img"  => "https://th.bing.com/th/id/R.4a165d41b616b501e890adfdc06fb62a?rik=QTSulegN%2bOOVOw&pid=ImgRaw&r=0",
        "alt"  => "Indonésie",
        "description" => "Archipel aux mille îles entre volcans, rizières et plages de rêve.",
        "keywords" => "Asie, Bali, Java, plage, surf, culture, aventure",
        "stars" => 5,
        "sensation" => "extremes",
        "landscape" => "plage",
        "departure_dates" => ['2025-04-01', '2025-05-15']
    ],
    [
        "name" => "Japon",
        "link" => "japon-activites.php",
        "img"  => "https://th.bing.com/th/id/OIP.7CVJ2d29GvD0CjmojqgOQAHaE8?rs=1&pid=ImgDetMain",
        "alt"  => "Japon",
        "description" => "Harmonie unique entre traditions ancestrales et innovations futuristes.",
        "keywords" => "Asie, Tokyo, Kyoto, mont Fuji, technologie, culture",
        "stars" => 5,
        "sensation" => "extremes",
        "landscape" => "nature",
        "departure_dates" => ['2025-04-01', '2025-05-15']
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
        "landscape" => "nature",
        "departure_dates" => ['2025-04-01', '2025-05-15']
    ]
];


$search_term = $_GET['search'] ?? '';
$stars = $_GET['stars'] ?? '';
$departure_date = $_GET['departure_date'] ?? '';
$sensation = $_GET['sensation'] ?? '';
$landscape = $_GET['landscape'] ?? '';


$filtered_countries = array_filter($countries, function($country) use ($search_term, $stars, $departure_date, $sensation, $landscape) {
    
    if (!empty($search_term)) {
        $search_in = $country['name'] . ' ' . $country['description'] . ' ' . $country['keywords'];
        if (stripos($search_in, $search_term) === false) {
            return false;
        }
    }
    
    
    if (!empty($stars) && $country['stars'] != $stars) {
        return false;
    }
    
    
    if (!empty($sensation) && $country['sensation'] != $sensation) {
        return false;
    }
    
    
    if (!empty($landscape) && $country['landscape'] != $landscape) {
        return false;
    }
    
    
    if (!empty($departure_date) && !in_array($departure_date, $country['departure_dates'])) {
        return false;
    }
    
    return true;
});

if (empty($search_term) && empty($stars) && empty($departure_date) && empty($sensation) && empty($landscape)) {
    $filtered_countries = $countries;
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
    <link rel="stylesheet" href="recherche.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="presentation.php">Présentation</a></li>
            <li><a href="quisommesnous.php">Qui sommes-nous</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li>
                <?php if (isset($_SESSION['username'])) : ?>
                    <a href="profil.php" class="login-btn no-effect">Profil (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
                <?php else : ?>
                    <a href="connexion.php" class="login-btn no-effect">Connexion</a>
                <?php endif; ?>
            </li>
            <li><a href="recherche.php"><i class="fas fa-search search-icon"></i></a></li>
        </ul>
    </nav>

    <header>
        <h1 class="main-title">Explorez le Monde</h1>
    </header>

    <div class="search-container">
        <form method="GET" action="recherche.php" class="search-bar">
            <input type="text" name="search" placeholder="Rechercher un pays, une description ou des mots-clés..." value="<?= htmlspecialchars($search_term) ?>">
            
            <select name="stars">
                <option value="">Nombre d'étoiles</option>
                <option value="1" <?= $stars == '1' ? 'selected' : '' ?>>1 étoile</option>
                <option value="2" <?= $stars == '2' ? 'selected' : '' ?>>2 étoiles</option>
                <option value="3" <?= $stars == '3' ? 'selected' : '' ?>>3 étoiles</option>
                <option value="4" <?= $stars == '4' ? 'selected' : '' ?>>4 étoiles</option>
                <option value="5" <?= $stars == '5' ? 'selected' : '' ?>>5 étoiles</option>
            </select>
            
            <input type="date" name="departure_date" placeholder="Date de départ" value="<?= htmlspecialchars($departure_date) ?>">
            
            <select name="sensation">
                <option value="">Sensations</option>
                <option value="petites" <?= $sensation == 'petites' ? 'selected' : '' ?>>Petites sensations</option>
                <option value="moyennes" <?= $sensation == 'moyennes' ? 'selected' : '' ?>>Moyennes sensations</option>
                <option value="extremes" <?= $sensation == 'extremes' ? 'selected' : '' ?>>Sensations extrêmes</option>
            </select>
            
            <select name="landscape">
                <option value="">Type de paysage</option>
                <option value="montagne" <?= $landscape == 'montagne' ? 'selected' : '' ?>>Montagne</option>
                <option value="plage" <?= $landscape == 'plage' ? 'selected' : '' ?>>Plage</option>
                <option value="ville" <?= $landscape == 'ville' ? 'selected' : '' ?>>Ville</option>
                <option value="nature" <?= $landscape == 'nature' ? 'selected' : '' ?>>Nature</option>
            </select>
            
            <button type="submit">Rechercher</button>
            <a href="recherche.php" class="reset-btn">Réinitialiser</a>
        </form>
    </div>

    <main>
        <div class="results-grid">
            <?php if (empty($filtered_countries)) : ?>
                <p class="no-results">Aucun résultat trouvé pour votre recherche.</p>
            <?php else : ?>
                <?php foreach ($filtered_countries as $country) : ?>
                    <a href="<?= $country['link'] ?>" class="country-card">
                        <img src="<?= htmlspecialchars($country['img']) ?>" alt="<?= htmlspecialchars($country['alt']) ?>">
                        <div class="country-info">
                            <h3 class="country-name"><?= htmlspecialchars($country['name']) ?></h3>
                            <div class="country-stars">
                                <?php for ($i = 0; $i < $country['stars']; $i++) : ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="country-description"><?= htmlspecialchars($country['description']) ?></p>
                            <div class="country-tags">
                                <span class="tag sensation-<?= $country['sensation'] ?>">
                                    <?= ucfirst($country['sensation']) ?> sensations
                                </span>
                                <span class="tag landscape-<?= $country['landscape'] ?>">
                                    <?= ucfirst($country['landscape']) ?>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
</body>
</html>