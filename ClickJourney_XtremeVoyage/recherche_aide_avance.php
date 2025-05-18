<?php
// Liste des pays avec leurs informations (nom, lien, image, description, mots-clés)
$countries = [
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

$search_term = $_GET['search'] ?? ''; // Terme de recherche saisi par l'utilisateur
$stars = $_GET['stars'] ?? ''; // Filtre par nombre d'étoiles
$sensation = $_GET['sensation'] ?? ''; // Filtre par type de sensations
$landscape = $_GET['landscape'] ?? ''; // Filtre par type de paysage
$continent = $_GET['continent'] ?? ''; // Filtre par continent

// Filtrage des pays en fonction des critères de recherche
$filtered_countries = array_filter($countries, function($country) use ($search_term, $stars, $sensation, $landscape, $continent) {
    // Vérifie si le terme de recherche correspond au nom, description ou mots-clés
    if ($search_term !== '' && stripos($country['name'] . ' ' . $country['description'] . ' ' . $country['keywords'], $search_term) === false) {
        return false;
    }
    // Vérifie si le nombre d'étoiles correspond
    if ($stars !== '' && $country['stars'] != $stars) return false;
    // Vérifie si le type de sensations correspond
    if ($sensation !== '' && $country['sensation'] != $sensation) return false;
    // Vérifie si le type de paysage correspond
    if ($landscape !== '' && $country['landscape'] != $landscape) return false;
    // Vérifie si le continent correspond
    if ($continent !== '' && $country['continent'] != $continent) return false;
    return true; // Le pays correspond à tous les critères
});

// Affichage des résultats
if (empty($filtered_countries)) {
    // Message si aucun résultat ne correspond à la recherche
    echo "<p class='no-results'>Aucun résultat trouvé pour votre recherche.</p>";
} else {
    // Parcourt les pays filtrés et génère le HTML pour chaque pays
    foreach ($filtered_countries as $country) {
        echo '
        <form method="POST" action="" class="country-form">
            <input type="hidden" name="pays" value="' . htmlspecialchars($country['name']) . '">
            <button type="submit" class="country-card">
                <img src="' . htmlspecialchars($country['img']) . '" alt="' . htmlspecialchars($country['alt']) . '">
                <div class="country-info">
                    <h3 class="country-name">' . htmlspecialchars($country['name']) . '</h3>
                    <div class="country-stars">';
        // Ajoute des icônes d'étoiles en fonction du nombre d'étoiles
        for ($i = 0; $i < $country['stars']; $i++) echo '<i class="fas fa-star"></i>';
        echo    '</div>
                    <p class="country-description">' . htmlspecialchars($country['description']) . '</p>
                    <div class="country-tags">
                        <!-- Affiche les tags pour les sensations et le paysage -->
                        <span class="tag sensation-' . $country['sensation'] . '">' . ucfirst($country['sensation']) . ' sensations</span>
                        <span class="tag landscape-' . $country['landscape'] . '">' . ucfirst($country['landscape']) . '</span>
                    </div>
                </div>
            </button>
        </form>';
    }
}
