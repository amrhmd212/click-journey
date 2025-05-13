<?php
session_start();

$username = $_SESSION['username'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['activites'])) {
    $activites_selectionnees = $_POST['activites'];
    $activites_filtrees = [];

    foreach ($activites_selectionnees as $nom => $infos) {
        $quantite = intval($infos['qte'] ?? 0);
        $prix = floatval($infos['prix'] ?? 0);

        if ($quantite > 0) {
            $activites_filtrees[$nom] = [
                'quantite' => $quantite,
                'prix' => $prix
            ];
        }
    }

    $_SESSION['activites_selectionnees'] = $activites_filtrees;

    header("Location: date.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maroc - Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="pays-activites.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="presentation.php">Présentation</a></li>
            <li><a href="quisommesnous.php">Qui sommes-nous</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li>
                <?php if ($username) : ?>
                    <a href="profil.php" class="login-btn no-effect">Profil (<?php echo htmlspecialchars($username); ?>)</a>
                <?php else : ?>
                    <a href="connexion.php" class="login-btn no-effect">Connexion</a>
                <?php endif; ?>
            </li>
            <li><a href="recherche.php"><i class="fas fa-search search-icon"></i></a></li>
        </ul>
    </nav>

    <header>
        <h1 class="main-title">Maroc</h1>
        <img src="https://assets.micontenthub.com/traveloffers/travel-tips/de-la-mer-au-desert-des-montagnes-aux-vallees-decouvrez-les-tresors-du-royaume-du-maroc-4_qhGWlS6qg.jpg" alt="Maroc">
    </header>

    <main>
        <form method="POST" action="maroc-activites.php">
            <section class="activity-grid">

                <div class="activity-card" data-name="Monter à dos de chameau dans le désert de Merzouga" data-price="90">
                    <img src="https://img.freepik.com/premium-photo/camel-caravan-rides-through-moroccan-desert-sunset-this-creates-silhouette_1003100-866.jpg" alt="Chameau dans le désert de Merzouga">
                    <h3>Monter à dos de chameau dans le désert de Merzouga</h3>
                    <p>Au rythme lent des sabots sur le sable, traverse les dunes embrasées du Sahara au coucher du soleil. Un voyage hors du temps, entre silence doré et immensité.</p>
                    <p class="price">90 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Monter à dos de chameau dans le désert de Merzouga][qte]" value="0">
                        <input type="hidden" name="activites[Monter à dos de chameau dans le désert de Merzouga][prix]" value="90">
                    </div>
                </div>

                <div class="activity-card" data-name="Déguster un thé à la menthe dans un riad" data-price="25">
                    <img src="https://african-wanderlust.com/wp-content/uploads/2018/10/Location-Riad-Marrakech-2-Almaha-Marrakech-01.jpg" alt="Thé à la menthe dans un riad">
                    <h3>Déguster un thé à la menthe dans un riad</h3>
                    <p>Dans un patio feutré, savoure le thé à la menthe comme un rituel. Fraîcheur, tradition et douceur de vivre au coeur d'un riad marocain.</p>
                    <p class="price">25 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Déguster un thé à la menthe dans un riad][qte]" value="0">
                        <input type="hidden" name="activites[Déguster un thé à la menthe dans un riad][prix]" value="25">
                    </div>
                </div>

                <div class="activity-card" data-name="Explorer les cascades d'Ouzoud" data-price="40">
                    <img src="https://www.voyageavecnous.fr/wp-content/uploads/2022/06/activites-aux-cascades-d-ouzoud.jpg" alt="Cascades d'Ouzoud">
                    <h3>Explorer les cascades d'Ouzoud</h3>
                    <p>Admire les chutes vrombissantes au coeur d'un écrin de verdure. Les cascades d'Ouzoud offrent fraîcheur et spectacle au creux des montagnes berbères.</p>
                    <p class="price">40 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Explorer les cascades d'Ouzoud][qte]" value="0">
                        <input type="hidden" name="activites[Explorer les cascades d'Ouzoud][prix]" value="40">
                    </div>
                </div>

                <div class="activity-card" data-name="Se détendre dans un hammam traditionnel" data-price="35">
                    <img src="https://th.bing.com/th/id/R.58e17120582640b22aff7a0f21d1af30?rik=MbwZXY%2f4K7ektw&pid=ImgRaw&r=0" alt="Hammam traditionnel">
                    <h3>Se détendre dans un hammam traditionnel</h3>
                    <p>Laisse la vapeur ouvrir tes pores et apaiser ton esprit. Dans la pénombre d'un hammam marocain, la détente devient un art ancestral.</p>
                    <p class="price">35 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Se détendre dans un hammam traditionnel][qte]" value="0">
                        <input type="hidden" name="activites[Se détendre dans un hammam traditionnel][prix]" value="35">
                    </div>
                </div>

                <div class="activity-card" data-name="Goûter aux saveurs du Maroc dans un souk" data-price="30">
                    <img src="https://c8.alamy.com/compfr/bbp8k0/souk-bazar-marche-dans-les-rues-marrakech-maroc-maghreb-afrique-du-nord-bbp8k0.jpg" alt="Saveurs du souk marocain">
                    <h3>Goûter aux saveurs du Maroc dans un souk</h3>
                    <p>Perds-toi dans les allées parfumées de cannelle et de cumin, goûte aux tajines fumants et découvre l'âme culinaire du Maroc au coeur de ses souks animés.</p>
                    <p class="price">30 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Goûter aux saveurs du Maroc dans un souk][qte]" value="0">
                        <input type="hidden" name="activites[Goûter aux saveurs du Maroc dans un souk][prix]" value="30">
                    </div>
                </div>
            </section>

            <div id="selection-summary">
                    <h3>Votre Sélection</h3>
                    <p>Activités choisies: <span id="total-activities">0</span></p>
                    <p>Total: <span id="total-price">0 €</span></p>
                    <button type="submit" class="btn">Confirmer</button>

                </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>

    <script src="js/activites.js"></script>
    <script src="js/theme.js"></script>

</body>
</html>