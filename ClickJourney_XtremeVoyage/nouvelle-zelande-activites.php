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
    <title>Nouvelle-Zélande - Xtreme Voyage</title>
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
        <!-- Image de la Nouvelle-Zélande -->
        <img src="https://images.unsplash.com/photo-1597655601841-214a4cfe8b2c?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8bmV3JTIwemVhbGFuZHxlbnwwfHwwfHx8MA%3D%3D" alt="Nouvelle-Zélande">
        <!-- Titre principal de la page -->
        <h1 class="main-title">Nouvelle-Zélande</h1>
    </header>

    <!-- Contenu principal de la page -->
    <main>
        <form method="POST" action="nouvelle-zelande-activites.php">
            <section class="destination-section">
                <div class="activity-grid">
                    <!-- Carte pour l'activité "Parapente au coucher du soleil à Nelson" -->
                    <div class="activity-card" data-name="Parapente au coucher du soleil à Nelson" data-price="75">
                        <!-- Image de l'activité -->
                        <img src="https://th.bing.com/th/id/R.ffa650bc37de5d4e54111c7131b606b0?rik=BJ0uj5%2b0Cc%2fwow&pid=ImgRaw&r=0" alt="Parapente à Nelson">
                        <!-- Titre de l'activité -->
                        <h3>Parapente au coucher du soleil à Nelson</h3>
                        <!-- Description de l'activité -->
                        <p>Alliez les sensations et les paysages spectaculaires de Nelson depuis les airs, à l'heure dorée du coucher du soleil.</p>
                        <!-- Prix de l'activité -->
                        <p class="price">75 € / personne</p>
                        <div class="activity-actions">
                            <!-- Sélecteur de quantité -->
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                            <!-- Champs cachés pour envoyer les données de l'activité -->
                            <input type="hidden" name="activites[Parapente au coucher du soleil à Nelson][qte]" value="0">
                            <input type="hidden" name="activites[Parapente au coucher du soleil à Nelson][prix]" value="75">
                        </div>
                    </div>

                    <!-- Carte pour l'activité "Vol en hélicoptère et atterrissage sur un glacier" -->
                    <div class="activity-card" data-name="Vol en hélicoptère et atterrissage sur un glacier" data-price="500">
                        <!-- Image de l'activité -->
                        <img src="https://th.bing.com/th/id/R.a885484f84bd33f34635d3fdf8d38bc0?rik=bcK52BrW3MsTvw&pid=ImgRaw&r=0" alt="Vol en hélicoptère Mont Cook">
                        <!-- Titre de l'activité -->
                        <h3>Vol en hélicoptère et atterrissage sur un glacier</h3>
                        <!-- Description de l'activité -->
                        <p>Survolez le Mont Cook et atterrissez sur un glacier pour une aventure inoubliable au sommet de la nature sauvage.</p>
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
                            <input type="hidden" name="activites[Vol en hélicoptère et atterrissage sur un glacier][qte]" value="0">
                            <input type="hidden" name="activites[Vol en hélicoptère et atterrissage sur un glacier][prix]" value="500">
                        </div>
                    </div>

                    <!-- Carte pour l'activité "Canyoning à Wanaka" -->
                    <div class="activity-card" data-name="Canyoning à Wanaka" data-price="45">
                        <!-- Image de l'activité -->
                        <img src="https://th.bing.com/th/id/R.45eef51154af5646792e07f9f5c35cbe?rik=uwz3XskiCjJncw&pid=ImgRaw&r=0" alt="Canyoning à Wanaka">
                        <!-- Titre de l'activité -->
                        <h3>Canyoning à Wanaka</h3>
                        <!-- Description de l'activité -->
                        <p>Plongez dans l'aventure avec des descentes en rappel, des sauts et des glissades dans les gorges de Wanaka.</p>
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
                            <input type="hidden" name="activites[Canyoning à Wanaka][qte]" value="0">
                            <input type="hidden" name="activites[Canyoning à Wanaka][prix]" value="45">
                        </div>
                    </div>

                    <!-- Carte pour l'activité "Saut en parachute" -->
                    <div class="activity-card" data-name="Saut en parachute" data-price="250">
                        <!-- Image de l'activité -->
                        <img src="https://th.bing.com/th/id/OIP.eQfCKZPeDX1sDydasgJ3PAAAAA?rs=1&pid=ImgDetMain" alt="Saut en parachute">
                        <!-- Titre de l'activité -->
                        <h3>Saut en parachute</h3>
                        <!-- Description de l'activité -->
                        <p>Faites le grand saut et admirez les panoramas à couper le souffle de la Nouvelle-Zélande en chute libre.</p>
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
                            <input type="hidden" name="activites[Saut en parachute][qte]" value="0">
                            <input type="hidden" name="activites[Saut en parachute][prix]" value="250">
                        </div>
                    </div>

                    <!-- Carte pour l'activité "Jet Boating à Shotover River" -->
                    <div class="activity-card" data-name="Jet Boating à Shotover River" data-price="60">
                        <!-- Image de l'activité -->
                        <img src="https://th.bing.com/th/id/OIP.LqWL3PzY1mrnYxu-FBNybwHaE8?rs=1&pid=ImgDetMain" alt="Jet Boating à Shotover River">
                        <!-- Titre de l'activité -->
                        <h3>Jet Boating à Shotover River</h3>
                        <!-- Description de l'activité -->
                        <p>Vivez une expérience à grande vitesse en naviguant dans les canyons étroits de la Shotover River.</p>
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
                            <input type="hidden" name="activites[Jet Boating à Shotover River][qte]" value="0">
                            <input type="hidden" name="activites[Jet Boating à Shotover River][prix]" value="60">
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