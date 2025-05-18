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
    <title>Espagne - Xtreme Voyage</title>
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
        <!-- Image de l'Espagne -->
        <img src="https://www.superprof.fr/blog/wp-content/uploads/2020/08/visiter-peninsule-iberique-scaled.jpg" alt="Espagne">
        <!-- Titre principal de la page -->
        <h1 class="main-title">Espagne</h1>
    </header>

    <!-- Contenu principal de la page -->
    <main>
        <form method="POST" action="espagne-activites.php">
            <section class="activity-grid">
                <!-- Carte pour l'activité "Jet-ski sur les plages d'Espagne" -->
                <div class="activity-card" data-name="Jet-ski sur les plages d'Espagne" data-price="70">
                    <!-- Image de l'activité -->
                    <img src="https://www.civitatis.com/f/espana/cala-d-or/tour-moto-agua-calo-moro-589x392.jpg" alt="Jet-ski">
                    <!-- Titre de l'activité -->
                    <h3>Jet-ski sur les plages d'Espagne</h3>
                    <!-- Description de l'activité -->
                    <p>Vivez une expérience à grande vitesse en chevauchant les vagues sur un jet-ski au large des plages espagnoles.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">70 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Jet-ski sur les plages d'Espagne][qte]" value="0">
                        <input type="hidden" name="activites[Jet-ski sur les plages d'Espagne][prix]" value="70">
                    </div>
                </div>

                <!-- Carte pour l'activité "Port Aventura" -->
                <div class="activity-card" data-name="Port Aventura" data-price="60">
                    <!-- Image de l'activité -->
                    <img src="https://th.bing.com/th/id/OIP.2sa3KlUULpjf7CVoQlISNwHaE7?rs=1&pid=ImgDetMain" alt="Port Aventura">
                    <!-- Titre de l'activité -->
                    <h3>Port Aventura</h3>
                    <!-- Description de l'activité -->
                    <p>Découvrez des attractions palpitantes dans l'un des parcs d'attractions les plus célèbres d'Europe, à Salou.</p>
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
                        <input type="hidden" name="activites[Port Aventura][qte]" value="0">
                        <input type="hidden" name="activites[Port Aventura][prix]" value="60">
                    </div>
                </div>

                <!-- Carte pour l'activité "Karting" -->
                <div class="activity-card" data-name="Karting" data-price="45">
                    <!-- Image de l'activité -->
                    <img src="https://th.bing.com/th/id/OIP.T4ZGmY_XgJ8RtAY2DR_1WQHaE7?rs=1&pid=ImgDetMain" alt="Karting">
                    <!-- Titre de l'activité -->
                    <h3>Karting</h3>
                    <!-- Description de l'activité -->
                    <p>Max Verstappen n'est rien face à vous, faites étalage de vos talents de pilote sur des circuits de karting à travers l'Espagne.</p>
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
                        <input type="hidden" name="activites[Karting][qte]" value="0">
                        <input type="hidden" name="activites[Karting][prix]" value="45">
                    </div>
                </div>

                <!-- Carte pour l'activité "Buggy en pleine nature" -->
                <div class="activity-card" data-name="Buggy en pleine nature" data-price="80">
                    <!-- Image de l'activité -->
                    <img src="https://th.bing.com/th/id/OIP.gdcdnhE5sUEQIMZGr-EYCwAAAA?rs=1&pid=ImgDetMain" alt="Buggy en pleine nature">
                    <!-- Titre de l'activité -->
                    <h3>Buggy en pleine nature</h3>
                    <!-- Description de l'activité -->
                    <p>Explorez les paysages espagnols à bord d'un buggy tout-terrain pour une aventure hors des sentiers battus.</p>
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
                        <input type="hidden" name="activites[Buggy en pleine nature][qte]" value="0">
                        <input type="hidden" name="activites[Buggy en pleine nature][prix]" value="80">
                    </div>
                </div>

                <!-- Carte pour l'activité "Wakeboard" -->
                <div class="activity-card" data-name="Wakeboard" data-price="55">
                    <!-- Image de l'activité -->
                    <img src="https://www.theolivepress.es/wp-content/uploads/2020/06/02-1068x801.jpg" alt="Wakeboard">
                    <!-- Titre de l'activité -->
                    <h3>Wakeboard</h3>
                    <!-- Description de l'activité -->
                    <p>Glissez sur l'eau en wakeboard et testez vos figures acrobatiques sur les plus beaux lacs et plages d'Espagne.</p>
                    <!-- Prix de l'activité -->
                    <p class="price">55 € / personne</p>
                    <div class="activity-actions">
                        <!-- Sélecteur de quantité -->
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Wakeboard][qte]" value="0">
                        <input type="hidden" name="activites[Wakeboard][prix]" value="55">
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