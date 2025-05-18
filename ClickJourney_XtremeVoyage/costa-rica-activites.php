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
    <title>Costa Rica - Xtreme Voyage</title>
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
        <!-- Image du Costa Rica -->
        <img src="https://www.ou-et-quand.net/blog/wp-content/uploads/2016/05/3434623631_48b32dda13_o_d.jpg" alt="Costa Rica">
        <!-- Titre principal de la page -->
        <h1 class="main-title">Costa Rica</h1>
    </header>

    <!-- Contenu principal de la page -->
    <main>
        <form method="POST" action="costa-rica-activites.php">
            <section class="activity-grid">
                <!-- Carte pour l'activité "Tyrolienne Superman à Arenal" -->
                <div class="activity-card" data-name="Tyrolienne Superman à Arenal" data-price="95">
                    <!-- Image de l'activité -->
                    <img src="https://media-cdn.tripadvisor.com/media/attractions-splice-spp-720x480/0c/10/b9/cb.jpg" alt="Tyrolienne Superman à Arenal">
                    <!-- Titre de l'activité -->
                    <h3>Tyrolienne Superman à Arenal</h3>
                    <!-- Description de l'activité -->
                    <p>Volez comme Superman au-dessus de la canopée tropicale avec une tyrolienne géante près du volcan Arenal.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">95 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Tyrolienne Superman à Arenal][qte]" value="0">
                        <input type="hidden" name="activites[Tyrolienne Superman à Arenal][prix]" value="95">
                    </div>
                </div>

                <!-- Carte pour l'activité "Saut à l'élastique au Rio Savegre" -->
                <div class="activity-card" data-name="Saut à l'élastique au Rio Savegre" data-price="120">
                    <!-- Image de l'activité -->
                    <img src="https://th.bing.com/th/id/R.beb356e60836846f2c0d093f6df6b69d?rik=yASqA50wzDsvXQ&pid=ImgRaw&r=0" alt="Saut à l'élastique Rio Savegre">
                    <!-- Titre de l'activité -->
                    <h3>Saut à l'élastique au Rio Savegre</h3>
                    <!-- Description de l'activité -->
                    <p>Le saut de l'ange que vous avez toujours rêvé de faire devient réalité avec un saut à l'élastique spectaculaire au-dessus de la rivière Savegre.</p>
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
                        <input type="hidden" name="activites[Saut à l'élastique au Rio Savegre][qte]" value="0">
                        <input type="hidden" name="activites[Saut à l'élastique au Rio Savegre][prix]" value="120">
                    </div>
                </div>

                <!-- Carte pour l'activité "Toboggans aquatiques géants à Splash Parque" -->
                <div class="activity-card" data-name="Toboggans aquatiques géants à Splash Parque" data-price="65">
                    <!-- Image de l'activité -->
                    <img src="https://res.cloudinary.com/luxe/t_1200/f_auto/v1/dossiers/10/Toboggan_Aquatique_Camping_Le_Moulinal.jpg" alt="Toboggans géants Splash Parque">
                    <!-- Titre de l'activité -->
                    <h3>Toboggans aquatiques géants à Splash Parque</h3>
                    <!-- Description de l'activité -->
                    <p>Soyez comme un requin dans l'eau, à pleine vitesse sur les toboggans aquatiques géants du Splash Parque.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">65 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Toboggans aquatiques géants à Splash Parque][qte]" value="0">
                        <input type="hidden" name="activites[Toboggans aquatiques géants à Splash Parque][prix]" value="65">
                    </div>
                </div>

                <!-- Carte pour l'activité "Quad" -->
                <div class="activity-card" data-name="Quad" data-price="85">
                    <!-- Image de l'activité -->
                    <img src="https://costaricaxplores.com/atv-tours/at8.jpeg" alt="quad">
                    <!-- Titre de l'activité -->
                    <h3>Quad</h3>
                    <!-- Description de l'activité -->
                    <p>Partez à l'aventure à travers les paysages spectaculaires du Costa Rica lors d'une excursion en quad ! Cette activité palpitante vous emmène sur des sentiers hors-piste, à travers des forêts tropicales luxuriantes, des collines escarpées et des plages paradisiaques.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">85 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Quad][qte]" value="0">
                        <input type="hidden" name="activites[Quad][prix]" value="85">
                    </div>
                </div>

                <!-- Carte pour l'activité "Rafting en eaux vives sur le Rio Pacuare" -->
                <div class="activity-card" data-name="Rafting en eaux vives sur le Rio Pacuare" data-price="110">
                    <!-- Image de l'activité -->
                    <img src="https://th.bing.com/th/id/OIP.2NKv6e2ECCetEK9261cEZQHaEH?rs=1&pid=ImgDetMain" alt="Rafting en eaux vives Rio Pacuare">
                    <!-- Titre de l'activité -->
                    <h3>Rafting en eaux vives sur le Rio Pacuare</h3>
                    <!-- Description de l'activité -->
                    <p>Affrontez les rapides endiablés du Rio Pacuare lors d'une expérience de rafting extrême.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">110 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Rafting en eaux vives sur le Rio Pacuare][qte]" value="0">
                        <input type="hidden" name="activites[Rafting en eaux vives sur le Rio Pacuare][prix]" value="110">
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