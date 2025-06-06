<?php
// On active l'affichage des erreurs pour le développement
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Chemin vers notre fichier de données utilisateurs
$users_file = __DIR__ . '/data/users.json';
if (!file_exists($users_file)) {
    $_SESSION['error'] = "Erreur : Fichier des utilisateurs introuvable";
    header("Location: connexion.php");
    exit();
}

// Chargement de la base utilisateurs
$users = json_decode(file_get_contents($users_file), true);

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "Vous devez être connecté";
    header("Location: connexion.php");
    exit();
}

// On récupère les infos de l'utilisateur connecté
$current_user = null;
foreach ($users as $user) {
    if ($user['username'] === $_SESSION['username']) {
        $current_user = $user;
        break;
    }
}

// Vérification des droits d'administration
if (!$current_user || ($current_user['is_admin'] ?? false) !== true) {
    $_SESSION['error'] = "Accès réservé aux administrateurs";
    header("Location: connexion.php");
    exit();
}

// On vérifie si l'utilisateur n'est pas banni
if ($current_user['vip_status'] === 'Banni') {
    $_SESSION['error'] = "Vous êtes banni";
    header("Location: bannissement.php");
    exit();
}

// Traitement des actions administratives (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $user_email = $_POST['user_email'] ?? '';

    // Modification du statut des utilisateurs
    foreach ($users as &$user) {
        if ($user['email'] === $user_email) {
            switch ($action) {
                case 'toggle_vip':
                    $user['vip_status'] = ($user['vip_status'] === 'Actif') ? 'Inactif' : 'Actif';
                    break;
                case 'toggle_ban':
                    // Empêcher le bannissement d'un admin
                    if (!($user['is_admin'] ?? false)) {
                        $user['vip_status'] = ($user['vip_status'] === 'Banni') ? 'Inactif' : 'Banni';
                    } else {
                        $_SESSION['error'] = "Impossible de bannir un administrateur";
                        header("Location: admin.php");
                        exit();
                    }
                    break;
                case 'toggle_admin':
                    // Empêcher la modification des droits d'admin pour soi-même et les autres admins
                    if ($user['username'] !== $_SESSION['username'] && !($user['is_admin'] ?? false)) {
                        $user['is_admin'] = !($user['is_admin'] ?? false);
                    } else {
                        $_SESSION['error'] = "Impossible de modifier les droits d'un administrateur";
                        header("Location: admin.php");
                        exit();
                    }
                    break;
            }
            break;
        }
    }

    // Sauvegarde des modifications
    file_put_contents($users_file, json_encode($users, JSON_PRETTY_PRINT));
    $_SESSION['success'] = "Modification effectuée avec succès";
    header("Location: admin.php");
    exit();
}

