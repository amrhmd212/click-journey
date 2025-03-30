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
    <title>Espagne - Xtreme Voyage</title>
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
        <h1 class="main-title">Espagne</h1>
        <img src="https://www.superprof.fr/blog/wp-content/uploads/2020/08/visiter-peninsule-iberique-scaled.jpg" alt="Espagne">
    </header>

    <main>
        <form method="POST" action="espagne-activites.php">
            <section class="activity-grid">
                <div class="activity-card">
                    <img src="https://www.civitatis.com/f/espana/cala-d-or/tour-moto-agua-calo-moro-589x392.jpg" alt="Jet-ski">
                    <h3>Jet-ski sur les plages d'Espagne</h3>
                    <p>Vivez une expérience à grande vitesse en chevauchant les vagues sur un jet-ski au large des plages espagnoles.</p>
                    <p class="price">70 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Jet-ski sur les plages d'Espagne]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://th.bing.com/th/id/OIP.2sa3KlUULpjf7CVoQlISNwHaE7?rs=1&pid=ImgDetMain" alt="Port Aventura">
                    <h3>Port Aventura</h3>
                    <p>Découvrez des attractions palpitantes dans l'un des parcs d'attractions les plus célèbres d'Europe, à Salou.</p>
                    <p class="price">60 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Port Aventura]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://th.bing.com/th/id/OIP.T4ZGmY_XgJ8RtAY2DR_1WQHaE7?rs=1&pid=ImgDetMain" alt="Karting">
                    <h3>Karting</h3>
                    <p>Max Verstappen n'est rien face à vous, faites étalage de vos talents de pilote sur des circuits de karting à travers l'Espagne.</p>
                    <p class="price">45 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Karting]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://th.bing.com/th/id/OIP.gdcdnhE5sUEQIMZGr-EYCwAAAA?rs=1&pid=ImgDetMain" alt="Buggy en pleine nature">
                    <h3>Buggy en pleine nature</h3>
                    <p>Explorez les paysages espagnols à bord d'un buggy tout-terrain pour une aventure hors des sentiers battus.</p>
                    <p class="price">80 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Buggy en pleine nature]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://www.theolivepress.es/wp-content/uploads/2020/06/02-1068x801.jpg" alt="Wakeboard">
                    <h3>Wakeboard</h3>
                    <p>Glissez sur l'eau en wakeboard et testez vos figures acrobatiques sur les plus beaux lacs et plages d'Espagne.</p>
                    <p class="price">55 € / personne</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Wakeboard]" value="0">
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