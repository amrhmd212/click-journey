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
    <title>Indonésie - Xtreme Voyage</title>
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
        <h1 class="main-title">Indonésie</h1>
        <img src="https://voyagescouture-production.s3.amazonaws.com/uploads/images/countries/ccb99c8e-088f-4078-b099-517e9e611f3e/Indone%CC%81sie%20-%20%C2%A9geio-tischler-7hww7t6NLcg-unsplash.jpg" alt="Indonésie">
    </header>

    <main>
        <form method="POST" action="indonesie-activites.php">
            <section class="activity-grid">
                <div class="activity-card">
                    <img src="https://th.bing.com/th/id/OIP.o9Ir3vHYsQYU0062ZcmaRAHaJ-?rs=1&pid=ImgDetMain" alt="Ascension du volcan Semeru">
                    <h3>Ascension du volcan actif Semeru</h3>
                    <p>Gravir le Semeru, c'est flirter avec la puissance brute de la Terre. Fumées, roches volcaniques et ciel infini t'attendent au sommet de ce géant indonésien. Une aventure pour ceux qui rêvent de marcher sur le fil du monde.</p>
                    <p class="price">180 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Ascension du volcan actif Semeru]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://i.pinimg.com/originals/b9/bd/73/b9bd73f297d3934c00b834aae79ae20a.jpg" alt="Plongée avec les dragons de Komodo">
                    <h3>Plongée avec les dragons de Komodo</h3>
                    <p>Ils ne volent pas et ne crache pas de feu, mais ils sont tous aussi dangereux que les mythiques dragons, plongez donc dans les eaux de Komodo et faites face aux célèbres dragons de Komodo.</p>
                    <p class="price">220 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Plongée avec les dragons de Komodo]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://www.surf-report.com/img/pictures/2022/20220603/thumbnail/2206035469.png" alt="Surf sur les vagues de G-Land">
                    <h3>Surf sur les vagues de G-Land</h3>
                    <p>G-Land, c'est le rendez-vous des dieux du surf. Ici, les vagues grondent comme un tambour de guerre. Chaque ride est une danse entre maîtrise et folie, réservée aux âmes courageuses qui osent défier l'océan.</p>
                    <p class="price">150 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Surf sur les vagues de G-Land]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://production-livingdocs-bluewin-ch.imgix.net/2020/3/5/485f1b66-3f3c-4898-8ed5-c317f7b5b23c.jpeg?w=726&auto=format" alt="Plongée avec les requins-marteaux à Alor">
                    <h3>Plongée avec les requins-marteaux à Alor</h3>
                    <p>Dans les eaux cristallines d'Alor, les silhouettes spectrales des requins-marteaux glissent en silence. Une plongée entre fascination et frisson, au cœur d'un ballet marin aussi mystérieux qu'inoubliable.</p>
                    <p class="price">250 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Plongée avec les requins-marteaux à Alor]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://www.zinfos974.com/photo/art/grande/59537714-43732380.jpg?v=1634214181" alt="Saut en wingsuit depuis les falaises de Bali">
                    <h3>Saut en wingsuit à Bali</h3>
                    <p>Sens le vent te porter au-dessus des falaises émeraude et des plages dorées. En wingsuit, Bali se dévoile comme jamais : grandiose, sauvage, libre. Une envolée spectaculaire pour les amoureux du ciel.</p>
                    <p class="price">300 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Saut en wingsuit à Bali]" value="0">
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