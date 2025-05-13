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
    <title>Portugal - Xtreme Voyage</title>
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
        <img src="https://experiencesdumonde.fr/wp-content/uploads/2019/06/Lisbonne-525935287.jpg" alt="Lisbonne, Portugal">
        <h1 class="main-title">Portugal</h1>
    </header>

    <main>
        <section class="destination-section">
            <form method="POST" action="portugal-activites.php">
                <div class="activity-grid">

                    <div class="activity-card" data-name="Nager avec des dauphins" data-price="75">
                        <img src="https://i.pinimg.com/736x/f4/36/82/f436824bf3c845a94fb0b983a872270c.jpg" alt="Nager avec des dauphins">
                        <h3>Nager avec des dauphins</h3>
                        <p>Entre ciel et mer, nage au côté de ces esprits joueurs dans les eaux claires du Portugal. Une rencontre magique, entre douceur marine et frissons inoubliables.</p>
                        <p class="price">75 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                        </div>
                        <input type="hidden" name="activites[Nager avec des dauphins][qte]" value="0">
                        <input type="hidden" name="activites[Nager avec des dauphins][prix]" value="75">

                    </div>

                    <div class="activity-card" data-name="Visite des grottes en bateau" data-price="45">
                        <img src="https://i.pinimg.com/736x/1f/b0/80/1fb08089007632f5675970177729b460.jpg" alt="Grottes en bateau">
                        <h3>Visite des grottes en bateau</h3>
                        <p>Explore les entrailles mystérieuses des falaises portugaises en glissant doucement sur les eaux émeraude. Une traversée entre ombre et lumière, au coeur des cavernes secrètes.</p>
                        <p class="price">45 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                        </div>
                        <input type="hidden" name="activites[Visite des grottes en bateau][qte]" value="0">
                        <input type="hidden" name="activites[Visite des grottes en bateau][prix]" value="45">
                    </div>

                    <div class="activity-card" data-name="Tramway historique de Lisbonne" data-price="30">
                        <img src="https://i.pinimg.com/736x/47/52/69/475269e8c346ebdd19e38156b24acdeb.jpg" alt="Tramway historique de Lisbonne">
                        <h3>Tramway historique de Lisbonne</h3>
                        <p>Embarque pour un voyage dans le temps à bord du tram jaune légendaire. Lisbonne défile, vibrante et colorée, au rythme de ses ruelles pavées et de son charme d'antan.</p>
                        <p class="price">30 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                        </div>
                        <input type="hidden" name="activites[Tramway historique de Lisbonne][qte]" value="0">
                        <input type="hidden" name="activites[Tramway historique de Lisbonne][prix]" value="30">
                    </div>

                    <div class="activity-card" data-name="Librairie Lello à Porto" data-price="20">
                        <img src="https://i.pinimg.com/736x/27/73/96/277396e2388a8276f965248dced5b477.jpg" alt="Librairie Lello à Porto">
                        <h3>Librairie Lello à Porto</h3>
                        <p>Marche dans un rêve de bois sculpté et d'escalier enchanté. La librairie Lello, joyau culturel de Porto, t'ouvre les portes d'un monde où les livres deviennent magie.</p>
                        <p class="price">20 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                        </div>
                        <input type="hidden" name="activites[Librairie Lello à Porto][qte]" value="0">
                        <input type="hidden" name="activites[Librairie Lello à Porto][prix]" value="20">
                    </div>

                    <div class="activity-card" data-name="Croisière dans la Vallée du Douro" data-price="85">
                        <img src="https://i.pinimg.com/736x/9e/3c/ee/9e3cee54a78a2aa5d110b58ecb3306f9.jpg" alt="Croisière dans la Vallée du Douro">
                        <h3>Croisière dans la Vallée du Douro</h3>
                        <p>Laisse-toi porter par les flots du Douro entre vignes en terrasses et villages suspendus dans le temps. Une croisière douce et enivrante au coeur du Portugal authentique.</p>
                        <p class="price">85 € / personne</p>
                        <div class="activity-actions">
                            <div class="quantity-selector">
                                <button type="button" class="quantity-btn">-</button>
                                <span class="selected-count">0</span>
                                <button type="button" class="quantity-btn">+</button>
                            </div>
                        </div>
                        <input type="hidden" name="activites[Croisière dans la Vallée du Douro][qte]" value="0">
                        <input type="hidden" name="activites[Croisière dans la Vallée du Douro][prix]" value="85">
                    </div>
                </div>

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