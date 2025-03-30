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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de la Transaction - <?php echo htmlspecialchars($transaction_id); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="profil.css">
    <style>
        
        .transaction-detail {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid var(--light-gray);
            border-radius: 10px;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .transaction-detail h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
            color: var(--dark-gray);
        }
        .transaction-detail p {
            margin: 10px 0;
            font-size: 1rem;
        }
        .transaction-detail .label {
            font-weight: bold;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: var(--gradient-primary);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    
    <header class="page-header">
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="presentation.php">Présentation</a></li>
                <li><a href="quisommesnous.php">Qui sommes-nous</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="profil.php">Profil</a></li>
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
        <p><span class="label">Date :</span> <?php echo htmlspecialchars($transaction_detail['date']); ?></p>
        <p><span class="label">Pays sélectionné :</span> <?php echo htmlspecialchars($transaction_detail['pays_selectionne'] ?? ''); ?></p>
        <p><span class="label">Date de départ :</span> <?php echo htmlspecialchars($transaction_detail['date_depart'] ?? ''); ?></p>
        <p><span class="label">Nombre de personnes :</span> <?php echo htmlspecialchars($transaction_detail['nombre_personnes'] ?? ''); ?></p>
        <p><span class="label">Activités :</span> 
            <?php 
            if (isset($transaction_detail['activites']) && is_array($transaction_detail['activites'])) {
                echo htmlspecialchars(implode(', ', $transaction_detail['activites']));
            } else {
                echo htmlspecialchars($transaction_detail['activites'] ?? '');
            }
            ?>
        </p>
        <p><span class="label">Vol :</span> <?php echo htmlspecialchars($transaction_detail['vol'] ?? ''); ?></p>
        <p><span class="label">Hôtel :</span> <?php echo htmlspecialchars($transaction_detail['hotel'] ?? ''); ?></p>
        <p><span class="label">Options Supplémentaires :</span> 
            <?php 
            if (isset($transaction_detail['options_supplementaires']) && is_array($transaction_detail['options_supplementaires'])) {
                echo htmlspecialchars(implode(', ', $transaction_detail['options_supplementaires']));
            } else {
                echo htmlspecialchars($transaction_detail['options_supplementaires'] ?? '');
            }
            ?>
        </p>
        <a class="back-link" href="profil.php">Retour au Profil</a>
    </div>
</body>
</html>
