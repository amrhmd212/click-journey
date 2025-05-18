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
        
         <!-- Titre principal de la page -->
        <h1 class="main-title">Indonésie</h1>
        <!-- Image de l'Indonésie -->
        <img src="https://voyagescouture-production.s3.amazonaws.com/uploads/images/countries/ccb99c8e-088f-4078-b099-517e9e611f3e/Indone%CC%81sie%20-%20%C2%A9geio-tischler-7hww7t6NLcg-unsplash.jpg" alt="Indonésie">
    </header>
    
    <!-- Contenu principal de la page -->
    <main>
        <form method="POST" action="indonesie-activites.php">
            <section class="activity-grid">
                <!-- Carte pour l'activité "Ascension du volcan actif Semeru" -->
                <div class="activity-card" data-name="Ascension du volcan actif Semeru" data-price="180">
                    <!-- Image de l'activité -->
                    <img src="https://th.bing.com/th/id/OIP.o9Ir3vHYsQYU0062ZcmaRAHaJ-?rs=1&pid=ImgDetMain" alt="Ascension du volcan Semeru">
                    <!-- Titre de l'activité -->
                    <h3>Ascension du volcan actif Semeru</h3>
                    <!-- Description de l'activité -->
                    <p>Gravir le Semeru, c'est flirter avec la puissance brute de la Terre. Fumées, roches volcaniques et ciel infini t'attendent au sommet de ce géant indonésien. Une aventure pour ceux qui rêvent de marcher sur le fil du monde.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">180 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Ascension du volcan actif Semeru][qte]" value="0">
                        <input type="hidden" name="activites[Ascension du volcan actif Semeru][prix]" value="180">
                    </div>
                </div>

                <!-- Carte pour l'activité "Plongée avec les dragons de Komodo" -->
                <div class="activity-card" data-name="Plongée avec les dragons de Komodo" data-price="220">
                    <!-- Image de l'activité -->
                    <img src="https://i.pinimg.com/originals/b9/bd/73/b9bd73f297d3934c00b834aae79ae20a.jpg" alt="Plongée avec les dragons de Komodo">
                    <!-- Titre de l'activité -->
                    <h3>Plongée avec les dragons de Komodo</h3>
                    <!-- Description de l'activité -->
                    <p>Ils ne volent pas et ne crachent pas de feu, mais ils sont tout aussi dangereux que les mythiques dragons. Plongez dans les eaux de Komodo et faites face aux célèbres dragons de Komodo.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">220 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Plongée avec les dragons de Komodo][qte]" value="0">
                        <input type="hidden" name="activites[Plongée avec les dragons de Komodo][prix]" value="220">
                    </div>
                </div>

                <!-- Carte pour l'activité "Surf sur les vagues de G-Land" -->
                <div class="activity-card" data-name="Surf sur les vagues de G-Land" data-price="150">
                    <!-- Image de l'activité -->
                    <img src="https://www.surf-report.com/img/pictures/2022/20220603/thumbnail/2206035469.png" alt="Surf sur les vagues de G-Land">
                    <!-- Titre de l'activité -->
                    <h3>Surf sur les vagues de G-Land</h3>
                    <!-- Description de l'activité -->
                    <p>G-Land, c'est le rendez-vous des dieux du surf. Ici, les vagues grondent comme un tambour de guerre. Chaque ride est une danse entre maîtrise et folie, réservée aux âmes courageuses qui osent défier l'océan.</p>
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
                        <input type="hidden" name="activites[Surf sur les vagues de G-Land][qte]" value="0">
                        <input type="hidden" name="activites[Surf sur les vagues de G-Land][prix]" value="150">
                    </div>
                </div>

                <!-- Carte pour l'activité "Plongée avec les requins-marteaux à Alor" -->
                <div class="activity-card" data-name="Plongée avec les requins-marteaux à Alor" data-price="250">
                    <!-- Image de l'activité -->
                    <img src="https://production-livingdocs-bluewin-ch.imgix.net/2020/3/5/485f1b66-3f3c-4898-8ed5-c317f7b5b23c.jpeg?w=726&auto=format" alt="Plongée avec les requins-marteaux à Alor">
                    <!-- Titre de l'activité -->
                    <h3>Plongée avec les requins-marteaux à Alor</h3>
                    <!-- Description de l'activité -->
                    <p>Dans les eaux cristallines d'Alor, les silhouettes spectrales des requins-marteaux glissent en silence. Une plongée entre fascination et frisson, au cœur d'un ballet marin aussi mystérieux qu'inoubliable.</p>
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
                        <input type="hidden" name="activites[Plongée avec les requins-marteaux à Alor][qte]" value="0">
                        <input type="hidden" name="activites[Plongée avec les requins-marteaux à Alor][prix]" value="250">
                    </div>
                </div>

                <!-- Carte pour l'activité "Saut en wingsuit à Bali" -->
                <div class="activity-card" data-name="Saut en wingsuit à Bali" data-price="300">
                    <!-- Image de l'activité -->
                    <img src="https://www.zinfos974.com/photo/art/grande/59537714-43732380.jpg?v=1634214181" alt="Saut en wingsuit depuis les falaises de Bali">
                    <!-- Titre de l'activité -->
                    <h3>Saut en wingsuit à Bali</h3>
                    <!-- Description de l'activité -->
                    <p>Sens le vent te porter au-dessus des falaises émeraude et des plages dorées. En wingsuit, Bali se dévoile comme jamais : grandiose, sauvage, libre. Une envolée spectaculaire pour les amoureux du ciel.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">300 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Saut en wingsuit à Bali][qte]" value="0">
                        <input type="hidden" name="activites[Saut en wingsuit à Bali][prix]" value="300">
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

    <script src="js/activites.js"></script>
    <script src="js/theme.js"></script>

</body>
</html>