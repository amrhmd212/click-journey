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
    <title>Nouvelle-Zélande - Xtreme Voyage</title>
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
        <h1 class="main-title">Nouvelle-Zélande</h1>
        <img src="https://images.unsplash.com/photo-1597655601841-214a4cfe8b2c?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8bmV3JTIwemVhbGFuZHxlbnwwfHwwfHx8MA%3D%3D" alt="Nouvelle-Zélande">
    </header>

    <main>
        <form method="POST" action="nouvelle-zelande-activites.php">
            <section class="destination-section">
                <div class="activity-grid">
                    <div class="activity-card">
                        <img src="https://th.bing.com/th/id/R.ffa650bc37de5d4e54111c7131b606b0?rik=BJ0uj5%2b0Cc%2fwow&pid=ImgRaw&r=0" alt="Parapente à Nelson">
                        <h3>Parapente au coucher du soleil à Nelson</h3>
                        <p>Alliez les sensations et les paysages spectaculaires de Nelson depuis les airs, à l'heure dorée du coucher du soleil.</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Parapente à Nelson]" value="0">
                        </div>
                    </div>

                    <div class="activity-card">
                        <img src="https://th.bing.com/th/id/R.a885484f84bd33f34635d3fdf8d38bc0?rik=bcK52BrW3MsTvw&pid=ImgRaw&r=0" alt="Vol en hélicoptère Mont Cook">
                        <h3>Vol en hélicoptère et atterrissage sur un glacier</h3>
                        <p>Survolez le Mont Cook et atterrissez sur un glacier pour une aventure inoubliable au sommet de la nature sauvage.</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Vol en hélicoptère Mont Cook]" value="0">
                        </div>
                    </div>

                    <div class="activity-card">
                        <img src="https://th.bing.com/th/id/R.45eef51154af5646792e07f9f5c35cbe?rik=uwz3XskiCjJncw&pid=ImgRaw&r=0" alt="Canyoning à Wanaka">
                        <h3>Canyoning à Wanaka</h3>
                        <p>Plongez dans l'aventure avec des descentes en rappel, des sauts et des glissades dans les gorges de Wanaka.</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Canyoning à Wanaka]" value="0">
                        </div>
                    </div>

                    <div class="activity-card">
                        <img src="https://th.bing.com/th/id/OIP.eQfCKZPeDX1sDydasgJ3PAAAAA?rs=1&pid=ImgDetMain" alt="Saut en parachute">
                        <h3>Saut en parachute</h3>
                        <p>Faites le grand saut et admirez les panoramas à couper le souffle de la Nouvelle-Zélande en chute libre.</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Saut en parachute]" value="0">
                        </div>
                    </div>

                    <div class="activity-card">
                        <img src="https://th.bing.com/th/id/OIP.LqWL3PzY1mrnYxu-FBNybwHaE8?rs=1&pid=ImgDetMain" alt="Jet Boating à Shotover River">
                        <h3>Jet Boating à Shotover River</h3>
                        <p>Vivez une expérience à grande vitesse en naviguant dans les canyons étroits de la Shotover River.</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Jet Boating à Shotover River]" value="0">
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