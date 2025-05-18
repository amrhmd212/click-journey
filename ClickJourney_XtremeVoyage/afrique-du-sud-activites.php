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
    <title>Afrique du Sud - Xtreme Voyage</title>
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
        <!-- Image de l'Afrique du Sud -->
        <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGFmcmlxdWUlMjBkdSUyMHN1ZHxlbnwwfHwwfHx8MA%3D%3D" alt="Afrique du Sud">
        <!-- Titre principal de la page -->
        <h1 class="main-title">Afrique du Sud</h1>
    </header>

    <!-- Contenu principal de la page -->
    <main>
        <form method="POST" action="afrique-du-sud-activites.php">
            <section class="activity-grid">

                <!-- Carte pour l'activité "Saut à l'élastique du Bloukrans Bridge" -->
                <div class="activity-card" data-name="Saut à l'élastique du Bloukrans Bridge" data-price="120">
                    <!-- Image de l'activité -->
                    <img src="https://res.cloudinary.com/manawa/image/private/f_auto,c_limit,w_1080,q_auto/ab66d4047213537120df19674f00e8aa" alt="Saut à l'élastique Bloukrans Bridge">
                    <!-- Titre de l'activité -->
                    <h3>Saut à l'élastique du Bloukrans Bridge</h3>
                    <!-- Description de l'activité -->
                    <p>Fan d'Assassin's Creed vous en avez toujours rêvé et le moment est venu, faites le saut de l'ange depuis le plus haut pont de saut à l'élastique du monde.</p>
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
                        <input type="hidden" name="activites[Saut à l'élastique du Bloukrans Bridge][qte]" value="0">
                        <input type="hidden" name="activites[Saut à l'élastique du Bloukrans Bridge][prix]" value="120">
                    </div>
                </div>

                <!-- Carte pour l'activité "Plongée en cage avec les requins" -->
                <div class="activity-card" data-name="Plongée en cage avec les requins" data-price="95">
                    <!-- Image de l'activité -->
                    <img src="https://www.airvacances.fr/wp-content/uploads/2020/08/requin_blanc-cage-de-plongee.jpg" alt="Plongée en cage avec les requins">
                    <!-- Titre de l'activité -->
                    <h3>Plongée en cage avec les requins</h3>
                    <!-- Description de l'activité -->
                    <p>Ose regarder dans les yeux l'un des plus redoutables prédateurs de l'océan. À Gansbaai, entre adrénaline pure et silence des profondeurs, chaque seconde en cage face au grand requin blanc est un frisson inoubliable.</p>
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
                        <input type="hidden" name="activites[Plongée en cage avec les requins][qte]" value="0">
                        <input type="hidden" name="activites[Plongée en cage avec les requins][prix]" value="95">
                    </div>
                </div>

                <!-- Carte pour l'activité "Le Big Swing de Graskop Gorge" -->
                <div class="activity-card" data-name="Le Big Swing de Graskop Gorge" data-price="80">
                    <!-- Image de l'activité -->
                    <img src="https://storage.experiencedays.co.za/images/graskop%20gorge%20swing%20experience%20with%20zipline-1920x1080-resize.jpg" alt="Le Big Swing de Graskop Gorge">
                    <!-- Titre de l'activité -->
                    <h3>Le Big Swing de Graskop Gorge</h3>
                    <!-- Description de l'activité -->
                    <p>Lance-toi dans le vide depuis la falaise, suspendu au-dessus d'un gouffre verdoyant. Sensations extrêmes garanties dans ce saut spectaculaire, où le ciel rencontre la forêt sud-africaine.</p>
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
                        <input type="hidden" name="activites[Le Big Swing de Graskop Gorge][qte]" value="0">
                        <input type="hidden" name="activites[Le Big Swing de Graskop Gorge][prix]" value="80">
                    </div>
                </div>

                <!-- Carte pour l'activité "Safari à pied avec les Big Five" -->
                <div class="activity-card" data-name="Safari à pied avec les Big Five" data-price="150">
                    <!-- Image de l'activité -->
                    <img src="https://www.tanzanie-authentique.com/Website/w5/diapothumb/10-safari-de-nuit-en-4x4-549181.jpg" alt="Safari avec les Big Five">
                    <!-- Titre de l'activité -->
                    <h3>Safari à pied avec les Big Five</h3>
                    <!-- Description de l'activité -->
                    <p>Marche sur les traces des rois de la savane. Affronte le regard du lion, croise l'ombre d'un éléphant ou d'un léopard, et ressens le battement brut de la nature, là où le mythe devient réel.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">150 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Safari à pied avec les Big Five][qte]" value="0">
                        <input type="hidden" name="activites[Safari à pied avec les Big Five][prix]" value="150">
                    </div>
                </div>

                <!-- Carte pour l'activité "Spéléologie dans les grottes de Cango" -->
                <div class="activity-card" data-name="Spéléologie dans les grottes de Cango" data-price="65">
                    <!-- Image de l'activité -->
                    <img src="https://th.bing.com/th/id/R.9200c91daed1769e0cabed7afa184c7e?rik=SklTYLHVr9fHFA&pid=ImgRaw&r=0" alt="Spéléologie grottes de Cango">
                    <!-- Titre de l'activité -->
                    <h3>Spéléologie dans les grottes de Cango</h3>
                    <!-- Description de l'activité -->
                    <p>Descends dans les entrailles de la terre et explore un monde sculpté par le temps. Colonnes titanesques, galeries mystérieuses et silence minéral : les grottes de Cango sont une aventure souterraine à couper le souffle.</p>
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
                        <input type="hidden" name="activites[Spéléologie dans les grottes de Cango][qte]" value="0">
                        <input type="hidden" name="activites[Spéléologie dans les grottes de Cango][prix]" value="65">
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
    <script src="js/theme.js"></script>
    <script src="js/activites.js"></script>
</body>
</html>