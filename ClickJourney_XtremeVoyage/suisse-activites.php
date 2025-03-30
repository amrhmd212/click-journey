<?php
session_start();
$username = $_SESSION['username'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $activites = $_POST['activites'] ?? [];
    $_SESSION['activites'] = $activites;
    header("Location: date.php");
    exit();
}

$activitesSelectionnees = $_SESSION['activites'] ?? [];
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
                    <div class="activity-card">
                        <img src="https://thumbs.dreamstime.com/b/istanbul-turquie-septembre-un-avion-acrobatique-turc-donne-spectacle-d-a%C3%A9robatique-pendant-le-teknofest-aeronautics-pr%C3%A9sente-158495529.jpg" alt="Vol acrobatique">
                        <h3>Vol acrobatique</h3>
                        <p>Loopings, vrilles, montées vertigineuses : enfile ton casque et deviens pilote d'un jour dans un ballet aérien au-dessus des Alpes suisses.</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Vol acrobatique]" value="0">
                        </div>
                    </div>

                    <div class="activity-card">
                        <img src="https://th.bing.com/th/id/OIP.bUXsSoUK4L-XFmY45P0UzAHaFj?rs=1&pid=ImgDetMain" alt="Saut en parachute à Zermatt">
                        <h3>Saut en parachute à Zermatt</h3>
                        <p>Une chute libre face au Cervin : le mythe devient réalité. Une vue à couper le souffle, une expérience gravée dans le ciel.</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Saut en parachute à Zermatt]" value="0">
                        </div>
                    </div>

                    <div class="activity-card">
                        <img src="https://altitude-nature.fr/wp-content/uploads/2023/04/mont-blanc-helicoptere-980x653.jpg" alt="Vol en hélicoptère Mont-Blanc">
                        <h3>Vol en hélicoptère autour du Mont-Blanc</h3>
                        <p>Survole le toit de l'Europe dans un silence majestueux. Le Mont-Blanc s'étend sous toi comme un royaume glacé et lumineux.</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Vol en hélicoptère Mont-Blanc]" value="0">
                        </div>
                    </div>

                    <div class="activity-card">
                        <img src="https://i.pinimg.com/originals/b9/49/c2/b949c2a567c297ce4b728e7e6073047d.jpg" alt="Randonnée dans les gorges de l'Aar">
                        <h3>Randonnée dans les gorges de l'Aar</h3>
                        <p>Avance entre parois abruptes et rivières vives, au fond de l'une des gorges les plus impressionnantes de Suisse. Une immersion brute dans la roche vivante.</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Randonnée dans les gorges de l'Aar]" value="0">
                        </div>
                    </div>

                    <div class="activity-card">
                        <img src="https://th.bing.com/th/id/R.4d9d357eff94abfe6da1c4180a3ce2dd?rik=LqsuNutUiZgCCw&pid=ImgRaw&r=0" alt="Vol en montgolfière à Château-d'Oex">
                        <h3>Vol en montgolfière à Château-d'Oex</h3>
                        <p>Laisse le vent te guider au-dessus des prairies alpines. Une montgolfière, un lever de soleil, un panorama à 360° : l'expérience suisse par excellence.</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Vol en montgolfière à Château-d'Oex]" value="0">
                        </div>
                    </div>
                </div>

                <div id="selection-summary">
                    <h3>Votre Sélection</h3>
                    <p>Activités choisies: <span id="total-activities">0</span></p>
                    <p>Total: <span id="total-price">0 €</span></p>
                    
                    <a href="date.php" class="btn">Confirmer</a>
                </div>
            </section>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
</body>
</html>