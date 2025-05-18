<?php
// Démarre une session pour accéder aux variables de session
session_start();

// Vérifie si l'utilisateur est connecté en vérifiant la présence de la variable de session 'username'
if (!isset($_SESSION['username'])) {
    // Redirige l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}

// Récupère l'identifiant de la transaction depuis les paramètres GET de l'URL
$transaction_id = $_GET['transaction'] ?? '';
// Si aucun identifiant de transaction n'est fourni, affiche un message d'erreur et arrête l'exécution
if (!$transaction_id) {
    die("Aucune transaction spécifiée.");
}

// Définit le chemin vers le fichier JSON contenant les transactions
$transactions_file = __DIR__ . '/data/transactions.json';
// Vérifie si le fichier des transactions existe
if (!file_exists($transactions_file)) {
    die("Erreur : Fichier des transactions introuvable.");
}

// Lit le contenu du fichier JSON et le décode en tableau associatif PHP
$transactions = json_decode(file_get_contents($transactions_file), true);
$transaction_detail = null; // Initialise une variable pour stocker les détails de la transaction

// Parcourt toutes les transactions pour trouver celle correspondant à l'identifiant fourni
foreach ($transactions as $trans) {
    if (isset($trans['transaction']) && $trans['transaction'] === $transaction_id) {
        $transaction_detail = $trans; // Stocke les détails de la transaction trouvée
        break; // Arrête la boucle une fois la transaction trouvée
    }
}

// Si aucune transaction correspondante n'est trouvée, affiche un message d'erreur et arrête l'exécution
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
    <!-- Liens vers les polices et les fichiers CSS pour le style de la page -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="profil.css">
    <link rel="stylesheet" href="transaction_detail.css">
</head>
<body>
    <!-- En-tête de la page avec navigation -->
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

    <!-- Section principale affichant les détails de la transaction -->
    <div class="transaction-detail">
        <h2>Détail de la Transaction</h2>
        <!-- Affiche les informations de la transaction en utilisant htmlspecialchars pour éviter les failles XSS -->
        <p><span class="label">Transaction :</span> <?php echo htmlspecialchars($transaction_detail['transaction']); ?></p>
        <p><span class="label">Montant :</span> <?php echo htmlspecialchars($transaction_detail['montant']); ?> €</p>
        <p><span class="label">Vendeur :</span> <?php echo htmlspecialchars($transaction_detail['vendeur']); ?></p>
        <p><span class="label">Statut :</span> <?php echo htmlspecialchars($transaction_detail['status']); ?></p>
        <p><span class="label">Achat :</span> <?php echo htmlspecialchars($transaction_detail['type']); ?></p>
        <!-- Lien pour revenir au profil de l'utilisateur -->
        <a class="back-link" href="profil.php">Retour au Profil</a>
    </div>

    <!-- Inclusion du script pour gérer le thème (mode sombre/clair) -->
    <script src="js/theme.js"></script>
</body>
</html>
