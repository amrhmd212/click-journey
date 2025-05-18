<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
    header("Location: connexion.php");
    exit(); // Arrête l'exécution pour éviter tout traitement supplémentaire
}

// Récupère l'identifiant de la transaction depuis les paramètres GET
$transaction_id = $_GET['transaction'] ?? '';
if (!$transaction_id) {
    // Si aucun identifiant de transaction n'est fourni, arrête le script avec un message d'erreur
    die("Aucune transaction spécifiée.");
}

// Chemin vers le fichier des transactions
$transactions_file = __DIR__ . '/data/transactions.json';
if (!file_exists($transactions_file)) {
    // Si le fichier des transactions n'existe pas, arrête le script avec un message d'erreur
    die("Erreur : Fichier des transactions introuvable.");
}

// Lecture et décodage du fichier JSON des transactions
$transactions = json_decode(file_get_contents($transactions_file), true);
$transaction_detail = null;

// Recherche des détails de la transaction correspondant à l'identifiant fourni
foreach ($transactions as $trans) {
    if (isset($trans['transaction']) && $trans['transaction'] === $transaction_id) {
        // Si une correspondance est trouvée, stocke les détails de la transaction
        $transaction_detail = $trans;
        break;
    }
}

if (!$transaction_detail) {
    // Si aucune transaction correspondante n'est trouvée, arrête le script avec un message d'erreur
    die("Transaction introuvable.");
}

// Récupère les dates de départ et de retour, ou des valeurs par défaut si elles ne sont pas définies
$departure = $transaction_detail['date_depart'] ?? 'Non précisée';
$return = $transaction_detail['date_retour'] ?? 'Non précisée';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de la Transaction - <?php echo htmlspecialchars($transaction_id); ?></title>
    <!-- Inclusion des polices et des fichiers CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="profil.css">
    <link rel="stylesheet" href="transaction_detail.css">
</head>
<body>
    <header class="page-header">
        <nav>
            <ul>
                <!-- Liens de navigation principaux -->
                <li><a href="index.php">Accueil</a></li>
                <li><a href="presentation.php">Présentation</a></li>
                <li><a href="quisommesnous.php">Qui sommes-nous</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="profil.php" class="login-btn no-effect">Profil</a></li>
                <li><a href="recherche.php"><i class="fas fa-search search-icon"></i></a></li>
            </ul>
        </nav>
        <h1 class="main-title"><span>X</span>treme Voyage</h1>
    </header>

    <div class="transaction-detail">
        <h2>Détail de la Transaction</h2>
        <!-- Affiche les détails de la transaction -->
        <p><span class="label">Transaction :</span> <?php echo htmlspecialchars($transaction_detail['transaction']); ?></p>
        <p><span class="label">Montant :</span> <?php echo htmlspecialchars($transaction_detail['montant']); ?> €</p>
        <p><span class="label">Vendeur :</span> <?php echo htmlspecialchars($transaction_detail['vendeur']); ?></p>
        <p><span class="label">Statut :</span> <?php echo htmlspecialchars($transaction_detail['status']); ?></p>
        <p><span class="label">Date de départ :</span> <?php echo htmlspecialchars($departure); ?></p>
        <p><span class="label">Date de retour :</span> <?php echo htmlspecialchars($return); ?></p>
        <p><span class="label">Pays sélectionné :</span> <?php echo htmlspecialchars($transaction_detail['pays_selectionne'] ?? ''); ?></p>
        
        <p><span class="label">Nombre de personnes :</span> <?php echo htmlspecialchars($transaction_detail['nombre_personnes'] ?? ''); ?></p>
        <p><span class="label">Activités :</span> 
            <?php 
            if (!empty($transaction_detail['activites']) && is_array($transaction_detail['activites'])) {
                // Si des activités sont associées à la transaction, les affiche avec leurs détails
                foreach ($transaction_detail['activites'] as $nom => $infos) {
                    $qte = $infos['quantite'] ?? 0;
                    $prix = $infos['prix'] ?? 0;
                    echo "<br>- " . htmlspecialchars($nom) . " × " . htmlspecialchars($qte) . " = " . htmlspecialchars($prix * $qte) . " €";
                }
            } else {
                // Si aucune activité n'est associée, affiche un message informatif
                echo "Aucune activité.";
            }
            ?>
        </p>

        <p><span class="label">Vol :</span> <?php echo htmlspecialchars($transaction_detail['vol'] ?? ''); ?></p>
        <p><span class="label">Vol retour :</span> <?php echo htmlspecialchars($transaction_detail['vol_retour'] ?? ''); ?></p>
        <p><span class="label">Hôtel :</span> <?php echo htmlspecialchars($transaction_detail['hotel'] ?? ''); ?></p>
        <p><span class="label">Options Supplémentaires :</span> 
            <?php 
            if (!empty($transaction_detail['options_supplementaires']) && is_array($transaction_detail['options_supplementaires'])) {
                $nb_jours = $transaction_detail['nombre_jours'] ?? 0;

                foreach ($transaction_detail['options_supplementaires'] as $opt) {
                    $nom = $opt['nom'] ?? 'Option';
                    $prix = $opt['prix'] ?? 0;
                    $total = $prix * $nb_jours;
                    echo "<br>- " . htmlspecialchars($nom) . " — " . htmlspecialchars($nb_jours) . " jour" . ($nb_jours > 1 ? "s" : "") . " × " . htmlspecialchars($prix) . " € = " . htmlspecialchars($total) . " €";
                }
            } else {
                // Si aucune option supplémentaire n'est associée, affiche un message informatif
                echo "Aucune option.";
            }
            ?>
        </p>

        <!-- Lien pour revenir au profil de l'utilisateur -->
        <a class="back-link" href="profil.php">Retour au Profil</a>
    </div>
    <script src="js/theme.js"></script>
</body>
</html>
