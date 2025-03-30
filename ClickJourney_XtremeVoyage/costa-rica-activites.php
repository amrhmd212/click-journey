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
    <title>Costa Rica - Xtreme Voyage</title>
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
        <h1 class="main-title">Costa Rica</h1>
        <img src="https://www.ou-et-quand.net/blog/wp-content/uploads/2016/05/3434623631_48b32dda13_o_d.jpg" alt="Costa Rica">
    </header>

    <main>
        <form method="POST" action="costa-rica-activites.php">
            <section class="activity-grid">
                <div class="activity-card">
                    <img src="https://media-cdn.tripadvisor.com/media/attractions-splice-spp-720x480/0c/10/b9/cb.jpg" alt="Tyrolienne Superman à Arenal">
                    <h3>Tyrolienne Superman à Arenal</h3>
                    <p>Volez comme Superman au-dessus de la canopée tropicale avec une tyrolienne géante près du volcan Arenal.</p>
                    <p class="price">95 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Tyrolienne Superman à Arenal]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://th.bing.com/th/id/R.beb356e60836846f2c0d093f6df6b69d?rik=yASqA50wzDsvXQ&pid=ImgRaw&r=0" alt="Saut à l'élastique Rio Savegre">
                    <h3>Saut à l'élastique au Rio Savegre</h3>
                    <p>Le saut de l'ange que vous avez toujours révez de faire devient réalité avec un saut à l'élastique spectaculaire au-dessus de la rivière Savegre.</p>
                    <p class="price">120 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Saut à l'élastique Rio Savegre]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://res.cloudinary.com/luxe/t_1200/f_auto/v1/dossiers/10/Toboggan_Aquatique_Camping_Le_Moulinal.jpg" alt="Toboggans géants Splash Parque">
                    <h3>Toboggans aquatiques géants à Splash Parque</h3>
                    <p>Soyez comme un requin dans l'eau, à pleine vitesse sur les toboggans aquatiques géants du Splash Parque.</p>
                    <p class="price">65 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Toboggans aquatiques géants à Splash Parque]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://costaricaxplores.com/atv-tours/at8.jpeg" alt="quad">
                    <h3>Quad</h3>
                    <p>Partez à l'aventure à travers les paysages spectaculaires du Costa Rica lors d'une excursion en quad ! Cette activité palpitante vous emmène sur des sentiers hors-piste, à travers des forêts tropicales luxuriantes, des collines escarpées et des plages paradisiaques.</p>
                    <p class="price">85 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Quad]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://th.bing.com/th/id/OIP.2NKv6e2ECCetEK9261cEZQHaEH?rs=1&pid=ImgDetMain" alt="Rafting en eaux vives Rio Pacuare">
                    <h3>Rafting en eaux vives sur le Rio Pacuare</h3>
                    <p>Affrontez les rapides endiablés du Rio Pacuare lors d'une expérience de rafting extrême.</p>
                    <p class="price">110 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Rafting en eaux vives Rio Pacuare]" value="0">
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