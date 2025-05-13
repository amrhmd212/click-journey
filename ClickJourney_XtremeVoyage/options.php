<?php

session_start();

$username = $_SESSION['username'] ?? null;

$paysSelectionne = $_SESSION['pays_selectionne'] ?? '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['vol'])) {
        $_SESSION['vol'] = $_POST['vol'];
        $_SESSION['prix_vol'] = isset($_POST['prix_vol']) ? floatval($_POST['prix_vol']) : 0;
    }
    if (isset($_POST['vol_retour'])) {
        $_SESSION['vol_retour'] = $_POST['vol_retour'];
        $_SESSION['prix_vol_retour'] = isset($_POST['prix_vol_retour']) ? floatval($_POST['prix_vol_retour']) : 0;
    }



    if (isset($_POST['hotel'])) {
        $_SESSION['hotel'] = $_POST['hotel'];
        $_SESSION['prix_hotel'] = isset($_POST['prix_hotel']) ? floatval($_POST['prix_hotel']) : 0;
    }

    if (isset($_POST['service'])) {
        $service = $_POST['service'];
        $prix_service = isset($_POST['prix_service']) ? floatval($_POST['prix_service']) : 0;

        if (!isset($_SESSION['options_supplementaires'])) {
            $_SESSION['options_supplementaires'] = [];
        }

        $dejaAjoute = false;
        foreach ($_SESSION['options_supplementaires'] as $opt) {
            if ($opt['nom'] === $service) {
                $dejaAjoute = true;
                break;
            }
        }

        if (!$dejaAjoute) {
            $_SESSION['options_supplementaires'][] = [
                'nom' => $service,
                'prix' => $prix_service
            ];
        }
    }

    if (isset($_POST['go_to_recap'])) {
        if (empty($_SESSION['vol']) || empty($_SESSION['hotel']) || empty($_SESSION['vol_retour'])) {
            $erreur = "Veuillez sélectionner un vol aller, un vol retour et un hôtel avant de continuer.";
        } else {
            header("Location: recap.php");
            exit;
        }
    }

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horaires d'avion et Choix d'Hôtel - Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="option.css">
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
        <h1 class="main-title">Voyages et Hôtels</h1>
    </header>

    <main>

        <?php if (!empty($erreur)) : ?>
        <div class="message-erreur">
        <?php echo htmlspecialchars          ($erreur); ?>
        </div>
        <?php endif; ?>
        <div class="container">
            <div class="section-title">Horaires d'Avion depuis Paris</div>
            <div class="card-container">
                <form method="POST" class="option-form" data-type="vol">
                    <div class="schedule-item">
                        <img src="https://th.bing.com/th/id/OIP.z_5GW1akknUaQdS3XdN-hQHaFE?rs=1&pid=ImgDetMain" alt="Paris (CDG) → <?php echo htmlspecialchars($paysSelectionne); ?>">
                        <h3>Paris (CDG) → <?php echo htmlspecialchars($paysSelectionne); ?></h3>
                        <p>Départ : 08:00 - Arrivée : 11:00</p>
                        <p>Compagnie : Air France</p>
                        <div class="price-tag">599€</div>
                        <input type="hidden" name="vol" value="Vol 1 - Paris (CDG) à <?php echo htmlspecialchars($paysSelectionne); ?> - 08:00-11:00 - Air France">
                        <input type="hidden" name="prix_vol" value="599">
                        <button type="button" class="select-btn js-select-option">Sélectionner</button>
                    </div>
                </form>

                <form method="POST" class="option-form" data-type="vol">
                    <div class="schedule-item">
                        <img src="https://th.bing.com/th/id/OIP.vGoEKHSkX9Boje3wcbwPMQHaE8?rs=1&pid=ImgDetMain" alt="Paris (ORY) → <?php echo htmlspecialchars($paysSelectionne); ?>">
                        <h3>Paris (ORY) → <?php echo htmlspecialchars($paysSelectionne); ?></h3>
                        <p>Départ : 12:30 - Arrivée : 15:30</p>
                        <p>Compagnie : EasyJet</p>
                        <div class="price-tag">429€</div>
                        <input type="hidden" name="vol" value="Vol 2 - Paris (ORY) à <?php echo htmlspecialchars($paysSelectionne); ?> - 12:30-15:30 - EasyJet">
                        <input type="hidden" name="prix_vol" value="429">
                        <button type="button" class="select-btn js-select-option">Sélectionner</button>
                    </div>
                </form>

                <form method="POST" class="option-form" data-type="vol">
                    <div class="schedule-item">
                        <img src="https://th.bing.com/th/id/OIP.O55q5-Xvhdkb9Cmkn9cvhAHaE8?rs=1&pid=ImgDetMain" alt="Paris (CDG) → <?php echo htmlspecialchars($paysSelectionne); ?>">
                        <h3>Paris (CDG) → <?php echo htmlspecialchars($paysSelectionne); ?></h3>
                        <p>Départ : 18:45 - Arrivée : 22:15 (+1 escale)</p>
                        <p>Compagnie : Lufthansa</p>
                        <div class="price-tag">379€</div>
                        <input type="hidden" name="vol" value="Vol 3 - Paris (CDG) à <?php echo htmlspecialchars($paysSelectionne); ?> - 18:45-22:15 - Lufthansa">
                        <input type="hidden" name="prix_vol" value="379">
                        <button type="button" class="select-btn js-select-option">Sélectionner</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="container">
            <div class="section-title">Horaires d'Avion Retour depuis <?php echo htmlspecialchars($paysSelectionne); ?> vers Paris</div>
            <div class="card-container">

                <form method="POST" class="option-form" data-type="vol_retour">
                    <div class="schedule-item">
                        <img src="https://th.bing.com/th/id/OIP.z_5GW1akknUaQdS3XdN-hQHaFE?rs=1&pid=ImgDetMain" alt="<?php echo htmlspecialchars($paysSelectionne); ?> → Paris">
                        <h3><?php echo htmlspecialchars($paysSelectionne); ?> → Paris (CDG)</h3>
                        <p>Départ : 10:00 - Arrivée : 13:00</p>
                        <p>Compagnie : TAP Portugal</p>
                        <div class="price-tag">560€</div>
                        <input type="hidden" name="vol_retour" value="Retour - <?php echo htmlspecialchars($paysSelectionne); ?> à Paris (CDG) - 10:00-13:00 - TAP Portugal">
                        <input type="hidden" name="prix_vol_retour" value="560">
                        <button type="button" class="select-btn js-select-option">Sélectionner</button>
                    </div>
                </form>

                <form method="POST" class="option-form" data-type="vol_retour">
                    <div class="schedule-item">
                        <img src="https://th.bing.com/th/id/OIP.vGoEKHSkX9Boje3wcbwPMQHaE8?rs=1&pid=ImgDetMain" alt="<?php echo htmlspecialchars($paysSelectionne); ?> → Paris">
                        <h3><?php echo htmlspecialchars($paysSelectionne); ?> → Paris (ORY)</h3>
                        <p>Départ : 16:15 - Arrivée : 19:00</p>
                        <p>Compagnie : Transavia</p>
                        <div class="price-tag">370€</div>
                        <input type="hidden" name="vol_retour" value="Retour - <?php echo htmlspecialchars($paysSelectionne); ?> à Paris (ORY) - 16:15-19:00 - Transavia">
                        <input type="hidden" name="prix_vol_retour" value="370">
                        <button type="button" class="select-btn js-select-option">Sélectionner</button>
                    </div>
                </form>

                <form method="POST" class="option-form" data-type="vol_retour">
                    <div class="schedule-item">
                        <img src="https://th.bing.com/th/id/OIP.O55q5-Xvhdkb9Cmkn9cvhAHaE8?rs=1&pid=ImgDetMain" alt="<?php echo htmlspecialchars($paysSelectionne); ?> → Paris">
                        <h3><?php echo htmlspecialchars($paysSelectionne); ?> → Paris (CDG)</h3>
                        <p>Départ : 21:45 - Arrivée : 00:50 (+1 jour)</p>
                        <p>Compagnie : Lufthansa</p>
                        <div class="price-tag">430€</div>
                        <input type="hidden" name="vol_retour" value="Retour - <?php echo htmlspecialchars($paysSelectionne); ?> à Paris (CDG) - 21:45-00:50 - Lufthansa">
                        <input type="hidden" name="prix_vol_retour" value="430">
                        <button type="button" class="select-btn js-select-option">Sélectionner</button>
                    </div>
                </form>

            </div>
        </div>


        <div class="container">
            <div class="section-title">Choix d'Hôtel</div>
            <?php
            switch (strtolower($paysSelectionne)) {
                case 'portugal':
                    ?>
                    <div class="country-section">
                        <h2>Portugal</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/21303863.jpg?k=8b47126ea3a4eb6ff7a5daa143023504116535d6019a1f4615bf5f474be14771&o=&hp=1" alt="Hotel Avenida Palace">
                                    <h3>Hotel Avenida Palace</h3>
                                    <p>Un hôtel 5 étoiles avec des chambres luxueuses et des installations de qualité, idéal pour les voyageurs exigeants.</p>
                                    <div class="price-tag">250€/nuit</div>
                                    <input type="hidden" name="hotel" value="Hotel Avenida Palace - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="250">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQw1vwdig6dTpkGLUOtHXTuDgt6dLZic3cDhg&s" alt="Hotel Da Baixa">
                                    <h3>Hotel Da Baixa</h3>
                                    <p>Un hôtel 4 étoiles avec des chambres modernes et un emplacement idéal en plein cœur de la ville.</p>
                                    <div class="price-tag">180€/nuit</div>
                                    <input type="hidden" name="hotel" value="Hotel Da Baixa - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="180">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/21/ed/cc/54/blue-liberdade-hotel.jpg?w=700&h=-1&s=1" alt="Blue Liberdade Hotel">
                                    <h3>Blue Liberdade Hotel</h3>
                                    <p>Un hôtel 3 étoiles offrant des chambres confortables et un service attentionné, idéal pour les voyageurs d'affaires.</p>
                                    <div class="price-tag">120€/nuit</div>
                                    <input type="hidden" name="hotel" value="Blue Liberdade Hotel - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="120">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;

                case 'italie':
                    ?>
                    <div class="country-section">
                        <h2>Italie</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/437276874.jpg?k=5c2b45ff78a21c473d6629e578c59249333d2c0ec6b3d2235e72bc862c4e93fd&o=&hp=1" alt="Singer Palace Hotel">
                                    <h3>Singer Palace Hotel</h3>
                                    <p>Un hôtel 5 étoiles avec des chambres luxueuses et des vues imprenables sur la ville.</p>
                                    <div class="price-tag">280€/nuit</div>
                                    <input type="hidden" name="hotel" value="Singer Palace Hotel - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="280">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0a/96/aa/1f/exterior-hotel-facade.jpg?w=700&h=-1&s=1" alt="Hotel Artemide">
                                    <h3>Hotel Artemide</h3>
                                    <p>Un hôtel 4 étoiles avec des chambres élégantes et un emplacement idéal en plein cœur de la ville.</p>
                                    <div class="price-tag">190€/nuit</div>
                                    <input type="hidden" name="hotel" value="Hotel Artemide - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="190">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/03/bc/10/c7/castello-delle-serre.jpg?w=700&h=-1&s=1" alt="Castello delle Serre">
                                    <h3>Castello delle Serre</h3>
                                    <p>Un hôtel 3 étoiles charmant avec des chambres confortables et une ambiance chaleureuse.</p>
                                    <div class="price-tag">130€/nuit</div>
                                    <input type="hidden" name="hotel" value="Castello delle Serre - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="130">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;

                case 'népal':
                case 'nepal':
                    ?>
                    <div class="country-section">
                        <h2>Népal</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/02/4d/7f/f5/hotel-exterior-crowne.jpg?w=700&h=-1&s=1" alt="The Soaltee Kathmandu">
                                    <h3>The Soaltee Kathmandu</h3>
                                    <p>Un hôtel 5 étoiles situé à Kathmandu, offrant un luxe inégalé et des vues imprenables sur la ville.</p>
                                    <div class="price-tag">220€/nuit</div>
                                    <input type="hidden" name="hotel" value="The Soaltee Kathmandu - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="220">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/55121596.jpg?k=c9d5e7de311b29988e8b41dbe63f719f065fc1cdeac945e6407d200182ee0ede&o=&hp=1" alt="Hotel Shambala">
                                    <h3>Hotel Shambala</h3>
                                    <p>Un hôtel 4 étoiles avec des chambres confortables et un service exceptionnel, idéal pour les voyageurs d'affaires et les touristes.</p>
                                    <div class="price-tag">160€/nuit</div>
                                    <input type="hidden" name="hotel" value="Hotel Shambala - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="160">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/221714262.jpg?k=ab7348e5fe9e13097fb72957b0fb8a4141a2e26bdbaf7200ec678472f2393044&o=&hp=1" alt="Oasis Kathmandu Hotel">
                                    <h3>Oasis Kathmandu Hotel</h3>
                                    <p>Un hôtel 3 étoiles offrant un excellent rapport qualité-prix, parfait pour les voyageurs à la recherche de confort et de commodité.</p>
                                    <div class="price-tag">110€/nuit</div>
                                    <input type="hidden" name="hotel" value="Oasis Kathmandu Hotel - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="110">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;

                case 'afrique-du-sud':
                    ?>
                    <div class="country-section">
                        <h2>Afrique du Sud</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/426519909.jpg?k=fefdd2161f5195539fa237b7d08205ea6d7cd53a903a8bc942d6ccf38778c506&o=&hp=1" alt="Kapama River Lodge">
                                    <h3>Kapama River Lodge</h3>
                                    <p>Un lodge 5 étoiles situé dans une réserve naturelle, offrant des safaris et des expériences de luxe.</p>
                                    <div class="price-tag">350€/nuit</div>
                                    <input type="hidden" name="hotel" value="Kapama River Lodge - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="350">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/14/b5/06/76/kariega-main-lodge.jpg?w=700&h=-1&s=1" alt="Kariega Game Reserve">
                                    <h3>Kariega Game Reserve</h3>
                                    <p>Une réserve de jeu 4 étoiles avec des hébergements confortables et des safaris guidés.</p>
                                    <div class="price-tag">250€/nuit</div>
                                    <input type="hidden" name="hotel" value="Kariega Game Reserve - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="250">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/70/a4/cc/caption.jpg?w=700&h=-1&s=1" alt="Agulhas Ocean House">
                                    <h3>Agulhas Ocean House</h3>
                                    <p>Un hôtel 3 étoiles situé près de la plage, offrant des vues magnifiques sur l'océan et un service chaleureux.</p>
                                    <div class="price-tag">150€/nuit</div>
                                    <input type="hidden" name="hotel" value="Agulhas Ocean House - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="150">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;

                case 'indonésie':
                case 'indonesie':
                    ?>
                    <div class="country-section">
                        <h2>Indonésie</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/14/a5/8b/9a/the-kayon-jungle-resort.jpg?w=700&h=-1&s=1" alt="The Kayon Jungle Resort">
                                    <h3>The Kayon Jungle Resort</h3>
                                    <p>Un resort 5 étoiles niché dans la jungle, offrant une expérience unique et luxueuse.</p>
                                    <div class="price-tag">320€/nuit</div>
                                    <input type="hidden" name="hotel" value="The Kayon Jungle Resort - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="320">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/545568471.jpg?k=c9c049e1c68fd78bf3114fec82befcccb81e52541014c45488d049906feee33c&o=&hp=1" alt="The Alena Resort">
                                    <h3>The Alena Resort</h3>
                                    <p>Un resort 4 étoiles avec des chambres modernes et des installations de qualité, parfait pour les familles et les couples.</p>
                                    <div class="price-tag">220€/nuit</div>
                                    <input type="hidden" name="hotel" value="The Alena Resort - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="220">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/28/5a/87/64/hotel-santika-batam.jpg?w=700&h=-1&s=1" alt="Hotel Santika Batam">
                                    <h3>Hotel Santika Batam</h3>
                                    <p>Un hôtel 3 étoiles offrant des chambres confortables et un service attentionné, idéal pour les voyageurs d'affaires.</p>
                                    <div class="price-tag">140€/nuit</div>
                                    <input type="hidden" name="hotel" value="Hotel Santika Batam - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="140">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;

                case 'états-unis':
                case 'etats-unis':
                case 'usa':
                    ?>
                    <div class="country-section">
                        <h2>États-Unis</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1c/a0/ee/0d/solage-auberge-resorts.jpg?w=700&h=-1&s=1" alt="Solage, Auberge Resorts">
                                    <h3>Solage, Auberge Resorts</h3>
                                    <p>Un resort 5 étoiles offrant des chambres luxueuses, des spas et des restaurants gastronomiques.</p>
                                    <div class="price-tag">400€/nuit</div>
                                    <input type="hidden" name="hotel" value="Solage, Auberge Resorts - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="400">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://pics.tui.com/pics/pics1600x1200/tui/c/c774b52d-c4fc-4f0a-a7f5-8dbfb93cb680.jpg" alt="Shore Hotel">
                                    <h3>Shore Hotel</h3>
                                    <p>Un hôtel 4 étoiles en bord de mer avec des chambres modernes et des vues imprenables sur l'océan.</p>
                                    <div class="price-tag">280€/nuit</div>
                                    <input type="hidden" name="hotel" value="Shore Hotel - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="280">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/142447747.jpg?k=b091d5e07f23917d94bf59c81a3ec8b0723674cdd832fadc0844cb1128a31699&o=&hp=1" alt="Chancellor Hotel">
                                    <h3>Chancellor Hotel</h3>
                                    <p>Un hôtel 3 étoiles offrant des chambres confortables et un service attentionné, idéal pour les voyageurs d'affaires.</p>
                                    <div class="price-tag">180€/nuit</div>
                                    <input type="hidden" name="hotel" value="Chancellor Hotel - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="180">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;

                case 'albanie':
                    ?>
                    <div class="country-section">
                        <h2>Albanie</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2d/ec/d3/ab/exterior.jpg?w=700&h=-1&s=1" alt="Rogner Hotel Tirana">
                                    <h3>Rogner Hotel Tirana</h3>
                                    <p>Un hôtel 5 étoiles avec des chambres luxueuses et des installations de qualité, parfait pour les voyageurs exigeants.</p>
                                    <div class="price-tag">200€/nuit</div>
                                    <input type="hidden" name="hotel" value="Rogner Hotel Tirana - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="200">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://www.hotelmondialparis.com/wp-content/uploads/2017/03/Hotel-Mondial-Paris-Facade-1.jpg" alt="Hotel Mondial">
                                    <h3>Hotel Mondial</h3>
                                    <p>Un hôtel 4 étoiles offrant des chambres modernes et un service attentionné, idéal pour les voyageurs d'affaires et les touristes.</p>
                                    <div class="price-tag">150€/nuit</div>
                                    <input type="hidden" name="hotel" value="Hotel Mondial - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="150">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1c/fe/96/6e/hotel-mangalemi.jpg?w=700&h=-1&s=1" alt="Hotel Mangalemi">
                                    <h3>Hotel Mangalemi</h3>
                                    <p>Un hôtel 3 étoiles charmant avec des chambres confortables et une ambiance accueillante.</p>
                                    <div class="price-tag">100€/nuit</div>
                                    <input type="hidden" name="hotel" value="Hotel Mangalemi - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="100">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;

                case 'espagne':
                    ?>
                    <div class="country-section">
                        <h2>Espagne</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://static-resources-elementor.mirai.com/wp-content/uploads/sites/888/home-01-cabecera-mobile-1-1.jpg" alt="Hotel Suite Villa Maria">
                                    <h3>Hotel Suite Villa Maria</h3>
                                    <p>Un hôtel 5 étoiles avec des suites luxueuses et des jardins magnifiques, offrant une expérience inoubliable.</p>
                                    <div class="price-tag">270€/nuit</div>
                                    <input type="hidden" name="hotel" value="Hotel Suite Villa Maria - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="270">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://z.cdrst.com/foto/hotel-sf/71d3a2f/hotelgallery/foto-hotel-71d2f85.jpg" alt="Hotel Gravina 51">
                                    <h3>Hotel Gravina 51</h3>
                                    <p>Un hôtel 4 étoiles avec des chambres élégantes et un emplacement idéal en plein cœur de la ville.</p>
                                    <div class="price-tag">190€/nuit</div>
                                    <input type="hidden" name="hotel" value="Hotel Gravina 51 - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="190">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/16/62/2d/5c/ingang.jpg?w=700&h=-1&s=1" alt="La Posada Del Angel">
                                    <h3>La Posada Del Angel</h3>
                                    <p>Un hôtel 3 étoiles charmant avec des chambres confortables et une ambiance chaleureuse.</p>
                                    <div class="price-tag">130€/nuit</div>
                                    <input type="hidden" name="hotel" value="La Posada Del Angel - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="130">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;

                case 'nouvelle-zélande':
                case 'nouvelle zelande':
                    ?>
                    <div class="country-section">
                        <h2>Nouvelle-Zélande</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://www.cordishotels.com/content/dam/cordishotels/dynamicmedia/global/cordis_global/destinations/cd-destinations-auckland-exterior.jpg?wid=700" alt="Cordis, Auckland">
                                    <h3>Cordis, Auckland</h3>
                                    <p>Un hôtel 5 étoiles offrant des chambres luxueuses et des installations de qualité, idéal pour les voyageurs exigeants.</p>
                                    <div class="price-tag">350€/nuit</div>
                                    <input type="hidden" name="hotel" value="Cordis, Auckland - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="350">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/537316836.jpg?k=16a40c7026b3a42f79267f0322cb8b4f53f361e2a585a6b92c7fe41e4a3ffe51&o=&hp=1" alt="Sojourn Apartment Hotel">
                                    <h3>Sojourn Apartment Hotel</h3>
                                    <p>Un hôtel 4 étoiles avec des appartements modernes et des services de qualité, parfait pour les séjours prolongés.</p>
                                    <div class="price-tag">240€/nuit</div>
                                    <input type="hidden" name="hotel" value="Sojourn Apartment Hotel - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="240">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2b/50/c0/05/caption.jpg?w=700&h=-1&s=1" alt="Asure Harbour View Motel">
                                    <h3>Asure Harbour View Motel</h3>
                                    <p>Un motel 3 étoiles offrant des chambres confortables et des vues magnifiques sur le port.</p>
                                    <div class="price-tag">160€/nuit</div>
                                    <input type="hidden" name="hotel" value="Asure Harbour View Motel - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="160">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;

                case 'suisse':
                    ?>
                    <div class="country-section">
                        <h2>Suisse</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/28531625.jpg?k=bf8603c957cf1f74594c14915de413a68db92b4508f7a52fe73d73f49a698195&o=&hp=1" alt="The Omnia">
                                    <h3>The Omnia</h3>
                                    <p>Un hôtel 5 étoiles offrant des chambres luxueuses et des vues imprenables sur les montagnes.</p>
                                    <div class="price-tag">400€/nuit</div>
                                    <input type="hidden" name="hotel" value="The Omnia - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="400">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/c5/ba/7b/hotel-outside-winter.jpg?w=700&h=-1&s=1" alt="Beausite Park Hotel">
                                    <h3>Beausite Park Hotel</h3>
                                    <p>Un hôtel 4 étoiles avec des chambres élégantes et des installations de qualité, idéal pour les voyageurs d'affaires et les touristes.</p>
                                    <div class="price-tag">280€/nuit</div>
                                    <input type="hidden" name="hotel" value="Beausite Park Hotel - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="280">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/388765438.jpg?k=b6b64acfbe993f624cd12b6105ba60f25aaa00bc9f669f63062c89f3da13f31c&o=&hp=1" alt="Jaegerhof Hotel">
                                    <h3>Jaegerhof Hotel</h3>
                                    <p>Un hôtel 3 étoiles offrant des chambres confortables et une ambiance chaleureuse, parfait pour les séjours en famille.</p>
                                    <div class="price-tag">190€/nuit</div>
                                    <input type="hidden" name="hotel" value="Jaegerhof Hotel - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="190">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;

                case 'costa rica':
                    ?>
                    <div class="country-section">
                        <h2>Costa Rica</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/487228338.jpg?k=a13502494d75431808cb27e32a4743a5640b905f82ee3d595c7556062c1819ee&o=&hp=1" alt="Tabacon Thermal Resort">
                                    <h3>Tabacon Thermal Resort</h3>
                                    <p>Un resort 5 étoiles avec des sources thermales, des spas et des chambres luxueuses.</p>
                                    <div class="price-tag">380€/nuit</div>
                                    <input type="hidden" name="hotel" value="Tabacon Thermal Resort - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="380">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/342725083.jpg?k=b09aa4a291377cd48cf8bd4578f2df248463a3e5042b5c2bef27aa638853212e&o=&hp=1" alt="Arenal Manoa Resort Hotel">
                                    <h3>Arenal Manoa Resort Hotel</h3>
                                    <p>Un resort 4 étoiles avec des chambres confortables et des activités de plein air, idéal pour les familles et les couples.</p>
                                    <div class="price-tag">260€/nuit</div>
                                    <input type="hidden" name="hotel" value="Arenal Manoa Resort Hotel - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="260">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://www.thehotelguru.com/_images/2e/c6/2ec6809f1a2565288c7b8a76926363f1/s1654x900.jpg" alt="Ylang Ylang Beach Resort">
                                    <h3>Ylang Ylang Beach Resort</h3>
                                    <p>Un resort 3 étoiles en bord de mer, offrant des chambres confortables et des activités de plage.</p>
                                    <div class="price-tag">180€/nuit</div>
                                    <input type="hidden" name="hotel" value="Ylang Ylang Beach Resort - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="180">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;

                case 'maroc':
                    ?>
                    <div class="country-section">
                        <h2>Maroc</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://www.datocms-assets.com/56775/1634589734-1627888231355134-casablanca-hotel.jpeg?auto=format&fit=max&w=1200" alt="Le Casablanca Hotel">
                                    <h3>Le Casablanca Hotel</h3>
                                    <p>Un hôtel 5 étoiles avec des chambres luxueuses et des installations de qualité, idéal pour les voyageurs exigeants.</p>
                                    <div class="price-tag">230€/nuit</div>
                                    <input type="hidden" name="hotel" value="Le Casablanca Hotel - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="230">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/303210071.jpg?k=9ad62c89923cc4f44d0b2ba0452dd762f9b9e227913f3a4666a1b0615a8d9369&o=&hp=1" alt="Sol Oasis Marrakech">
                                    <h3>Sol Oasis Marrakech</h3>
                                    <p>Un hôtel 4 étoiles avec des chambres modernes et un emplacement idéal en plein cœur de la ville.</p>
                                    <div class="price-tag">170€/nuit</div>
                                    <input type="hidden" name="hotel" value="Sol Oasis Marrakech - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="170">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/462115349.jpg?k=601a3b5605b8b7290f5695d6b25824c13ae0247b275494b34af56cd107b55b93&o=&hp=1" alt="Riad Verus">
                                    <h3>Riad Verus</h3>
                                    <p>Un riad 3 étoiles offrant des chambres confortables et une ambiance traditionnelle.</p>
                                    <div class="price-tag">120€/nuit</div>
                                    <input type="hidden" name="hotel" value="Riad Verus - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="120">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;

                case 'grèce':
                case 'grece':
                    ?>
                    <div class="country-section">
                        <h2>Grèce</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/db/76/3b/main-pool-area.jpg?w=700&h=-1&s=1" alt="Atrium Palace">
                                    <h3>Atrium Palace</h3>
                                    <p>Un hôtel 5 étoiles avec des chambres luxueuses et des vues imprenables sur la mer.</p>
                                    <div class="price-tag">290€/nuit</div>
                                    <input type="hidden" name="hotel" value="Atrium Palace - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="290">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/29/92/c7/4a/andronikos-hotel-mykonos.jpg?w=700&h=-1&s=1" alt="Andronikos Hotel">
                                    <h3>Andronikos Hotel</h3>
                                    <p>Un hôtel 4 étoiles avec des chambres élégantes et un emplacement idéal en plein cœur de la ville.</p>
                                    <div class="price-tag">210€/nuit</div>
                                    <input type="hidden" name="hotel" value="Andronikos Hotel - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="210">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/362613707.jpg?k=0415c6a9f2efa0d7253339b32c0dd57b3d370a56318da058de94aa91345ff124&o=&hp=1" alt="Apanemo Hotel">
                                    <h3>Apanemo Hotel</h3>
                                    <p>Un hôtel 3 étoiles offrant des chambres confortables et une ambiance chaleureuse, parfait pour les séjours en famille.</p>
                                    <div class="price-tag">150€/nuit</div>
                                    <input type="hidden" name="hotel" value="Apanemo Hotel - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="150">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;


                case 'japon':
                        ?>
                        <div class="country-section">
                            <h2>Japon</h2>
                            <div class="card-container">
                                <form method="POST" class="option-form" data-type="hotel">

                                    <div class="hotel-option">
                                        <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/646920971.jpg?k=a762f8b6d9645c56b7a85537e72c5ae89f0eef4d4c2b2d66ea14d75c3a36e6f6&o=&hp=1" alt="Mitsui Garden">
                                        <h3>Mitsui Garden Hotel</h3>
                                        <p>Un hôtel 5 étoiles avec des chambres luxueuses et uen vue magnifique sur la tour de Tokyo.</p>
                                        <div class="price-tag">470€/nuit</div>
                                        <input type="hidden" name="hotel" value="Mitsui Garden - 5 étoiles">
                                        <input type="hidden" name="prix_hotel" value="470">
                                        <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                    </div>
                                </form>
    
                                <form method="POST" class="option-form" data-type="hotel">

                                    <div class="hotel-option">
                                        <img src="https://exp.cdn-hotels.com/hotels/10000000/9110000/9104500/9104481/6f0c6577_z.jpg" alt="Hotel ShinjukuUne">
                                        <h3>Hotel ShinjukuUne</h3>
                                        <p>Un hôtel 4 étoiles avec des chambres élégantes et un emplacement idéal en plein cœur de la ville avec une vue sur Godzilla.</p>
                                        <div class="price-tag">320€/nuit</div>
                                        <input type="hidden" name="hotel" value="Hotel ShinjukuUne - 4 étoiles">
                                        <input type="hidden" name="prix_hotel" value="320">
                                        <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                    </div>
                                </form>
    
                                <form method="POST" class="option-form" data-type="hotel">

                                    <div class="hotel-option">
                                        <img src="https://th.bing.com/th/id/OIP.bs256ExTR4my2YyWVlu12QHaFN?rs=1&pid=ImgDetMain" alt="APA Hotel">
                                        <h3>APA Hotel Eki Tower</h3>
                                        <p>Hôtel 3* idéalement situé à 2 min de la gare de Ryogoku avec des chambres modernes avec wifi haut débit.</p>
                                        <div class="price-tag">70€/nuit</div>
                                        <input type="hidden" name="hotel" value="APA Hotel - 3 étoiles">
                                        <input type="hidden" name="prix_hotel" value="70">
                                        <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                        break;

                
                case 'cuba':
                    ?>
                    <div class="country-section">
                        <h2>Cuba</h2>
                        <div class="card-container">
                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2e/30/a4/33/vip-pool.jpg?w=700&h=-1&s=1" alt="Gran Muthu Almirante Beach Hotel">
                                    <h3>Gran Muthu Almirante Beach Hotel</h3>
                                    <p>Un hôtel 5 étoiles avec des chambres luxueuses et des plages privées, offrant une expérience inoubliable.</p>
                                    <div class="price-tag">320€/nuit</div>
                                    <input type="hidden" name="hotel" value="Gran Muthu Almirante Beach Hotel - 5 étoiles">
                                    <input type="hidden" name="prix_hotel" value="320">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/f3/a3/04/memories-trinidad-del.jpg?w=700&h=-1&s=1" alt="Memories Trinidad Del Mar">
                                    <h3>Memories Trinidad Del Mar</h3>
                                    <p>Un hôtel 4 étoiles avec des chambres modernes et des installations de qualité, idéal pour les voyageurs d'affaires et les touristes.</p>
                                    <div class="price-tag">230€/nuit</div>
                                    <input type="hidden" name="hotel" value="Memories Trinidad Del Mar - 4 étoiles">
                                    <input type="hidden" name="prix_hotel" value="230">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>

                            <form method="POST" class="option-form" data-type="hotel">

                                <div class="hotel-option">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoRBUiAf3L7glktPUYeiaznf3stvehnEh2JA&s" alt="Hotel Horizontes Los Jazmines">
                                    <h3>Hotel Horizontes Los Jazmines</h3>
                                    <p>Un hôtel 3 étoiles offrant des chambres confortables et des vues magnifiques sur la nature environnante.</p>
                                    <div class="price-tag">160€/nuit</div>
                                    <input type="hidden" name="hotel" value="Hotel Horizontes Los Jazmines - 3 étoiles">
                                    <input type="hidden" name="prix_hotel" value="160">
                                    <button type="button" class="hotel-select-btn js-select-option">Sélectionner</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    break;

                default:
                    echo "<p>Aucun pays sélectionné ou pays non reconnu.</p>";
                    break;
            }
            ?>

        </div>

        <div class="container">
            <div class="section-title">Services Supplémentaires</div>
            <div class="card-container">
                <form method="POST" class="option-form" data-type="service">
                    <div class="service-option">
                        <img src="https://th.bing.com/th/id/R.b0384847d41ca3215ee10dca20029b7c?rik=HTqpGfcLdOGSvA&pid=ImgRaw&r=0" alt="Formule Tout Compris">
                        <h3><i class="fas fa-utensils"></i> Formule Tout Compris</h3>
                        <p>
                            <i class="fas fa-check"></i> Petit-déjeuner buffet gourmand<br>
                            <i class="fas fa-check"></i> Déjeuner et dîner à la carte<br>
                            <i class="fas fa-check"></i> Boissons illimitées (softs, vins locaux)<br>
                            <i class="fas fa-check"></i> Collations disponibles toute la journée
                        </p>
                        <div class="price-tag">50€/jour</div>
                        <input type="hidden" name="service" value="All Inclusive">
                        <input type="hidden" name="prix_service" value="50">
                        <button type="button" class="service-select-btn js-select-option" data-type="service" data-id="All Inclusive">Sélectionner</button>

                    </div>
                </form>

                <form method="POST" class="option-form" data-type="service">
                    <div class="service-option">
                        <img src="https://www.ecranmobile.fr/photo/art/grande/80811125-58276840.jpg?v=1717774410" alt="Option 5G illimité">
                        <h3><i class=" "></i>5G illimité</h3>
                        <p>
                            <i class="fas fa-check"></i> Boitier 5G permettant de rester connecter au reste du monde tout en partageant les plus beau souvenir de son voyage.<br>
                        </p>
                        <div class="price-tag">10€/jour</div>
                        <input type="hidden" name="service" value="5G illimité">
                        <input type="hidden" name="prix_service" value="10">
                        <button type="button" class="service-select-btn js-select-option" data-type="service" data-id="5G illimité">Sélectionner</button>
                    </div>
                </form>

                <form method="POST" class="option-form" data-type="service">
                    <div class="service-option">
                        <img src="https://th.bing.com/th/id/R.8c6ee0f796026f83e50288e212f557e3?rik=JGMJy2lBa9EPhA&riu=http%3a%2f%2fwww.justacote.com%2fphotos_entreprises%2facloc-location-de-voiture-et-utilitaire-nice-13874954680.jpg&ehk=PGktefU50KFACFyUrPHNfyAxLr%2fujOo4BA7uk8KyJ7o%3d&risl=&pid=ImgRaw&r=0" alt="Location de voiture">
                        <h3><i class="fas fa-car"></i> Location de Voiture </h3>
                        <p>
                            <i class="fas fa-check"></i> Véhicule récent (moins de 1 an)<br>
                            <i class="fas fa-check"></i> Assurance tous risques incluse<br>
                            <i class="fas fa-check"></i> Kilométrage illimité<br>
                        </p>
                        <div class="price-tag">70€/jour</div>
                        <input type="hidden" name="service" value="Voiture de Location">
                        <input type="hidden" name="prix_service" value="70">
                        <button type="button" class="service-select-btn js-select-option" data-type="service" data-id="Voiture de Location">Sélectionner</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    
    <div style="position: fixed; bottom: 20px; width: 100%; display: flex; justify-content: space-between; padding: 0 20px; box-sizing: border-box;">
    <a href="date.php" style="display: inline-block; background: #4a6fa5; color: white; padding: 15px 20px; border-radius: 8px; text-decoration: none; font-size: 1.2rem; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 15px rgba(0, 0, 0, 0.3)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 10px rgba(0, 0, 0, 0.2)';">← Retour</a>

    <form method="POST" action="options.php" style="display:inline;">
        <input type="hidden" name="go_to_recap" value="1">
        <button type="submit" style="background: linear-gradient(45deg, #ff7b25, #e63946); color: white; padding: 15px 20px; border-radius: 8px; font-size: 1.2rem; border: none; cursor: pointer; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 15px rgba(0, 0, 0, 0.3)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 10px rgba(0, 0, 0, 0.2)';">
            Récapitulatif →
        </button>
    </form>
</div>


    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
    <script src="js/theme.js"></script>
    <script id="session-data" type="application/json">
        <?= json_encode($_SESSION) ?>
    </script>
    <script src="js/option.js" defer></script>
</body>
</html>