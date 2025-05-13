<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}


$transaction_id = $_GET['transaction'] ?? '';
if (!$transaction_id) {
    die("Aucune transaction spécifiée.");
}


$transactions_file = __DIR__ . '/data/transactions.json';
if (!file_exists($transactions_file)) {
    die("Erreur : Fichier des transactions introuvable.");
}


$transactions = json_decode(file_get_contents($transactions_file), true);
$transaction_detail = null;
foreach ($transactions as $trans) {
    if (isset($trans['transaction']) && $trans['transaction'] === $transaction_id) {
        $transaction_detail = $trans;
        break;
    }
}

if (!$transaction_detail) {
    die("Transaction introuvable.");
}
$departure = $transaction_detail['date_depart'] ?? 'Non précisée';
$return = $transaction_detail['date_retour'] ?? 'Non précisée';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de la Transaction - <?php echo htmlspecialchars($transaction_id); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="profil.css">
    <link rel="stylesheet" href="transaction_detail.css">
</head>
<body>
    
    <header class="page-header">
        <nav>
            <ul>
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
                foreach ($transaction_detail['activites'] as $nom => $infos) {
                    $qte = $infos['quantite'] ?? 0;
                    $prix = $infos['prix'] ?? 0;
                    echo "<br>- " . htmlspecialchars($nom) . " × " . htmlspecialchars($qte) . " = " . htmlspecialchars($prix * $qte) . " €";
                }
            } else {
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
                echo "Aucune option.";
            }
            ?>
        </p>


        <a class="back-link" href="profil.php">Retour au Profil</a>
    </div>
    <script src="js/theme.js"></script>
</body>
</html>
