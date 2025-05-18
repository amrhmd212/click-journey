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

    // On parcourt chaque activité pour filtrer celles qui ont une quantité supérieur à 0.
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
    <title>Portugal - Xtreme Voyage</title>

    <!-- Les liens vers les polices et les styles CSS -->
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
        <!-- Image Portugal -->
        <img src="https://experiencesdumonde.fr/wp-content/uploads/2019/06/Lisbonne-525935287.jpg" alt="Lisbonne, Portugal">
        <!-- Titre principal de la page -->
        <h1 class="main-title">Portugal</h1>
    </header>

    <!-- Contenu principal de la page -->
    <main>
        <section class="destination-section">
            <!-- Formulaire pour sélectionner des activités -->
            <form method="POST" action="portugal-activites.php">
                <div class="activity-grid">
                    <!-- Carte pour l'activité "Nager avec des dauphins" -->
                    <div class="activity-card" data-name="Nager avec des dauphins" data-price="75">
                        <!-- Image de l'activité -->
                        <img src="https://i.pinimg.com/736x/f4/36/82/f436824bf3c845a94fb0b983a872270c.jpg" alt="Nager avec des dauphins">
                        <!-- Titre de l'activité -->
                        <h3>Nager avec des dauphins</h3>
                        <!-- Description de l'activité -->
                        <p>Entre ciel et mer, nage au côté de ces esprits joueurs dans les eaux claires du Portugal. Une rencontre magique, entre douceur marine et frissons inoubliables.</p>
                        <!-- Prix de l'activité -->
                        <p class="price">75 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <!-- Boutons pour ajuster la quantité -->
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Nager avec des dauphins][qte]" value="0">
                        <input type="hidden" name="activites[Nager avec des dauphins][prix]" value="75">
                    </div>

                    <!-- Carte pour l'activité "Visite des grottes en bateau" -->
                    <div class="activity-card" data-name="Visite des grottes en bateau" data-price="45">
                        <!-- Image de l'activité -->
                        <img src="https://i.pinimg.com/736x/1f/b0/80/1fb08089007632f5675970177729b460.jpg" alt="Grottes en bateau">
                        <!-- Titre de l'activité -->
                        <h3>Visite des grottes en bateau</h3>
                        <!-- Description de l'activité -->
                        <p>Explore les entrailles mystérieuses des falaises portugaises en glissant doucement sur les eaux émeraude. Une traversée entre ombre et lumière, au coeur des cavernes secrètes.</p>
                        <!-- Prix de l'activité -->
                        <p class="price">45 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <!-- Sélecteur de quantité pour l'activité -->
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Visite des grottes en bateau][qte]" value="0">
                        <input type="hidden" name="activites[Visite des grottes en bateau][prix]" value="45">
                    </div>

                    <!-- Carte pour l'activité "Tramway historique de Lisbonne" -->
                    <div class="activity-card" data-name="Tramway historique de Lisbonne" data-price="30">
                        <!-- Image de l'activité -->
                        <img src="https://i.pinimg.com/736x/47/52/69/475269e8c346ebdd19e38156b24acdeb.jpg" alt="Tramway historique de Lisbonne">
                        <!-- Titre de l'activité -->
                        <h3>Tramway historique de Lisbonne</h3>
                        <!-- Description de l'activité -->
                        <p>Embarque pour un voyage dans le temps à bord du tram jaune légendaire. Lisbonne défile, vibrante et colorée, au rythme de ses ruelles pavées et de son charme d'antan.</p>
                        <!-- Prix de l'activité -->
                        <p class="price">30 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <!-- Sélecteur de quantité pour l'activité -->
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Tramway historique de Lisbonne][qte]" value="0">
                        <input type="hidden" name="activites[Tramway historique de Lisbonne][prix]" value="30">
                    </div>

                    <!-- Carte pour l'activité "Visite de Sintra" -->
                    <div class="activity-card" data-name="Librairie Lello à Porto" data-price="20">
                        <!-- Image de l'activité -->
                        <img src="https://i.pinimg.com/736x/27/73/96/277396e2388a8276f965248dced5b477.jpg" alt="Librairie Lello à Porto">
                        <!-- Titre de l'activité -->
                        <h3>Librairie Lello à Porto</h3>
                        <!-- Description de l'activité -->
                        <p>Marche dans un rêve de bois sculpté et d'escalier enchanté. La librairie Lello, joyau culturel de Porto, t'ouvre les portes d'un monde où les livres deviennent magie.</p>
                        <!-- Prix de l'activité -->
                        <p class="price">20 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <!-- Sélecteur de quantité pour l'activité -->
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Librairie Lello à Porto][qte]" value="0">
                        <input type="hidden" name="activites[Librairie Lello à Porto][prix]" value="20">
                    </div>

                    <!-- Carte pour l'activité "Visite de Sintra" -->
                    <div class="activity-card" data-name="Croisière dans la Vallée du Douro" data-price="85">
                        <!-- Image de l'activité -->
                        <img src="https://i.pinimg.com/736x/9e/3c/ee/9e3cee54a78a2aa5d110b58ecb3306f9.jpg" alt="Croisière dans la Vallée du Douro">
                        <!-- Titre de l'activité -->
                        <h3>Croisière dans la Vallée du Douro</h3>
                        <!-- Description de l'activité -->
                        <p>Laisse-toi porter par les flots du Douro entre vignes en terrasses et villages suspendus dans le temps. Une croisière douce et enivrante au coeur du Portugal authentique.</p>
                        <!-- Prix de l'activité -->
                        <p class="price">85 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <!-- Sélecteur de quantité pour l'activité -->
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                        </div>
                        <!-- Champs cachés pour envoyer les données de l'activité -->
                        <input type="hidden" name="activites[Croisière dans la Vallée du Douro][qte]" value="0">
                        <input type="hidden" name="activites[Croisière dans la Vallée du Douro][prix]" value="85">
                    </div>
                </div>

                <!-- Résumé de la sélection -->
                <div id="selection-summary">
                    <!-- Titre du résumé -->
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