<?php

session_start();


$username = $_SESSION['username'] ?? null;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['offre_speciale'])) {

    $_SESSION['activites_selectionnees'] = [
        'dauphins' => 'Nager avec des dauphins',
        'grottes' => 'Visite des grottes en bateau',
        'douro' => 'Croisière dans la Vallée du Douro'
    ];
    
    header("Location: date.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="index.css">
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
        <section class="grid-section">
            <h2>Nos Types de Voyages</h2>
            <p class="subtitle">Découvrez nos trois niveaux de voyages adaptés à vos envies d'aventure.</p>
            <a href="destinations.php" class="destination-item">
                <img src="https://i.pinimg.com/736x/4a/c9/3e/4ac93e58c1e040e53727a8d98c2b2c8b.jpg" alt="Voyage à petites sensations">
                <p>Voyage à petites sensations</p>
                <div class="danger-meter">
                    <div class="danger-fill" style="width: 30%"></div>
                </div>
                <div class="description">
                    Découvrez les villes emblématiques du monde avec nos guides experts. Parfait pour ceux qui cherchent à explorer les richesses culturelles et historiques des grandes métropoles.
                </div>
            </a>

            <a href="destinations2.php" class="destination-item">
                <img src="https://i.pinimg.com/736x/79/f4/f0/79f4f037ac23f73df28466d2f46e017e.jpg" alt="Voyage à moyennes sensations">
                <p>Voyage à moyennes sensations</p>
                <div class="danger-meter">
                    <div class="danger-fill" style="width: 60%"></div>
                </div>
                <div class="description">
                    Offrez-vous une escapade romantique dans des lieux idylliques. Dîners aux chandelles, balades au clair de lune et moments inoubliables vous attendent.
                </div>
            </a>

            <a href="destinations3.php" class="destination-item">
                <img src="https://i.pinimg.com/736x/68/84/78/68847893e0c4e21622bb0b43f00125a4.jpg" alt="Voyage à sensations Extrêmes">
                <p>Voyage à sensations EXTREMES</p>
                <div class="danger-meter">
                    <div class="danger-fill" style="width: 100%"></div>
                </div>
                <div class="description">
                    Pour les amateurs de sensations fortes, explorez des destinations où l'adrénaline est au rendez-vous. Rafting, saut à l'élastique, et bien plus encore !
                </div>
            </a>
        </section>

        <section class="favorite-trip">
            <h2>Notre coup de coeur ❤️</h2>
            <div class="image-grid">
                <figure>
                    <img src="https://experiencesdumonde.fr/wp-content/uploads/2023/06/shutterstock_1120216298.jpg" alt="Tokyo 1">
                    <figcaption>Wingsuit au Mont Fuji</figcaption>
                </figure>
                <figure>
                    <img src="https://images.unsplash.com/photo-1492571350019-22de08371fd3?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cGF5c2FnZSUyMGphcG9uYWlzfGVufDB8fDB8fHww" alt="Tokyo 2">
                    <figcaption>Affronter un ours brun en 'battle mode'</figcaption>
                </figure>
                <figure>
                    <img src="https://images.photowall.com/products/52933/snowboarder-backflip.jpg?h=699&q=85" alt="Tokyo 3">
                    <figcaption>Snowboard sur les pentes du Mt. Yotei</figcaption>
                </figure>
            </div>
            <p><strong>DESTINATION:</strong> JAPON</p>
            <div class="description">
                Plongez dans l'univers fascinant du Japon, où tradition et modernité se rencontrent. Découvrez des temples anciens et toutes ces activités exceptionnelles qui vous attendent.
            </div>
            <a href="japon-activites.php" class="btn">DÉCOUVRIR</a>
        </section>

        <section class="special-offer">
            <h2>OFFRE DU MOMENT</h2>
            <p>Profitez de notre offre spéciale limitée dans le temps ! Une expérience unique à prix réduit.</p>

            <div class="offer-content">
                <div class="offer-image">
                    <img src="https://voyages.euromoselleloisirs.fr/wp-content/uploads/2024/11/Lisbonne-3-scaled.jpeg" alt="Offre Spéciale">
                </div>

                <div class="offer-details">
                    <h3>Vallée du Douro - Expérience Premium</h3>
                    <p>Découvrez les paysages époustouflants de la vallée du Douro avec notre forfait tout inclus :</p>
                    <ul>
                        <li>Nager avec des dauphins</li>
                        <li>Visite des grottes en bateau</li>
                        <li>Croisière dans la Vallée du Douro</li>
                    </ul>
                    <div class="offer-price">
                        350€<span>410€</span>
                    </div>
                    <p class="description">
                        Profitez d'une expérience unique dans l'une des plus belles régions viticoles du monde. 
                        Cette offre inclut des activités exclusives et un hébergement de luxe pour un séjour inoubliable.
                    </p>
                    <form method="POST" action="">
                        <input type="hidden" name="offre_speciale" value="1">
                        <button type="submit" class="btn">DÉCOUVRIR</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
</body>
</html>