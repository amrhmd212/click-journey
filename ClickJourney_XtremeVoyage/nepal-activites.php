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
    <title>Népal - Xtreme Voyage</title>
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
        <!-- Image du Népal -->
        <img src="https://images.unsplash.com/photo-1611516491426-03025e6043c8?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8biVDMyVBOXBhbHxlbnwwfHwwfHx8MA%3D%3D" alt="Népal">
        <!-- Titre principal de la page -->
        <h1 class="main-title">Népal</h1>
    </header>

    <!-- Contenu principal de la page -->
    <main>
        <form method="POST" action="nepal-activites.php">
            <section class="destination-section">
                <div class="activity-grid">
                    <!-- Carte pour l'activité "Saut en parachute Everest" -->
                    <div class="activity-card" data-name="Saut en parachute Everest" data-price="3000">
                        <!-- Image de l'activité -->
                        <img src="https://th.bing.com/th/id/OIP.3etlMwPG7b4bjZWCVKaLRQHaFo?rs=1&pid=ImgDetMain" alt="Saut en parachute Everest">
                        <!-- Titre de l'activité -->
                        <h3>Saut en parachute Everest</h3>
                        <!-- Description de l'activité -->
                        <p>Sens le souffle glacé des cimes himalayennes en te jetant dans le vide à plus de 8000 mètres d'altitude. Un saut unique au monde, au-dessus du toit de la planète — là où l'oxygène se fait rare, mais l'émotion déborde.</p>
                        <!-- Prix de l'activité -->
                        <p class="price">3000 € / personne</p>
                        <div class="activity-actions">
                            <!-- Sélecteur de quantité -->
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <!-- Champs cachés pour envoyer les données de l'activité -->
                            <input type="hidden" name="activites[Saut en parachute Everest][qte]" value="0">
                            <input type="hidden" name="activites[Saut en parachute Everest][prix]" value="3000">
                        </div>
                    </div>

                    <!-- Carte pour l'activité "Gravir le mont Everest" -->
                    <div class="activity-card" data-name="Gravir le mont Everest" data-price="10000">
                        <!-- Image de l'activité -->
                        <img src="https://static.actu.fr/uploads/2021/07/195288075-868331633758171-1120208792857451572-n.jpg" alt="Gravir le mont Everest">
                        <!-- Titre de l'activité -->
                        <h3>Gravir le mont Everest</h3>
                        <!-- Description de l'activité -->
                        <p>Plus qu'un sommet, une légende. Gravir l'Everest, c'est défier la nature dans ce qu'elle a de plus extrême, et écrire ton nom là où seuls les plus déterminés posent le pied. Un rêve d'altitude, une conquête intérieure.</p>
                        <!-- Prix de l'activité -->
                        <p class="price">10000 € / personne</p>
                        <div class="activity-actions">
                            <!-- Sélecteur de quantité -->
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <!-- Champs cachés pour envoyer les données de l'activité -->
                            <input type="hidden" name="activites[Gravir le mont Everest][qte]" value="0">
                            <input type="hidden" name="activites[Gravir le mont Everest][prix]" value="10000">
                        </div>
                    </div>

                    <!-- Carte pour l'activité "Vol en wingsuit sur l'Himalaya" -->
                    <div class="activity-card" data-name="Vol en wingsuit sur l'Himalaya" data-price="350">
                        <!-- Image de l'activité -->
                        <img src="https://i.pinimg.com/736x/a5/53/81/a553813002bf6d7da65aac752ab1084c--wingsuit-flying-skydiving.jpg" alt="Vol en wingsuit">
                        <!-- Titre de l'activité -->
                        <h3>Vol en wingsuit sur l'Himalaya</h3>
                        <!-- Description de l'activité -->
                        <p>Plane au-dessus des sommets enneigés comme un aigle céleste. En wingsuit, l'Himalaya devient ton terrain de jeu infini, entre crêtes acérées et vallées brumeuses. La liberté prend ici une toute autre dimension.</p>
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
                            <input type="hidden" name="activites[Vol en wingsuit sur l'Himalaya][qte]" value="0">
                            <input type="hidden" name="activites[Vol en wingsuit sur l'Himalaya][prix]" value="350">
                        </div>
                    </div>

                    <!-- Carte pour l'activité "Free Solo sur une paroi de l'Himalaya" -->
                    <div class="activity-card" data-name="Free Solo sur une paroi de l'Himalaya" data-price="500">
                        <!-- Image de l'activité -->
                        <img src="https://media.self.com/photos/5c755d30ee64504e93bda955/master/w_1280%2Cc_limit/FreeSolo_17.jpg" alt="Free Solo Himalaya">
                        <!-- Titre de l'activité -->
                        <h3>Free Solo sur une paroi de l'Himalaya</h3>
                        <!-- Description de l'activité -->
                        <p>Aucun câble. Aucune seconde chance. Juste toi, le vide et la paroi. Le free solo en Himalaya est une danse entre la vie et l'abîme, réservée à ceux qui ont la maîtrise du geste et la folie du vertige.</p>
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
                            <input type="hidden" name="activites[Free Solo sur une paroi de l'Himalaya][qte]" value="0">
                            <input type="hidden" name="activites[Free Solo sur une paroi de l'Himalaya][prix]" value="500">
                        </div>
                    </div>

                    <!-- Carte pour l'activité "Spéléologie dans les grottes glacées" -->
                    <div class="activity-card" data-name="Spéléologie dans les grottes glacées" data-price="100">
                        <!-- Image de l'activité -->
                        <img src="https://mehr-berge.de/wp-content/uploads/2019/10/Eisriesenwelt_Werfen_SalzburgerLand_MoerkGletscher_CF003124-420x309.jpg" alt="Spéléologie dans les grottes glacées">
                        <!-- Titre de l'activité -->
                        <h3>Spéléologie dans les grottes glacées</h3>
                        <!-- Description de l'activité -->
                        <p>Entre cristaux gelés, silence souterrain et tunnels de glace éternelle, explore les entrailles figées de l'Himalaya. Une aventure où chaque pas résonne comme un secret enfoui dans les glaces millénaires.</p>
                        <!-- Prix de l'activité -->
                        <p class="price">100 € / personne</p>
                        <div class="activity-actions">
                            <!-- Sélecteur de quantité -->
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <!-- Champs cachés pour envoyer les données de l'activité -->
                            <input type="hidden" name="activites[Spéléologie dans les grottes glacées][qte]" value="0">
                            <input type="hidden" name="activites[Spéléologie dans les grottes glacées][prix]" value="100">
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
            </section>
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