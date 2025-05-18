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
    <title>Italie - Xtreme Voyage</title>
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
        <!-- Image de l'Italie -->
        <img src="https://www.cartage.club/wp-content/uploads/2024/05/lac-de-come-road-trip-Italie-du-nord.jpeg" alt="Italie">
        <!-- Titre principal de la page -->
        <h1 class="main-title">Italie</h1>
    </header>

    <!-- Contenu principal de la page -->
    <main>
        <form method="POST" action="italie-activites.php">
            <section class="activity-grid">
                <!-- Carte pour l'activité "Voir un match de Milan" -->
                <div class="activity-card" data-name="Voir un match de Milan" data-price="120">
                    <!-- Image de l'activité -->
                    <img src="https://arquitecturaviva.com/assets/uploads/obras/53579/av_206540.webp?h=62b7320a" alt="Match de Milan">
                    <!-- Titre de l'activité -->
                    <h3>Voir un match de Milan</h3>
                    <!-- Description de l'activité -->
                    <p>Vibre au rythme de San Siro, où chaque but déclenche une vague d'émotion. Une immersion dans le football italien, entre ferveur populaire et passion pure.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">120 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Voir un match de Milan][qte]" value="0">
                        <input type="hidden" name="activites[Voir un match de Milan][prix]" value="120">
                    </div>
                </div>

                <!-- Carte pour l'activité "Prendre une gondole à Venise" -->
                <div class="activity-card" data-name="Prendre une gondole à Venise" data-price="80">
                    <!-- Image de l'activité -->
                    <img src="https://www.vivovenetia.fr/wp-content/uploads/2022/06/Tour-gondole-privee.png" alt="Gondole à Venise">
                    <!-- Titre de l'activité -->
                    <h3>Prendre une gondole à Venise</h3>
                    <!-- Description de l'activité -->
                    <p>Glisse sur les eaux tranquilles de la Sérénissime au son du chant des gondoliers. Un instant suspendu où Venise se rêve romantique et éternelle.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">80 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Prendre une gondole à Venise][qte]" value="0">
                        <input type="hidden" name="activites[Prendre une gondole à Venise][prix]" value="80">
                    </div>
                </div>

                <!-- Carte pour l'activité "Monter au sommet du Dôme de Florence" -->
                <div class="activity-card" data-name="Monter au sommet du Dôme de Florence" data-price="25">
                    <!-- Image de l'activité -->
                    <img src="https://th.bing.com/th/id/R.03f9e49196c186be610752f98893e03d?rik=5efhsn79kE8oqg&pid=ImgRaw&r=0" alt="Dôme de Florence">
                    <!-- Titre de l'activité -->
                    <h3>Monter au sommet du Dôme de Florence</h3>
                    <!-- Description de l'activité -->
                    <p>Monte les 463 marches qui mènent au ciel florentin. De là-haut, Florence se dévoile en chef-d'œuvre, baignée de lumière et d'histoire.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">25 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Monter au sommet du Dôme de Florence][qte]" value="0">
                        <input type="hidden" name="activites[Monter au sommet du Dôme de Florence][prix]" value="25">
                    </div>
                </div>

                <!-- Carte pour l'activité "Visiter le Vatican et la Chapelle Sixtine" -->
                <div class="activity-card" data-name="Visiter le Vatican et la Chapelle Sixtine" data-price="60">
                    <!-- Image de l'activité -->
                    <img src="https://www.voyageavecnous.fr/wp-content/uploads/2022/07/visiter-le-vatican.jpg" alt="Vatican et Chapelle Sixtine">
                    <!-- Titre de l'activité -->
                    <h3>Visiter le Vatican et la Chapelle Sixtine</h3>
                    <!-- Description de l'activité -->
                    <p>Explore les trésors du plus petit État du monde. Du marbre sacré au plafond de Michel-Ange, chaque pas est une leçon de beauté et de splendeur.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">60 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Visiter le Vatican et la Chapelle Sixtine][qte]" value="0">
                        <input type="hidden" name="activites[Visiter le Vatican et la Chapelle Sixtine][prix]" value="60">
                    </div>
                </div>

                <!-- Carte pour l'activité "Prendre un bain thermal en Toscane" -->
                <div class="activity-card" data-name="Prendre un bain thermal en Toscane" data-price="45">
                    <!-- Image de l'activité -->
                    <img src="https://www.ab-in-den-urlaub.de/magazin/wp-content/uploads/2024/02/1709138595_Cascate-del-Mulino-800x533.jpg" alt="Bain thermal en Toscane">
                    <!-- Titre de l'activité -->
                    <h3>Prendre un bain thermal en Toscane</h3>
                    <!-- Description de l'activité -->
                    <p>Immerge-toi dans les eaux chaudes naturelles des bains de Toscane. Un moment de paix absolue au coeur de paysages vallonnés et baignés de soleil.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">45 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Prendre un bain thermal en Toscane][qte]" value="0">
                        <input type="hidden" name="activites[Prendre un bain thermal en Toscane][prix]" value="45">
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
        </section>
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