<?php
session_start();
$username = $_SESSION['username'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $activites = $_POST['activites'] ?? [];
    $_SESSION['activites'] = $activites;
    header("Location: date.php");
    exit();
}

$activitesSelectionnees = $_SESSION['activites'] ?? [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grèce - Xtreme Voyage</title>
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
        <h1 class="main-title">Grèce</h1>
        <img src="https://static.posters.cz/image/hp/59726.jpg" alt="Grèce">
    </header>

    <main>
        <form method="POST" action="grece-activites.php">
            <section class="activity-grid">
                <div class="activity-card">
                    <img src="https://images.musement.com/cover/0137/66/thumb_13665620_cover_header.jpeg" alt="Acropole d'Athènes">
                    <h3>Visiter l'Acropole d'Athènes</h3>
                    <p>Marche dans les pas des anciens dieux au sommet de l'Acropole. Entre colonnes majestueuses et mythes éternels, découvre le berceau éclatant de la civilisation occidentale.</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Acropole d'Athènes]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://www.voyageavecnous.fr/wp-content/uploads/2018/08/les-plus-belles-iles-grecques.jpg" alt="Navigation entre les îles grecques">
                    <h3>Naviguer entre les îles grecques</h3>
                    <p>Hisse les voiles et pars à la conquête des Cyclades. Chaque île est un joyau, chaque escale une parenthèse de lumière entre mer azur et villages blancs.</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Navigation entre les îles grecques]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://rencontres-tourisme-culturel.fr/wp-content/uploads/2021/06/Explorer-la-plage-de-Navagio-plage-du-naufrage-a-Zakynthos.jpg" alt="Navagio Beach à Zakynthos">
                    <h3>Se baigner à Navagio Beach</h3>
                    <p>Entouré de falaises vertigineuses, plonge dans les eaux cristallines de Navagio Beach. Une crique secrète, légendaire, où repose l'épave d'un passé oublié.</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Navagio Beach à Zakynthos]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://www.en-vols.com/wp-content/uploads/afmm/2022/10/GettyImages-1364817970_Meteores_monasteres_Michelin.jpg" alt="Météores et monastères">
                    <h3>Explorer les Météores</h3>
                    <p>Élevez votre esprit en gravissant les sentiers menant aux monastères suspendus du ciel. Un lieu mystique où la foi et la nature s'embrassent dans le silence des hauteurs.</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Météores et monastères]" value="0">
                    </div>
                </div>

                <div class="activity-card">
                    <img src="https://visiter-santorini.fr/wp-content/uploads/2021/11/IMG_20211123_152034-scaled.jpg" alt="Sources chaudes de Loutraki">
                    <h3>Se baigner dans les sources chaudes de Loutraki</h3>
                    <p>Laisse les eaux thermales envelopper ton corps au cœur d'un décor paisible. À Loutraki ou Edipsos, chaque bain est un instant de pure renaissance grecque.</p>
                    <div class="activity-actions">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn">-</button>
                            <span class="selected-count">0</span>
                            <button type="button" class="quantity-btn">+</button>
                        </div>
                        <input type="hidden" name="activites[Sources chaudes de Loutraki]" value="0">
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