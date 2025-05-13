<?php
session_start();

$username = $_SESSION['username'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['activites'])) {
    $activites_selectionnees = $_POST['activites'];
    $activites_filtrees = [];

    foreach ($activites_selectionnees as $nom => $infos) {
        $quantite = intval($infos['qte'] ?? 0);
        $prix = floatval($infos['prix'] ?? 0);

        if ($quantite > 0) {
            $activites_filtrees[$nom] = [
                'quantite' => $quantite,
                'prix' => $prix
            ];
        }
    }

    $_SESSION['activites_selectionnees'] = $activites_filtrees;

    header("Location: date.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suisse - Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="pays-activites.css">
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
        <h1 class="main-title">Suisse</h1>
        <img src="https://www.laradioplus.com/media/article/image//781d2e1f-044e-41f4-a290-bf7ad27d8998.jpeg" alt="Suisse">
    </header>

    <main>
        <form method="POST" action="suisse-activites.php">
            <section class="destination-section">
                <div class="activity-grid">
                    
                    <div class="activity-card" data-name="Vol acrobatique" data-price="190">
                        <img src="https://thumbs.dreamstime.com/b/istanbul-turquie-septembre-un-avion-acrobatique-turc-donne-spectacle-d-a%C3%A9robatique-pendant-le-teknofest-aeronautics-pr%C3%A9sente-158495529.jpg" alt="Vol acrobatique">
                        <h3>Vol acrobatique</h3>
                        <p>Loopings, vrilles, montées vertigineuses : enfile ton casque et deviens pilote d'un jour dans un ballet aérien au-dessus des Alpes suisses.</p>
                        <p class="price">190 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Vol acrobatique][qte]" value="0">
                            <input type="hidden" name="activites[Vol acrobatique][prix]" value="190">
                        </div>
                    </div>

                    <div class="activity-card" data-name="Saut en parachute à Zermatt" data-price="250">
                        <img src="https://th.bing.com/th/id/OIP.bUXsSoUK4L-XFmY45P0UzAHaFj?rs=1&pid=ImgDetMain" alt="Saut en parachute à Zermatt">
                        <h3>Saut en parachute à Zermatt</h3>
                        <p>Une chute libre face au Cervin : le mythe devient réalité. Une vue à couper le souffle, une expérience gravée dans le ciel.</p>
                        <p class="price">250 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Saut en parachute à Zermatt][qte]" value="0">
                            <input type="hidden" name="activites[Saut en parachute à Zermatt][prix]" value="250">
                        </div>
                    </div>

                    <div class="activity-card" data-name="Vol en hélicoptère autour du Mont-Blanc" data-price="1000">
                        <img src="https://altitude-nature.fr/wp-content/uploads/2023/04/mont-blanc-helicoptere-980x653.jpg" alt="Vol en hélicoptère Mont-Blanc">
                        <h3>Vol en hélicoptère autour du Mont-Blanc</h3>
                        <p>Survole le toit de l'Europe dans un silence majestueux. Le Mont-Blanc s'étend sous toi comme un royaume glacé et lumineux.</p>
                        <p class="price">1000 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Vol en hélicoptère autour du Mont-Blanc][qte]" value="0">
                            <input type="hidden" name="activites[Vol en hélicoptère autour du Mont-Blanc][prix]" value="1000">
                        </div>
                    </div>

                    <div class="activity-card" data-name="Randonnée dans les gorges de l'Aar" data-price="45">
                        <img src="https://i.pinimg.com/originals/b9/49/c2/b949c2a567c297ce4b728e7e6073047d.jpg" alt="Randonnée dans les gorges de l'Aar">
                        <h3>Randonnée dans les gorges de l'Aar</h3>
                        <p>Avance entre parois abruptes et rivières vives, au fond de l'une des gorges les plus impressionnantes de Suisse. Une immersion brute dans la roche vivante.</p>
                        <p class="price">45 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Randonnée dans les gorges de l'Aar][qte]" value="0">
                            <input type="hidden" name="activites[Randonnée dans les gorges de l'Aar][prix]" value="45">
                        </div>
                    </div>

                    <div class="activity-card" data-name="Vol en montgolfière à Château-d'Oex" data-price="80">
                        <img src="https://th.bing.com/th/id/R.4d9d357eff94abfe6da1c4180a3ce2dd?rik=LqsuNutUiZgCCw&pid=ImgRaw&r=0" alt="Vol en montgolfière à Château-d'Oex">
                        <h3>Vol en montgolfière à Château-d'Oex</h3>
                        <p>Laisse le vent te guider au-dessus des prairies alpines. Une montgolfière, un lever de soleil, un panorama à 360° : l'expérience suisse par excellence.</p>
                        <p class="price">80 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Vol en montgolfière à Château-d'Oex][qte]" value="0">
                            <input type="hidden" name="activites[Vol en montgolfière à Château-d'Oex][prix]" value="80">
                        </div>
                    </div>
                </div>

                <div id="selection-summary">
                    <h3>Votre Sélection</h3>
                    <p>Activités choisies: <span id="total-activities">0</span></p>
                    <p>Total: <span id="total-price">0 €</span></p>
                    <button type="submit" class="btn">Confirmer</button>

                </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>

    <script src="js/activites.js"></script>
    <script src="js/theme.js"></script>

</body>
</html>