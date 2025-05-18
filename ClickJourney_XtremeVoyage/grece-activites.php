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
    <title>Grèce - Xtreme Voyage</title>
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
        <!-- Image de la Grèce -->
        <img src="https://static.posters.cz/image/hp/59726.jpg" alt="Grèce">
        <!-- Titre principal de la page -->
        <h1 class="main-title">Grèce</h1>
    </header>

    <!-- Contenu principal de la page -->
    <main>
        <form method="POST" action="grece-activites.php">
            <section class="activity-grid">
                <!-- Carte pour l'activité "Visiter l'Acropole d'Athènes" -->
                <div class="activity-card" data-name="Visiter l'Acropole d'Athènes" data-price="15">
                    <!-- Image de l'activité -->
                    <img src="https://images.musement.com/cover/0137/66/thumb_13665620_cover_header.jpeg" alt="Acropole d'Athènes">
                    <!-- Titre de l'activité -->
                    <h3>Visiter l'Acropole d'Athènes</h3>
                    <!-- Description de l'activité -->
                    <p>Marche dans les pas des anciens dieux au sommet de l'Acropole. Entre colonnes majestueuses et mythes éternels, découvre le berceau éclatant de la civilisation occidentale.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">15 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Visiter l'Acropole d'Athènes][qte]" value="0">
                        <input type="hidden" name="activites[Visiter l'Acropole d'Athènes][prix]" value="15">
                    </div>
                </div>

                <!-- Carte pour l'activité "Naviguer entre les îles grecques" -->
                <div class="activity-card" data-name="Naviguer entre les îles grecques" data-price="50">
                    <!-- Image de l'activité -->
                    <img src="https://www.voyageavecnous.fr/wp-content/uploads/2018/08/les-plus-belles-iles-grecques.jpg" alt="Navigation entre les îles grecques">
                    <!-- Titre de l'activité -->
                    <h3>Naviguer entre les îles grecques</h3>
                    <!-- Description de l'activité -->
                    <p>Hisse les voiles et pars à la conquête des Cyclades. Chaque île est un joyau, chaque escale une parenthèse de lumière entre mer azur et villages blancs.</p>
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
                        <input type="hidden" name="activites[Naviguer entre les îles grecques][qte]" value="0">
                        <input type="hidden" name="activites[Naviguer entre les îles grecques][prix]" value="50">
                    </div>
                </div>

                <!-- Carte pour l'activité "Se baigner à Navagio Beach" -->
                <div class="activity-card" data-name="Se baigner à Navagio Beach" data-price="25">
                    <!-- Image de l'activité -->
                    <img src="https://rencontres-tourisme-culturel.fr/wp-content/uploads/2021/06/Explorer-la-plage-de-Navagio-plage-du-naufrage-a-Zakynthos.jpg" alt="Navagio Beach à Zakynthos">
                    <!-- Titre de l'activité -->
                    <h3>Se baigner à Navagio Beach</h3>
                    <!-- Description de l'activité -->
                    <p>Entouré de falaises vertigineuses, plonge dans les eaux cristallines de Navagio Beach. Une crique secrète, légendaire, où repose l'épave d'un passé oublié.</p>
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
                        <input type="hidden" name="activites[Se baigner à Navagio Beach][qte]" value="0">
                        <input type="hidden" name="activites[Se baigner à Navagio Beach][prix]" value="25">
                    </div>
                </div>

                <!-- Carte pour l'activité "Explorer les Météores" -->
                <div class="activity-card" data-name="Explorer les Météores" data-price="75">
                    <!-- Image de l'activité -->
                    <img src="https://www.en-vols.com/wp-content/uploads/afmm/2022/10/GettyImages-1364817970_Meteores_monasteres_Michelin.jpg" alt="Météores et monastères">
                    <!-- Titre de l'activité -->
                    <h3>Explorer les Météores</h3>
                    <!-- Description de l'activité -->
                    <p>Élevez votre esprit en gravissant les sentiers menant aux monastères suspendus du ciel. Un lieu mystique où la foi et la nature s'embrassent dans le silence des hauteurs.</p>
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
                        <input type="hidden" name="activites[Explorer les Météores][qte]" value="0">
                        <input type="hidden" name="activites[Explorer les Météores][prix]" value="75">
                    </div>
                </div>

                <!-- Carte pour l'activité "Se baigner dans les sources chaudes de Loutraki" -->
                <div class="activity-card" data-name="Se baigner dans les sources chaudes de Loutraki" data-price="100">
                    <!-- Image de l'activité -->
                    <img src="https://visiter-santorini.fr/wp-content/uploads/2021/11/IMG_20211123_152034-scaled.jpg" alt="Sources chaudes de Loutraki">
                    <!-- Titre de l'activité -->
                    <h3>Se baigner dans les sources chaudes de Loutraki</h3>
                    <!-- Description de l'activité -->
                    <p>Laisse les eaux thermales envelopper ton corps au cœur d'un décor paisible. À Loutraki ou Edipsos, chaque bain est un instant de pure renaissance grecque.</p>
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
                        <input type="hidden" name="activites[Se baigner dans les sources chaudes de Loutraki][qte]" value="0">
                        <input type="hidden" name="activites[Se baigner dans les sources chaudes de Loutraki][prix]" value="100">
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