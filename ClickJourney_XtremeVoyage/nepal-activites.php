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
    <title>Népal - Xtreme Voyage</title>
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
        <h1 class="main-title">Népal</h1>
        <img src="https://images.unsplash.com/photo-1611516491426-03025e6043c8?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8biVDMyVBOXBhbHxlbnwwfHwwfHx8MA%3D%3D" alt="Népal">
    </header>

    <main>
        <form method="POST" action="nepal-activites.php">
            <section class="destination-section">
                <div class="activity-grid">
                    
                    
                    <div class="activity-card" data-name="Saut en parachute Everest" data-price="3000">
                        <img src="https://th.bing.com/th/id/OIP.3etlMwPG7b4bjZWCVKaLRQHaFo?rs=1&pid=ImgDetMain" alt="Saut en parachute Everest">
                        <h3>Saut en parachute Everest</h3>
                        <p>Sens le souffle glacé des cimes himalayennes en te jetant dans le vide à plus de 8000 mètres d'altitude. Un saut unique au monde, au-dessus du toit de la planète — là où l'oxygène se fait rare, mais l'émotion déborde.</p>
                        <p class="price">3000 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Saut en parachute Everest][qte]" value="0">
                            <input type="hidden" name="activites[Saut en parachute Everest][prix]" value="3000">
                        </div>
                    </div>

                 
                    <div class="activity-card" data-name="Gravir le mont Everest" data-price="10000">
                        <img src="https://static.actu.fr/uploads/2021/07/195288075-868331633758171-1120208792857451572-n.jpg" alt="Gravir le mont Everest">
                        <h3>Gravir le mont Everest</h3>
                        <p>Plus qu'un sommet, une légende. Gravir l'Everest, c'est défier la nature dans ce qu'elle a de plus extrême, et écrire ton nom là où seuls les plus déterminés posent le pied. Un rêve d'altitude, une conquête intérieure.</p>
                        <p class="price">10000 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Gravir le mont Everest][qte]" value="0">
                            <input type="hidden" name="activites[Gravir le mont Everest][prix]" value="10000">
                        </div>
                    </div>

                    
                    <div class="activity-card" data-name="Vol en wingsuit sur l'Himalaya" data-price="350">
                        <img src="https://i.pinimg.com/736x/a5/53/81/a553813002bf6d7da65aac752ab1084c--wingsuit-flying-skydiving.jpg" alt="Vol en wingsuit">
                        <h3>Vol en wingsuit sur l'Himalaya</h3>
                        <p>Plane au-dessus des sommets enneigés comme un aigle céleste. En wingsuit, l'Himalaya devient ton terrain de jeu infini, entre crêtes acérées et vallées brumeuses. La liberté prend ici une toute autre dimension.</p>
                        <p class="price">350 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Vol en wingsuit sur l'Himalaya][qte]" value="0">
                            <input type="hidden" name="activites[Vol en wingsuit sur l'Himalaya][prix]" value="350">
                        </div>
                    </div>

  
                    <div class="activity-card" data-name="Free Solo sur une paroi de l'Himalaya" data-price="500">
                        <img src="https://media.self.com/photos/5c755d30ee64504e93bda955/master/w_1280%2Cc_limit/FreeSolo_17.jpg" alt="Free Solo Himalaya">
                        <h3>Free Solo sur une paroi de l'Himalaya</h3>
                        <p>Aucun câble. Aucune seconde chance. Juste toi, le vide et la paroi. Le free solo en Himalaya est une danse entre la vie et l'abîme, réservée à ceux qui ont la maîtrise du geste et la folie du vertige.</p>
                        <p class="price">500 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Free Solo sur une paroi de l'Himalaya][qte]" value="0">
                            <input type="hidden" name="activites[Free Solo sur une paroi de l'Himalaya][prix]" value="500">
                        </div>
                    </div>

                    
                    <div class="activity-card" data-name="Spéléologie dans les grottes glacées" data-price="100">
                        <img src="https://mehr-berge.de/wp-content/uploads/2019/10/Eisriesenwelt_Werfen_SalzburgerLand_MoerkGletscher_CF003124-420x309.jpg" alt="Spéléologie dans les grottes glacées">
                        <h3>Spéléologie dans les grottes glacées</h3>
                        <p>Entre cristaux gelés, silence souterrain et tunnels de glace éternelle, explore les entrailles figées de l'Himalaya. Une aventure où chaque pas résonne comme un secret enfoui dans les glaces millénaires.</p>
                        <p class="price">100 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <input type="hidden" name="activites[Spéléologie dans les grottes glacées][qte]" value="0">
                            <input type="hidden" name="activites[Spéléologie dans les grottes glacées][prix]" value="100">
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