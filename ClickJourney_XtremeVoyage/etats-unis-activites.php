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
    <title>États-Unis - Xtreme Voyage</title>
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
        <h1 class="main-title">États-Unis</h1>
        <img src="https://assets.holidaypirates.group/2022_02/MTY0NDUwODc2OTcyOQ.jpeg" alt="États-Unis">
    </header>

    <main>
        <form method="POST" action="etats-unis-activites.php">
            <section class="activity-grid">

                <div class="activity-card" data-name="Tir au tank & lance-roquettes" data-price="250">
                    <img src="https://external-preview.redd.it/bh4Y09AFyLjNxHwDpsJn7Y9Qco1B1mEnhH3NS6VVVbQ.jpg?auto=webp&s=1fa1d53e8c4168180689b56e2a51b1eb682a458a" alt="Tir au lance-roquettes et tank">
                    <h3>Tir au tank & lance-roquettes</h3>
                    <p>Call of Duty n'est plus qu'un jeu, libérez votre guerrier intérieur en testant des armes puissantes et des véhicules militaires dans un environnement sécurisé.</p>
                    <p class="price">250 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Tir au tank & lance-roquettes][qte]" value="0">
                        <input type="hidden" name="activites[Tir au tank & lance-roquettes][prix]" value="250">
                    </div>
                </div>

                <div class="activity-card" data-name="Escalade de El Capitan" data-price="350">
                    <img src="https://images.unsplash.com/photo-1714274142744-5cbc12821bd2?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8ZWwlMjBjYXBpdGFuJTIweW9zZW1pdGV8ZW58MHx8MHx8fDA%3D" alt="Escalade de El Capitan">
                    <h3>Escalade de El Capitan</h3>
                    <p>Immense, mythique, impitoyable. El Capitan dresse ses 900 mètres de granit dans le ciel du Yosemite. Une ascension brute et légendaire, où chaque prise est un combat et chaque sommet une victoire sur soi-même.</p>
                    <p class="price">350 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Escalade de El Capitan][qte]" value="0">
                        <input type="hidden" name="activites[Escalade de El Capitan][prix]" value="350">
                    </div>
                </div>

                <div class="activity-card" data-name="Saut en base jump au Perrine Bridge" data-price="300">
                    <img src="https://th.bing.com/th/id/R.0ce5de299fab1e40ad58ee00bdf51067?rik=5LSCPLzo1xd8CQ&pid=ImgRaw&r=0" alt="Saut en base jump">
                    <h3>Saut en base jump au Perrine Bridge</h3>
                    <p>Fan d'Assassin's Creed vous en avez toujours rêvé et le moment est venu, faites le saut de l'ange depuis le Perrine Bridge en Idaho, enchainé par un atterrissage en parachute.</p>
                    <p class="price">300 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Saut en base jump au Perrine Bridge][qte]" value="0">
                        <input type="hidden" name="activites[Saut en base jump au Perrine Bridge][prix]" value="300">
                    </div>
                </div>

                <div class="activity-card" data-name="Vol en chute libre depuis un avion de chasse" data-price="500">
                    <img src="https://th.bing.com/th/id/OIP.U5nFINSc4Tk7o6s2BAb9EwHaF0?rs=1&pid=ImgDetMain" alt="Chute libre depuis un avion de chasse">
                    <h3>Vol en chute libre depuis un avion de chasse</h3>
                    <p>Sens la puissance du moteur rugir, puis le silence absolu : tu viens de briser le mur du son. Ensuite ? Le grand plongeon. Une chute libre à couper le souffle, entre ciel et terre, où le vertige devient liberté.</p>
                    <p class="price">500 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Vol en chute libre depuis un avion de chasse][qte]" value="0">
                        <input type="hidden" name="activites[Vol en chute libre depuis un avion de chasse][prix]" value="500">
                    </div>
                </div>

                <div class="activity-card" data-name="Exploration sous-marine en capsule" data-price="1000">
                    <img src="https://th.bing.com/th/id/OIP.Yt_MJkfgfzzpnyvqwtCp-AHaEK?rs=1&pid=ImgDetMain" alt="Exploration sous-marine">
                    <h3>Exploration sous-marine en capsule</h3>
                    <p>Ferme l'écoutille et plonge dans l'inconnu. À bord d'une capsule futuriste, explore les profondeurs abyssales et découvre un monde silencieux, mystérieux, presque extraterrestre... Un voyage hors du temps.</p>
                    <p class="price">1000 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Exploration sous-marine en capsule][qte]" value="0">
                        <input type="hidden" name="activites[Exploration sous-marine en capsule][prix]" value="1000">
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