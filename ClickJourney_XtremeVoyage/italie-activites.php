<?php
session_start();

$username = $_SESSION['username'] ?? null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $activites_selectionnees = $_POST['activites'] ?? [];
    
    if (!empty($activites_selectionnees)) {
        $_SESSION['activites_selectionnees'] = $activites_selectionnees;
        header("Location: date.php");
        exit();
    } else {
        echo "Erreur : Aucune activité sélectionnée.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Italie - Xtreme Voyage</title>
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
        <h1 class="main-title">Italie</h1>
        <img src="https://www.cartage.club/wp-content/uploads/2024/05/lac-de-come-road-trip-Italie-du-nord.jpeg" alt="Italie">
    </header>

    <main>
        <form method="POST" action="italie-activites.php">
            <section class="activity-grid">
                <div class="activity-card">
                    <img src="https://arquitecturaviva.com/assets/uploads/obras/53579/av_206540.webp?h=62b7320a" alt="Match de Milan">
                    <h3>Voir un match de Milan</h3>
                    <p>Vibre au rythme de San Siro, où chaque but déclenche une vague d'émotion. Une immersion dans le football italien, entre ferveur populaire et passion pure.</p>
                    <p class="price">120 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Voir un match de Milan]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://www.vivovenetia.fr/wp-content/uploads/2022/06/Tour-gondole-privee.png" alt="Gondole à Venise">
                    <h3>Prendre une gondole à Venise</h3>
                    <p>Glisse sur les eaux tranquilles de la Sérénissime au son du chant des gondoliers. Un instant suspendu où Venise se rêve romantique et éternelle.</p>
                    <p class="price">80 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Prendre une gondole à Venise]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://th.bing.com/th/id/R.03f9e49196c186be610752f98893e03d?rik=5efhsn79kE8oqg&pid=ImgRaw&r=0" alt="Dôme de Florence">
                    <h3>Monter au sommet du Dôme de Florence</h3>
                    <p>Monte les 463 marches qui mènent au ciel florentin. De là-haut, Florence se dévoile en chef-d'œuvre, baignée de lumière et d'histoire.</p>
                    <p class="price">25 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Monter au sommet du Dôme de Florence]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://www.voyageavecnous.fr/wp-content/uploads/2022/07/visiter-le-vatican.jpg" alt="Vatican et Chapelle Sixtine">
                    <h3>Visiter le Vatican et la Chapelle Sixtine</h3>
                    <p>Explore les trésors du plus petit État du monde. Du marbre sacré au plafond de Michel-Ange, chaque pas est une leçon de beauté et de splendeur.</p>
                    <p class="price">60 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Visiter le Vatican et la Chapelle Sixtine]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://www.ab-in-den-urlaub.de/magazin/wp-content/uploads/2024/02/1709138595_Cascate-del-Mulino-800x533.jpg" alt="Bain thermal en Toscane">
                    <h3>Prendre un bain thermal en Toscane</h3>
                    <p>Immerge-toi dans les eaux chaudes naturelles des bains de Toscane. Un moment de paix absolue au coeur de paysages vallonnés et baignés de soleil.</p>
                    <p class="price">45 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Prendre un bain thermal en Toscane]" value="0">
                    </div>
                </div>
            </section>

            <div id="selection-summary">
                <h3>Votre Sélection</h3>
                <p>Activités choisies: <span id="total-activities">0</span></p>
                <p>Total: <span id="total-price">0 €</span></p>
                <a href="date.php" class="btn">Confirmer</a>
            </div>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
</body>
</html>