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
    <title>Suisse - Xtreme Voyage</title>
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
        <!-- Image de la Suisse -->
        <img src="https://www.laradioplus.com/media/article/image//781d2e1f-044e-41f4-a290-bf7ad27d8998.jpeg" alt="Suisse">
        <!-- Titre principal de la page -->
        <h1 class="main-title">Suisse</h1>
    </header>

    <!-- Contenu principal de la page -->
    <main>
        <form method="POST" action="suisse-activites.php">
            <section class="destination-section">
                <div class="activity-grid">
                    <!-- Carte pour l'activité "Vol acrobatique" -->
                    <div class="activity-card" data-name="Vol acrobatique" data-price="190">
                        <!-- Image de l'activité -->
                        <img src="https://thumbs.dreamstime.com/b/istanbul-turquie-septembre-un-avion-acrobatique-turc-donne-spectacle-d-a%C3%A9robatique-pendant-le-teknofest-aeronautics-pr%C3%A9sente-158495529.jpg" alt="Vol acrobatique">
                        <!-- Titre de l'activité -->
                        <h3>Vol acrobatique</h3>
                        <!-- Description de l'activité -->
                        <p>Loopings, vrilles, montées vertigineuses : enfile ton casque et deviens pilote d'un jour dans un ballet aérien au-dessus des Alpes suisses.</p>
                        <!-- Prix de l'activité -->
                        <p class="price">190 € / personne</p>
                        <div class="activity-actions">
                            <!-- Sélecteur de quantité -->
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <!-- Champs cachés pour envoyer les données de l'activité -->
                            <input type="hidden" name="activites[Vol acrobatique][qte]" value="0">
                            <input type="hidden" name="activites[Vol acrobatique][prix]" value="190">
                        </div>
                    </div>

                    <!-- Carte pour l'activité "Saut en parachute à Zermatt" -->
                    <div class="activity-card" data-name="Saut en parachute à Zermatt" data-price="250">
                        <!-- Image de l'activité -->
                        <img src="https://th.bing.com/th/id/OIP.bUXsSoUK4L-XFmY45P0UzAHaFj?rs=1&pid=ImgDetMain" alt="Saut en parachute à Zermatt">
                        <!-- Titre de l'activité -->
                        <h3>Saut en parachute à Zermatt</h3>
                        <!-- Description de l'activité -->
                        <p>Une chute libre face au Cervin : le mythe devient réalité. Une vue à couper le souffle, une expérience gravée dans le ciel.</p>
                        <!-- Prix de l'activité -->
                        <p class="price">250 € / personne</p>
                        <div class="activity-actions">
                            <!-- Sélecteur de quantité -->
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <!-- Champs cachés pour envoyer les données de l'activité -->
                            <input type="hidden" name="activites[Saut en parachute à Zermatt][qte]" value="0">
                            <input type="hidden" name="activites[Saut en parachute à Zermatt][prix]" value="250">
                        </div>
                    </div>

                    <!-- Carte pour l'activité "Vol en hélicoptère autour du Mont-Blanc" -->
                    <div class="activity-card" data-name="Vol en hélicoptère autour du Mont-Blanc" data-price="1000">
                        <!-- Image de l'activité -->
                        <img src="https://altitude-nature.fr/wp-content/uploads/2023/04/mont-blanc-helicoptere-980x653.jpg" alt="Vol en hélicoptère Mont-Blanc">
                        <!-- Titre de l'activité -->
                        <h3>Vol en hélicoptère autour du Mont-Blanc</h3>
                        <!-- Description de l'activité -->
                        <p>Survole le toit de l'Europe dans un silence majestueux. Le Mont-Blanc s'étend sous toi comme un royaume glacé et lumineux.</p>
                        <!-- Prix de l'activité -->
                        <p class="price">1000 € / personne</p>
                        <div class="activity-actions">
                            <!-- Sélecteur de quantité -->
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <!-- Champs cachés pour envoyer les données de l'activité -->
                            <input type="hidden" name="activites[Vol en hélicoptère autour du Mont-Blanc][qte]" value="0">
                            <input type="hidden" name="activites[Vol en hélicoptère autour du Mont-Blanc][prix]" value="1000">
                        </div>
                    </div>

                    <!-- Carte pour l'activité "Randonnée dans les gorges de l'Aar" -->
                    <div class="activity-card" data-name="Randonnée dans les gorges de l'Aar" data-price="45">
                        <!-- Image de l'activité -->
                        <img src="https://i.pinimg.com/originals/b9/49/c2/b949c2a567c297ce4b728e7e6073047d.jpg" alt="Randonnée dans les gorges de l'Aar">
                        <!-- Titre de l'activité -->
                        <h3>Randonnée dans les gorges de l'Aar</h3>
                        <!-- Description de l'activité -->
                        <p>Avance entre parois abruptes et rivières vives, au fond de l'une des gorges les plus impressionnantes de Suisse. Une immersion brute dans la roche vivante.</p>
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
                            <input type="hidden" name="activites[Randonnée dans les gorges de l'Aar][qte]" value="0">
                            <input type="hidden" name="activites[Randonnée dans les gorges de l'Aar][prix]" value="45">
                        </div>
                    </div>

                    <!-- Carte pour l'activité "Vol en montgolfière à Château-d'Oex" -->
                    <div class="activity-card" data-name="Vol en montgolfière à Château-d'Oex" data-price="80">
                        <!-- Image de l'activité -->
                        <img src="https://th.bing.com/th/id/R.4d9d357eff94abfe6da1c4180a3ce2dd?rik=LqsuNutUiZgCCw&pid=ImgRaw&r=0" alt="Vol en montgolfière à Château-d'Oex">
                        <!-- Titre de l'activité -->
                        <h3>Vol en montgolfière à Château-d'Oex</h3>
                        <!-- Description de l'activité -->
                        <p>Laisse le vent te guider au-dessus des prairies alpines. Une montgolfière, un lever de soleil, un panorama à 360° : l'expérience suisse par excellence.</p>
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
                            <input type="hidden" name="activites[Vol en montgolfière à Château-d'Oex][qte]" value="0">
                            <input type="hidden" name="activites[Vol en montgolfière à Château-d'Oex][prix]" value="80">
                        </div>
                    </div>
                </div>

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