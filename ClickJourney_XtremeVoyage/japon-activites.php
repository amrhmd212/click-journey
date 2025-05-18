<?php
// On démarre la session pour permettre de stocker et récupérer des données utilisateur.
session_start();

// On récupère le nom d'utilisateur depuis la session. Si l'utilisateur n'est pas connecté, la valeur sera null.
$username = $_SESSION['username'] ?? null;

// On vérifie si le formulaire a été soumis via la méthode POST et si des activités ont été sélectionnées.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['activites'])) {
    // On récupère les activités sélectionnées depuis le formulaire.
    $activites_selectionnees = $_POST['activites'];
    $activites_filtrees = [];

    // On parcourt chaque activité pour filtrer celles qui ont une quantité supérieure à 0.
    foreach ($activites_selectionnees as $nom => $infos) {
        $quantite = intval($infos['qte'] ?? 0);
        $prix = floatval($infos['prix'] ?? 0);

        // Si la quantité est supérieure à 0, on ajoute l'activité au tableau des activités filtrées.
        if ($quantite > 0) {
            $activites_filtrees[$nom] = [
                'quantite' => $quantite,
                'prix' => $prix
            ];
        }
    }

    // On stocke les activités filtrées dans la session pour pouvoir les utiliser sur les autres pages.
    $_SESSION['activites_selectionnees'] = $activites_filtrees;

    // On redirige l'utilisateur vers la page "date.php" après la soumission du formulaire.
    header("Location: date.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définition des métadonnées de la page pour le navigateur et les moteurs de recherche -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Japon - Xtreme Voyage</title>
    <!-- Liens vers les polices et les styles CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="pays-activites.css">
</head>
<body>
    <!-- Barre de navigation -->
    <nav>
        <ul>
            <!-- Lien vers la page d'accueil -->
            <li><a href="index.php">Accueil</a></li>
            <!-- Lien vers la page de présentation -->
            <li><a href="presentation.php">Présentation</a></li>
            <!-- Lien vers la page "Qui sommes-nous" -->
            <li><a href="quisommesnous.php">Qui sommes-nous</a></li>
            <!-- Lien vers la page de contact -->
            <li><a href="contact.php">Contact</a></li>
            <li>
                <!-- Si l'utilisateur est connecté, on affiche un lien vers son profil avec son nom -->
                <?php if ($username) : ?>
                    <a href="profil.php" class="login-btn no-effect">Profil (<?php echo htmlspecialchars($username); ?>)</a>
                <?php else : ?>
                    <!-- Sinon, on affiche un lien vers la page de connexion -->
                    <a href="connexion.php" class="login-btn no-effect">Connexion</a>
                <?php endif; ?>
            </li>
            <!-- Lien vers la page de recherche -->
            <li><a href="recherche.php"><i class="fas fa-search search-icon"></i></a></li>
        </ul>
    </nav>

    <!-- En-tête de la page avec une image et un titre -->
    <header>
        <!-- Image du Japon -->
        <img src="https://static.vecteezy.com/ti/photos-gratuite/p2/2057268-beau-paysage-de-mt-fuji-avec-chureito-pagode-japon-gratuit-photo.jpg" alt="Japon">
        <!-- Titre principal de la page -->
        <h1 class="main-title">Japon</h1>
    </header>

    <!-- Contenu principal de la page -->
    <main>
        <form method="POST" action="japon-activites.php">
            <section class="activity-grid">
                <!-- Carte pour l'activité "Wingsuit au Mont Fuji" -->
                <div class="activity-card" data-name="Wingsuit au Mont Fuji" data-price="350">
                    <!-- Image de l'activité -->
                    <img src="https://i.ytimg.com/vi/dqr0c2Nz76Q/maxresdefault.jpg" alt="Wingsuit au Mont Fuji">
                    <!-- Titre de l'activité -->
                    <h3>Wingsuit au Mont Fuji</h3>
                    <!-- Description de l'activité -->
                    <p>Plonge dans le vide face à l'un des plus grands symboles du Japon. En wingsuit au-dessus du Mont Fuji, chaque seconde devient éternité, chaque battement d'aile te rapproche d'une liberté presque sacrée.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">350 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Wingsuit au Mont Fuji][qte]" value="0">
                        <input type="hidden" name="activites[Wingsuit au Mont Fuji][prix]" value="350">
                    </div>
                </div>

                <!-- Carte pour l'activité "Ice climbing sur les cascades gelées de Sounkyo" -->
                <div class="activity-card" data-name="Ice climbing sur les cascades gelées de Sounkyo" data-price="280">
                    <!-- Image de l'activité -->
                    <img src="https://www.geo-fct.org/wp-content/uploads/2024/01/escalade-sur-glace-en-norvege-3A-defiez-les-cascades-gelees-1200x800.jpg" alt="Ice climbing à Sounkyo">
                    <!-- Titre de l'activité -->
                    <h3>Ice climbing sur les cascades gelées de Sounkyo</h3>
                    <!-- Description de l'activité -->
                    <p>Garde ton sang-froid et affronte les cathédrales de glace de Sounkyo. Pioche en main, crampons aux pieds, gravis ces murs figés dans le temps, là où le silence est aussi tranchant que la glace.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">280 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Ice climbing sur les cascades gelées de Sounkyo][qte]" value="0">
                        <input type="hidden" name="activites[Ice climbing sur les cascades gelées de Sounkyo][prix]" value="280">
                    </div>
                </div>

                <!-- Carte pour l'activité "Affronter un ours brun en 'battle mode'" -->
                <div class="activity-card" data-name="Affronter un ours brun en 'battle mode'" data-price="500">
                    <!-- Image de l'activité -->
                    <img src="https://images.chinatimes.com/newsphoto/2024-04-25/656/20240425005205.png" alt="Affronter un ours brun">
                    <!-- Titre de l'activité -->
                    <h3>Affronter un ours brun en 'battle mode'</h3>
                    <!-- Description de l'activité -->
                    <p>Le légendaire combattant Khabib Nurmagomedov le faisais dès son plus jeune âge. Pourrez-vous vous aussi vous confronter à l'une des bêtes les plus féroces sur Terre ?</p>
                    <!-- Prix de l'activité -->
                    <p class="price">500 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Affronter un ours brun en 'battle mode'][qte]" value="0">
                        <input type="hidden" name="activites[Affronter un ours brun en 'battle mode'][prix]" value="500">
                    </div>
                </div>

                <!-- Carte pour l'activité "Plongée sous glace à Shiretoko" -->
                <div class="activity-card" data-name="Plongée sous glace à Shiretoko" data-price="320">
                    <!-- Image de l'activité -->
                    <img src="https://worldadventuredivers.com/wp-content/uploads/2017/02/IMG_6456.jpg?x56564" alt="Plongée sous glace à Shiretoko">
                    <!-- Titre de l'activité -->
                    <h3>Plongée sous glace à Shiretoko</h3>
                    <!-- Description de l'activité -->
                    <p>Descends sous la banquise pour découvrir un monde de givre et de grâce. À Shiretoko, les eaux glacées cachent une vie insoupçonnée, où chaque bulle d'air semble danser dans un rêve polaire.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">320 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Plongée sous glace à Shiretoko][qte]" value="0">
                        <input type="hidden" name="activites[Plongée sous glace à Shiretoko][prix]" value="320">
                    </div>
                </div>

                <!-- Carte pour l'activité "Snowboard sur les pentes du Mt. Yotei" -->
                <div class="activity-card" data-name="Snowboard sur les pentes du Mt. Yotei" data-price="200">
                    <!-- Image de l'activité -->
                    <img src="https://www.adaptnetwork.com/wp-content/uploads/2017/03/volcano-840x473.jpg" alt="Snowboard sur le Mt. Yotei">
                    <!-- Titre de l'activité -->
                    <h3>Snowboard sur les pentes du Mt. Yotei</h3>
                    <!-- Description de l'activité -->
                    <p>Enfile ta planche et attaque les flancs du Fuji d'Hokkaido. Le Mt. Yotei te livre sa poudreuse parfaite et ses descentes volcaniques, dans un décor de carte postale où l'adrénaline glisse avec élégance.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">200 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Snowboard sur les pentes du Mt. Yotei][qte]" value="0">
                        <input type="hidden" name="activites[Snowboard sur les pentes du Mt. Yotei][prix]" value="200">
                    </div>
                </div>
            </section>

            <div id="selection-summary">
                    <!-- Résumé de la sélection -->
                    <h3>Votre Sélection</h3>
                    <!-- Nombre total d'activités sélectionnées -->
                    <p>Activités choisies: <span id="total-activities">0</span></p>
                    <!-- Prix total des activités sélectionnées -->
                    <p>Total: <span id="total-price">0 €</span></p>
                    <!-- Bouton pour soumettre le formulaire -->
                    <button type="submit" class="btn">Confirmer</button>
                </div>
        </form>
    </main>

    <!-- Pied de page -->
    <footer>
        <!-- Informations sur les droits réservés -->
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <!-- Informations de contact -->
        <p>Contactez-nous pour plus d'informations</p>
    </footer>

    <!-- Inclusion des scripts JavaScript -->
    <script src="js/activites.js"></script>
    <script src="js/theme.js"></script>
</body>
</html>