// Configuration de la pagination
$users_per_page = 5;
$total_users = count($users);
$total_pages = ceil($total_users / $users_per_page);
$current_page = isset($_GET['page']) ? max(1, min((int)$_GET['page'], $total_pages)) : 1;
$start_index = ($current_page - 1) * $users_per_page;
$current_users = array_slice($users, $start_index, $users_per_page);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>    <!-- Barre de navigation principale -->
    <nav>
        <ul>
            <!-- Liens de navigation standard -->
            <li><a href="index.php">Accueil</a></li>
            <li><a href="presentation.php">Présentation</a></li>
            <li><a href="quisommesnous.php">Qui sommes-nous</a></li>
            <li><a href="contact.php">Contact</a></li>
            <!-- Gestion de l'affichage conditionnel du bouton de connexion/profil -->
            <li>
                <?php if (isset($_SESSION['username'])) : ?>
                    <a href="profil.php" class="login-btn no-effect">Profil (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
                <?php else : ?>
                    <a href="connexion.php" class="login-btn no-effect">Connexion</a>
                <?php endif; ?>
            </li>
            <!-- Bouton de recherche -->
            <li><a href="recherche.php"><i class="fas fa-search search-icon"></i></a></li>
        </ul>
    </nav>

    <!-- Conteneur principal du panneau d'administration -->
    <div class="admin-container">
        <h1>Panneau d'Administration</h1>

        <!-- Informations de l'administrateur connecté et statistiques -->
        <div class="admin-info">
            Connecté en tant qu'administrateur : <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
            | <a href="logout.php">Déconnexion</a>
            <br><br>
            Total d'utilisateurs : <?= $total_users ?> | Page <?= $current_page ?> sur <?= $total_pages ?>
        </div>

        <!-- Affichage des messages de succès -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert success"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Liste des utilisateurs avec leurs informations -->
        <div class="user-list">
            <?php foreach ($current_users as $user): ?>
            <div class="user-card">
                <!-- Informations de l'utilisateur -->
                <div class="user-info">
                    <h3><?= htmlspecialchars($user['username'] ?? 'N/A') ?></h3>
                    <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($user['email']) ?></p>
                    <p>Statut :
                        <span style="color: var(--medium-gray); font-weight: 500;">
                            <?php
                            switch ($user['vip_status']) {
                                case 'Actif':
                                    echo 'VIP';
                                    break;
                                case 'Inactif':
                                    echo 'Non VIP';
                                    break;
                                case 'Banni':
                                    echo 'Banni';
                                    break;
                                default:
                                    echo '';
                            }
                            ?>
                        </span>
                    </p>

                    <p>Admin : <?= $user['is_admin'] ? 'Oui' : 'Non' ?></p>
                    <p><i class="fas fa-calendar-alt"></i> Inscrit le : <?= htmlspecialchars($user['join_date'] ?? 'Inconnu') ?></p>
                </div>

                <!-- Actions disponibles pour l'administrateur -->
                <div class="user-actions">
                    <!-- Formulaire pour basculer le statut VIP -->
                    <form method="POST">
                        <input type="hidden" name="user_email" value="<?= htmlspecialchars($user['email']) ?>">
                        <input type="hidden" name="action" value="toggle_vip">
                        <button type="submit" class="btn vip">
                            <?= ($user['vip_status'] ?? 'Inactif') === 'Actif' ? 'Désactiver VIP' : 'Activer VIP' ?>
                        </button>
                    </form>
                    <!-- Formulaire pour basculer le statut de bannissement -->
                    <?php if (!($user['is_admin'] ?? false)): ?>
                    <form method="POST">
                        <input type="hidden" name="user_email" value="<?= htmlspecialchars($user['email']) ?>">
                        <input type="hidden" name="action" value="toggle_ban">
                        <button type="submit" class="btn ban">
                            <?= ($user['vip_status'] ?? 'Inactif') === 'Banni' ? 'Débannir' : 'Bannir' ?>
                        </button>
                    </form>
                    <?php endif; ?>
                    <!-- Formulaire pour basculer les droits d'administrateur -->
                    <?php if ($user['username'] !== $_SESSION['username'] && !($user['is_admin'] ?? false)): ?>
                    <form method="POST">
                        <input type="hidden" name="user_email" value="<?= htmlspecialchars($user['email']) ?>">
                        <input type="hidden" name="action" value="toggle_admin">
                        <button type="submit" class="btn admin">
                            <?= $user['is_admin'] ? 'Désactiver Admin' : 'Activer Admin' ?>
                        </button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Système de pagination pour naviguer entre les pages d'utilisateurs -->
        <div class="pagination">
            <!-- Affiche le bouton "précédent" si on n'est pas sur la première page -->
            <?php if ($current_page > 1): ?>
                <a href="?page=<?= $current_page - 1 ?>">&lsaquo;</a>
            <?php endif; ?>

            <!-- Affiche les numéros de pages -->
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i == $current_page): ?>
                    <span class="current"><?= $i ?></span>
                <?php else: ?>
                    <a href="?page=<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <!-- Affiche le bouton "suivant" si on n'est pas sur la dernière page -->
            <?php if ($current_page < $total_pages): ?>
                <a href="?page=<?= $current_page + 1 ?>">&rsaquo;</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Pied de page avec mentions légales -->
    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>

    <!-- Chargement des scripts JavaScript -->
    <script src="js/theme.js"></script>
    <script src="js/admin.js"></script>
</body>
</html>
