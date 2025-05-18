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
    <title>Cuba - Xtreme Voyage</title>
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
        <!-- Image de Cuba -->
        <img src="https://i.f1g.fr/media/cms/orig/2023/02/24/38bc359284633b1e629b57214db6bf72caa1e8f4c00eacbdc0e86ff8e95e02d1.jpg" alt="Cuba">
        <!-- Titre principal de la page -->
        <h1 class="main-title">Cuba</h1>
    </header>

    <!-- Contenu principal de la page -->
    <main>
        <form method="POST" action="cuba-activites.php">
            <section class="activity-grid">
                <!-- Carte pour l'activité "Excursion au parc national de Topes de Collantes" -->
                <div class="activity-card" data-name="Excursion au parc national de Topes de Collantes" data-price="75">
                    <!-- Image de l'activité -->
                    <img src="https://www.cubaneotravel.com/wp-content/uploads/5.jpg" alt="Parc national de Topes de Collantes">
                    <!-- Titre de l'activité -->
                    <h3>Excursion au parc national de Topes de Collantes</h3>
                    <!-- Description de l'activité -->
                    <p>Plonge au cœur d'une nature luxuriante, entre cascades cristallines, sentiers secrets et forêts tropicales. Ce parc, joyau vert de la Sierra del Escambray, te réserve un bol d'air pur et d'évasion sauvage.</p>
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
                        <input type="hidden" name="activites[Excursion au parc national de Topes de Collantes][qte]" value="0">
                        <input type="hidden" name="activites[Excursion au parc national de Topes de Collantes][prix]" value="75">
                    </div>
                </div>

                <!-- Carte pour l'activité "Découverte de la Vallée de Viñales" -->
                <div class="activity-card" data-name="Découverte de la Vallée de Viñales" data-price="90">
                    <!-- Image de l'activité -->
                    <img src="https://image.geo.de/30376684/t/Qw/v3/w1440/r0/-/vinales-s-717541387-jpg--90416-.jpg" alt="Vallée de Viñales et cigares cubains">
                    <!-- Titre de l'activité -->
                    <h3>Découverte de la Vallée de Viñales</h3>
                    <!-- Description de l'activité -->
                    <p>D'Al Pacino à De Niro vous les tous vu en fumer, découvrez donc comment sont fabriqués les célèbres cigares cubains dans cette vallée magnifique.</p>
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
                        <input type="hidden" name="activites[Découverte de la Vallée de Viñales][qte]" value="0">
                        <input type="hidden" name="activites[Découverte de la Vallée de Viñales][prix]" value="90">
                    </div>
                </div>

                <!-- Carte pour l'activité "Croisière en vieux voilier" -->
                <div class="activity-card" data-name="Croisière en vieux voilier" data-price="110">
                    <!-- Image de l'activité -->
                    <img src="https://www.lifeventsgroup.com/images/incentive-activites-mer-croisiere-en-vieux-greement-mythique-01.jpg" alt="Croisière en vieux voilier">
                    <!-- Titre de l'activité -->
                    <h3>Croisière en vieux voilier</h3>
                    <!-- Description de l'activité -->
                    <p>Mets les voiles sur les eaux turquoise des Caraïbes, à bord d'un voilier d'époque qui sent bon les grandes traversées. Une aventure hors du temps, bercée par les embruns et le charme d'antan.</p>
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
                        <input type="hidden" name="activites[Croisière en vieux voilier][qte]" value="0">
                        <input type="hidden" name="activites[Croisière en vieux voilier][prix]" value="110">
                    </div>
                </div>

                <!-- Carte pour l'activité "Visite de la forteresse Castillo del Morro" -->
                <div class="activity-card" data-name="Visite de la forteresse Castillo del Morro" data-price="50">
                    <!-- Image de l'activité -->
                    <img src="https://thumbs.dreamstime.com/b/san-salvador-de-la-punta-fortress-est-une-forteresse-dans-la-baie-de-la-havane-cuba-66090121.jpg" alt="Forteresse Castillo del Morro">
                    <!-- Titre de l'activité -->
                    <h3>Visite de la forteresse Castillo del Morro</h3>
                    <!-- Description de l'activité -->
                    <p>Garde fièrement l'entrée de la baie de La Havane, cette citadelle du XVIe siècle dévoile ses secrets aux voyageurs curieux. Entre canons, murs de pierre et vues imprenables, l'Histoire se raconte au fil des remparts.</p>
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
                        <input type="hidden" name="activites[Visite de la forteresse Castillo del Morro][qte]" value="0">
                        <input type="hidden" name="activites[Visite de la forteresse Castillo del Morro][prix]" value="50">
                    </div>
                </div>

                <!-- Carte pour l'activité "Promenade en voiture américaine vintage" -->
                <div class="activity-card" data-name="Promenade en voiture américaine vintage" data-price="85">
                    <!-- Image de l'activité -->
                    <img src="https://img.freepik.com/premium-photo/colorful-street-in-havana-cuba-with-vintage-cars-and-colonial-architecture_1072167-2589.jpg" alt="Promenade en voiture américaine vintage">
                    <!-- Titre de l'activité -->
                    <h3>Promenade en voiture américaine vintage</h3>
                    <!-- Description de l'activité -->
                    <p>Glisse-toi dans un film des années 50 le temps d'une virée en décapotable colorée. Chromes étincelants, musique rétro et ambiance cubaine : la Havane n'a jamais été aussi iconique.</p>
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
                        <input type="hidden" name="activites[Promenade en voiture américaine vintage][qte]" value="0">
                        <input type="hidden" name="activites[Promenade en voiture américaine vintage][prix]" value="85">
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