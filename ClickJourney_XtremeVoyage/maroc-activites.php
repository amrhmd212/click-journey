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
    <title>Maroc - Xtreme Voyage</title>
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
        <!-- Image du Maroc -->
        <img src="https://assets.micontenthub.com/traveloffers/travel-tips/de-la-mer-au-desert-des-montagnes-aux-vallees-decouvrez-les-tresors-du-royaume-du-maroc-4_qhGWlS6qg.jpg" alt="Maroc">
        <!-- Titre principal de la page -->
        <h1 class="main-title">Maroc</h1>
    </header>

    <!-- Contenu principal de la page -->
    <main>
        <form method="POST" action="maroc-activites.php">
            <section class="activity-grid">
                <!-- Carte pour l'activité "Monter à dos de chameau dans le désert de Merzouga" -->
                <div class="activity-card" data-name="Monter à dos de chameau dans le désert de Merzouga" data-price="90">
                    <!-- Image de l'activité -->
                    <img src="https://img.freepik.com/premium-photo/camel-caravan-rides-through-moroccan-desert-sunset-this-creates-silhouette_1003100-866.jpg" alt="Chameau dans le désert de Merzouga">
                    <!-- Titre de l'activité -->
                    <h3>Monter à dos de chameau dans le désert de Merzouga</h3>
                    <!-- Description de l'activité -->
                    <p>Au rythme lent des sabots sur le sable, traverse les dunes embrasées du Sahara au coucher du soleil. Un voyage hors du temps, entre silence doré et immensité.</p>
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
                        <input type="hidden" name="activites[Monter à dos de chameau dans le désert de Merzouga][qte]" value="0">
                        <input type="hidden" name="activites[Monter à dos de chameau dans le désert de Merzouga][prix]" value="90">
                    </div>
                </div>

                <!-- Carte pour l'activité "Déguster un thé à la menthe dans un riad" -->
                <div class="activity-card" data-name="Déguster un thé à la menthe dans un riad" data-price="25">
                    <!-- Image de l'activité -->
                    <img src="https://african-wanderlust.com/wp-content/uploads/2018/10/Location-Riad-Marrakech-2-Almaha-Marrakech-01.jpg" alt="Thé à la menthe dans un riad">
                    <!-- Titre de l'activité -->
                    <h3>Déguster un thé à la menthe dans un riad</h3>
                    <!-- Description de l'activité -->
                    <p>Dans un patio feutré, savoure le thé à la menthe comme un rituel. Fraîcheur, tradition et douceur de vivre au coeur d'un riad marocain.</p>
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
                        <input type="hidden" name="activites[Déguster un thé à la menthe dans un riad][qte]" value="0">
                        <input type="hidden" name="activites[Déguster un thé à la menthe dans un riad][prix]" value="25">
                    </div>
                </div>

                <!-- Carte pour l'activité "Explorer les cascades d'Ouzoud" -->
                <div class="activity-card" data-name="Explorer les cascades d'Ouzoud" data-price="40">
                    <!-- Image de l'activité -->
                    <img src="https://www.voyageavecnous.fr/wp-content/uploads/2022/06/activites-aux-cascades-d-ouzoud.jpg" alt="Cascades d'Ouzoud">
                    <!-- Titre de l'activité -->
                    <h3>Explorer les cascades d'Ouzoud</h3>
                    <!-- Description de l'activité -->
                    <p>Admire les chutes vrombissantes au coeur d'un écrin de verdure. Les cascades d'Ouzoud offrent fraîcheur et spectacle au creux des montagnes berbères.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">40 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Explorer les cascades d'Ouzoud][qte]" value="0">
                        <input type="hidden" name="activites[Explorer les cascades d'Ouzoud][prix]" value="40">
                    </div>
                </div>

                <!-- Carte pour l'activité "Se détendre dans un hammam traditionnel" -->
                <div class="activity-card" data-name="Se détendre dans un hammam traditionnel" data-price="35">
                    <!-- Image de l'activité -->
                    <img src="https://th.bing.com/th/id/R.58e17120582640b22aff7a0f21d1af30?rik=MbwZXY%2f4K7ektw&pid=ImgRaw&r=0" alt="Hammam traditionnel">
                    <!-- Titre de l'activité -->
                    <h3>Se détendre dans un hammam traditionnel</h3>
                    <!-- Description de l'activité -->
                    <p>Laisse la vapeur ouvrir tes pores et apaiser ton esprit. Dans la pénombre d'un hammam marocain, la détente devient un art ancestral.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">35 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Se détendre dans un hammam traditionnel][qte]" value="0">
                        <input type="hidden" name="activites[Se détendre dans un hammam traditionnel][prix]" value="35">
                    </div>
                </div>

                <!-- Carte pour l'activité "Goûter aux saveurs du Maroc dans un souk" -->
                <div class="activity-card" data-name="Goûter aux saveurs du Maroc dans un souk" data-price="30">
                    <!-- Image de l'activité -->
                    <img src="https://c8.alamy.com/compfr/bbp8k0/souk-bazar-marche-dans-les-rues-marrakech-maroc-maghreb-afrique-du-nord-bbp8k0.jpg" alt="Saveurs du souk marocain">
                    <!-- Titre de l'activité -->
                    <h3>Goûter aux saveurs du Maroc dans un souk</h3>
                    <!-- Description de l'activité -->
                    <p>Perds-toi dans les allées parfumées de cannelle et de cumin, goûte aux tajines fumants et découvre l'âme culinaire du Maroc au coeur de ses souks animés.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">30 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Goûter aux saveurs du Maroc dans un souk][qte]" value="0">
                        <input type="hidden" name="activites[Goûter aux saveurs du Maroc dans un souk][prix]" value="30">
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