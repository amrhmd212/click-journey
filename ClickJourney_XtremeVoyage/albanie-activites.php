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
    <title>Albanie - Xtreme Voyage</title>
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
        <!-- Image de l'Albanie -->
        <img src="https://www.voyagealbanie.com/cdn/al-public/lac_albanie.jpg" alt="Albanie">
        <!-- Titre principal de la page -->
        <h1 class="main-title">Albanie</h1>
    </header>

    <!-- Contenu principal de la page -->
    <main>
        <form method="POST" action="albanie-activites.php">
            <section class="activity-grid">

                <!-- Carte pour l'activité "Parapente à la plage de Dhermi" -->
                <div class="activity-card" data-name="Parapente à la plage de Dhermi" data-price="120">
                    <!-- Image de l'activité -->
                    <img src="https://th.bing.com/th/id/R.eed3ba7165a6dd74556d32ea55cf2c3e?rik=2ore1Z81RO5WqQ&pid=ImgRaw&r=0" alt="Parapente à Dhermi">
                    <!-- Titre de l'activité -->
                    <h3>Parapente à la plage de Dhermi</h3>
                    <!-- Description de l'activité -->
                    <p>Alliez magnifique paysages et vus avec les sensations fortes et olez en parapente au-dessus de la magnifique plage de Dhermi.</p>
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
                        <input type="hidden" name="activites[Parapente à la plage de Dhermi][qte]" value="0">
                        <input type="hidden" name="activites[Parapente à la plage de Dhermi][prix]" value="120">
                    </div>
                </div>

                <!-- Carte pour l'activité "Descente en rafting dans la rivière Vjosa" -->
                <div class="activity-card" data-name="Descente en rafting dans la rivière Vjosa" data-price="80">
                    <!-- Image de l'activité -->
                    <img src="https://media-cdn.tripadvisor.com/media/attractions-splice-spp-720x480/0a/2e/ad/7a.jpg" alt="Rafting sur la rivière Vjosa">
                    <!-- Titre de l'activité -->
                    <h3>Descente en rafting dans la rivière Vjosa</h3>
                    <!-- Description de l'activité -->
                    <p>Naviguez sur les eaux endiablées de la rivière Vjosa en rafting.</p>
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
                        <input type="hidden" name="activites[Descente en rafting dans la rivière Vjosa][qte]" value="0">
                        <input type="hidden" name="activites[Descente en rafting dans la rivière Vjosa][prix]" value="80">
                    </div>
                </div>

                <!-- Carte pour l'activité "Plongée sous-marine à Karaburun" -->
                <div class="activity-card" data-name="Plongée sous-marine à Karaburun" data-price="90">
                    <!-- Image de l'activité -->
                    <img src="https://media-cdn.tripadvisor.com/media/attractions-splice-spp-720x480/07/82/39/82.jpg" alt="Plongée sous-marine à Karaburun">
                    <!-- Titre de l'activité -->
                    <h3>Plongée sous-marine à Karaburun</h3>
                    <!-- Description de l'activité -->
                    <p>Explorez les fonds marins fascinants de Karaburun, entre récifs de corail, épaves de navires et vie marine colorée.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">90 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Plongée sous-marine à Karaburun][qte]" value="0">
                        <input type="hidden" name="activites[Plongée sous-marine à Karaburun][prix]" value="90">
                    </div>
                </div>

                <!-- Carte pour l'activité "Trekking dans le parc national de Pindus" -->
                <div class="activity-card" data-name="Trekking dans le parc national de Pindus" data-price="60">
                    <!-- Image de l'activité -->
                    <img src="https://www.10a-tours.com/wp-content/uploads/2019/06/Trekking-Hellas-Pindos-Horseshoe-04-Exploring-the-mountains-in-Northern-Greece-1024x768.jpg" alt="Trekking dans le parc national de Pindus">
                    <!-- Titre de l'activité -->
                    <h3>Trekking dans le parc national de Pindus</h3>
                    <!-- Description de l'activité -->
                    <p>Parcourez les sentiers du parc national de Pindus pour des paysages à couper le souffle et une immersion totale dans la nature.</p>
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
                        <input type="hidden" name="activites[Trekking dans le parc national de Pindus][qte]" value="0">
                        <input type="hidden" name="activites[Trekking dans le parc national de Pindus][prix]" value="60">
                    </div>
                </div>

                <!-- Carte pour l'activité "Stand de tir" -->
                <div class="activity-card" data-name="Stand de tir" data-price="50">
                    <!-- Image de l'activité -->
                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/29/45/df/bc/tactical-shooting-inside.jpg?w=800&h=-1&s=1" alt="Stand de tir">
                    <!-- Titre de l'activité -->
                    <h3>Stand de tir</h3>
                    <!-- Description de l'activité -->
                    <p>Devenez le Hitman ou le John Wick que vous pensez être et testez votre précision dans un stand de tir professionnel.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">50 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Stand de tir][qte]" value="0">
                        <input type="hidden" name="activites[Stand de tir][prix]" value="50">
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
