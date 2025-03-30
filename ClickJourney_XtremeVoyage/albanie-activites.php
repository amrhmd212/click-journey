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
    <title>Albanie - Xtreme Voyage</title>
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
        <h1 class="main-title">Albanie</h1>
        <img src="https://www.voyagealbanie.com/cdn/al-public/lac_albanie.jpg" alt="Albanie">
    </header>

    <main>
        <form method="POST" action="albanie-activites.php">
            <section class="activity-grid">
                <div class="activity-card">
                    <img src="https://th.bing.com/th/id/R.eed3ba7165a6dd74556d32ea55cf2c3e?rik=2ore1Z81RO5WqQ&pid=ImgRaw&r=0" alt="Parapente à Dhermi">
                    <h3>Parapente à la plage de Dhermi</h3>
                    <p>Alliez magnifique paysages et vus avec les sensations fortes et olez en parapente au-dessus de la magnifique plage de Dhermi.</p>
                    <p class="price">120 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Parapente à Dhermi]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://media-cdn.tripadvisor.com/media/attractions-splice-spp-720x480/0a/2e/ad/7a.jpg" alt="Rafting sur la rivière Vjosa">
                    <h3>Descente en rafting dans la rivière Vjosa</h3>
                    <p>Naviguez sur les eaux endiablées de la rivière Vjosa en rafting.</p>
                    <p class="price">80 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Rafting sur la rivière Vjosa]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://media-cdn.tripadvisor.com/media/attractions-splice-spp-720x480/07/82/39/82.jpg" alt="Plongée sous-marine à Karaburun">
                    <h3>Plongée sous-marine à Karaburun</h3>
                    <p>Explorez les fonds marins fascinants de Karaburun, entre récifs de corail, épaves de navires et vie marine colorée.</p>
                    <p class="price">90 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Plongée sous-marine à Karaburun]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://www.10a-tours.com/wp-content/uploads/2019/06/Trekking-Hellas-Pindos-Horseshoe-04-Exploring-the-mountains-in-Northern-Greece-1024x768.jpg" alt="Trekking dans le parc national de Pindus">
                    <h3>Trekking dans le parc national de Pindus</h3>
                    <p>Parcourez les sentiers du parc national de Pindus pour des paysages à couper le souffle et une immersion totale dans la nature.</p>
                    <p class="price">60 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Trekking dans le parc national de Pindus]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/29/45/df/bc/tactical-shooting-inside.jpg?w=800&h=-1&s=1" alt="Stand de tir">
                    <h3>Stand de tir</h3>
                    <p>Devenez le Hitman ou le John Wick que vous pensez être et testez votre précision dans un stand de tir professionnel.</p>
                    <p class="price">50 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Stand de tir]" value="0">
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