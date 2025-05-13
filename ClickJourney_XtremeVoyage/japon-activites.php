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
    <title>Japon - Xtreme Voyage</title>
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
        <h1 class="main-title">Japon</h1>
        <img src="https://static.vecteezy.com/ti/photos-gratuite/p2/2057268-beau-paysage-de-mt-fuji-avec-chureito-pagode-japon-gratuit-photo.jpg" alt="Japon">
    </header>

    <main>
        <form method="POST" action="japon-activites.php">
            <section class="activity-grid">

                <div class="activity-card" data-name="Wingsuit au Mont Fuji" data-price="350">
                    <img src="https://i.ytimg.com/vi/dqr0c2Nz76Q/maxresdefault.jpg" alt="Wingsuit au Mont Fuji">
                    <h3>Wingsuit au Mont Fuji</h3>
                    <p>Plonge dans le vide face à l'un des plus grands symboles du Japon. En wingsuit au-dessus du Mont Fuji, chaque seconde devient éternité, chaque battement d'aile te rapproche d'une liberté presque sacrée.</p>
                    <p class="price">350 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Wingsuit au Mont Fuji][qte]" value="0">
                        <input type="hidden" name="activites[Wingsuit au Mont Fuji][prix]" value="350">
                    </div>
                </div>

                <div class="activity-card" data-name="Ice climbing sur les cascades gelées de Sounkyo" data-price="280">
                    <img src="https://www.geo-fct.org/wp-content/uploads/2024/01/escalade-sur-glace-en-norvege-3A-defiez-les-cascades-gelees-1200x800.jpg" alt="Ice climbing à Sounkyo">
                    <h3>Ice climbing sur les cascades gelées de Sounkyo</h3>
                    <p>Garde ton sang-froid et affronte les cathédrales de glace de Sounkyo. Pioche en main, crampons aux pieds, gravis ces murs figés dans le temps, là où le silence est aussi tranchant que la glace.</p>
                    <p class="price">280 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Ice climbing sur les cascades gelées de Sounkyo][qte]" value="0">
                        <input type="hidden" name="activites[Ice climbing sur les cascades gelées de Sounkyo][prix]" value="280">
                    </div>
                </div>

                <div class="activity-card" data-name="Affronter un ours brun en 'battle mode'" data-price="500">
                    <img src="https://images.chinatimes.com/newsphoto/2024-04-25/656/20240425005205.png" alt="Affronter un ours brun">
                    <h3>Affronter un ours brun en 'battle mode'</h3>
                    <p>Le légendaire combattant Khabib Nurmagomedov le faisais des son plus jeune âge, pourrez-vous vous aussi vous confronter à l'une des bêtes les plus féroces sur Terres.</p>
                    <p class="price">500 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Affronter un ours brun en 'battle mode'][qte]" value="0">
                        <input type="hidden" name="activites[Affronter un ours brun en 'battle mode'][prix]" value="500">
                    </div>
                </div>

                <div class="activity-card" data-name="Plongée sous glace à Shiretoko" data-price="320">
                    <img src="https://worldadventuredivers.com/wp-content/uploads/2017/02/IMG_6456.jpg?x56564" alt="Plongée sous glace à Shiretoko">
                    <h3>Plongée sous glace à Shiretoko</h3>
                    <p>Descends sous la banquise pour découvrir un monde de givre et de grâce. À Shiretoko, les eaux glacées cachent une vie insoupçonnée, où chaque bulle d'air semble danser dans un rêve polaire.</p>
                    <p class="price">320 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Plongée sous glace à Shiretoko][qte]" value="0">
                        <input type="hidden" name="activites[Plongée sous glace à Shiretoko][prix]" value="320">
                    </div>
                </div>

                <div class="activity-card" data-name="Snowboard sur les pentes du Mt. Yotei" data-price="200">
                    <img src="https://www.adaptnetwork.com/wp-content/uploads/2017/03/volcano-840x473.jpg" alt="Snowboard sur le Mt. Yotei">
                    <h3>Snowboard sur les pentes du Mt. Yotei</h3>
                    <p>Enfile ta planche et attaque les flancs du Fuji d'Hokkaido. Le Mt. Yotei te livre sa poudreuse parfaite et ses descentes volcaniques, dans un décor de carte postale où l'adrénaline glisse avec élégance.</p>
                    <p class="price">200 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Snowboard sur les pentes du Mt. Yotei][qte]" value="0">
                        <input type="hidden" name="activites[Snowboard sur les pentes du Mt. Yotei][prix]" value="200">
                    </div>
                </div>
            </section>

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