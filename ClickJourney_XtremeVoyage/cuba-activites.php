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
    <title>Cuba - Xtreme Voyage</title>
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
        <h1 class="main-title">Cuba</h1>
        <img src="https://i.f1g.fr/media/cms/orig/2023/02/24/38bc359284633b1e629b57214db6bf72caa1e8f4c00eacbdc0e86ff8e95e02d1.jpg" alt="Cuba">
    </header>

    <main>
        <form method="POST" action="cuba-activites.php">
            <section class="activity-grid">

                <div class="activity-card" data-name="Excursion au parc national de Topes de Collantes" data-price="75">
                    <img src="https://www.cubaneotravel.com/wp-content/uploads/5.jpg" alt="Parc national de Topes de Collantes">
                    <h3>Excursion au parc national de Topes de Collantes</h3>
                    <p>Plonge au cœur d'une nature luxuriante, entre cascades cristallines, sentiers secrets et forêts tropicales. Ce parc, joyau vert de la Sierra del Escambray, te réserve un bol d'air pur et d'évasion sauvage.</p>
                    <p class="price">75 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Excursion au parc national de Topes de Collantes][qte]" value="0">
                        <input type="hidden" name="activites[Excursion au parc national de Topes de Collantes][prix]" value="75">
                    </div>
                </div>

                <div class="activity-card" data-name="Découverte de la Vallée de Viñales" data-price="90">
                    <img src="https://image.geo.de/30376684/t/Qw/v3/w1440/r0/-/vinales-s-717541387-jpg--90416-.jpg" alt="Vallée de Viñales et cigares cubains">
                    <h3>Découverte de la Vallée de Viñales</h3>
                    <p>D'Al Pacino à De Niro vous les tous vu en fumer, découvert donc comment sont fabriqués les célèbres cigares cubains dans cette vallée magnifique.</p>
                    <p class="price">90 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Découverte de la Vallée de Viñales][qte]" value="0">
                        <input type="hidden" name="activites[Découverte de la Vallée de Viñales][prix]" value="90">
                    </div>
                </div>

                <div class="activity-card" data-name="Croisière en vieux voilier" data-price="110">
                    <img src="https://www.lifeventsgroup.com/images/incentive-activites-mer-croisiere-en-vieux-greement-mythique-01.jpg" alt="Croisière en vieux voilier">
                    <h3>Croisière en vieux voilier</h3>
                    <p>Mets les voiles sur les eaux turquoise des Caraïbes, à bord d'un voilier d'époque qui sent bon les grandes traversées. Une aventure hors du temps, bercée par les embruns et le charme d'antan.</p>
                    <p class="price">110 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Croisière en vieux voilier][qte]" value="0">
                        <input type="hidden" name="activites[Croisière en vieux voilier][prix]" value="110">
                    </div>
                </div>

                <div class="activity-card" data-name="Visite de la forteresse Castillo del Morro" data-price="50">
                    <img src="https://thumbs.dreamstime.com/b/san-salvador-de-la-punta-fortress-est-une-forteresse-dans-la-baie-de-la-havane-cuba-66090121.jpg" alt="Forteresse Castillo del Morro">
                    <h3>Visite de la forteresse Castillo del Morro</h3>
                    <p>Garde fièrement l'entrée de la baie de La Havane, cette citadelle du XVIe siècle dévoile ses secrets aux voyageurs curieux. Entre canons, murs de pierre et vues imprenables, l'Histoire se raconte au fil des remparts.</p>
                    <p class="price">50 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Visite de la forteresse Castillo del Morro][qte]" value="0">
                        <input type="hidden" name="activites[Visite de la forteresse Castillo del Morro][prix]" value="50">
                    </div>
                </div>

                <div class="activity-card" data-name="Promenade en voiture américaine vintage" data-price="85">
                    <img src="https://img.freepik.com/premium-photo/colorful-street-in-havana-cuba-with-vintage-cars-and-colonial-architecture_1072167-2589.jpg" alt="Promenade en voiture américaine vintage">
                    <h3>Promenade en voiture américaine vintage</h3>
                    <p>Glisse-toi dans un film des années 50 le temps d'une virée en décapotable colorée. Chromes étincelants, musique rétro et ambiance cubaine : la Havane n'a jamais été aussi iconique.</p>
                    <p class="price">85 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Promenade en voiture américaine vintage][qte]" value="0">
                        <input type="hidden" name="activites[Promenade en voiture américaine vintage][prix]" value="85">
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