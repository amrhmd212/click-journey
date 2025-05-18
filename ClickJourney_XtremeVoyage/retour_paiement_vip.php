<?php
// Démarrage de la session pour accéder aux infos utilisateur
session_start();

// Chemin vers le fichier des transactions
$transactionsFile = __DIR__ . '/data/transactions.json';

// Récupération des paramètres de paiement depuis l'URL
$transaction  = $_GET['transaction'] ?? '';
$montant      = $_GET['montant'] ?? '';
$vendeur      = $_GET['vendeur'] ?? '';
$status       = $_GET['status'] ?? 'denied';
$control      = $_GET['control'] ?? '';

// Récupération du nom d'utilisateur (normal ou temporaire)
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}
elseif(isset($_SESSION['temp_username'])){
    $username = $_SESSION['temp_username'];
}
else{
    // Si aucun nom d'utilisateur, redirection vers la connexion
    $_SESSION['error'] = "Erreur lors de la récupération du nom d'utilisateur.";
    header("Location: connexion.php");
}

// Suppression du nom d'utilisateur temporaire après usage
unset($_SESSION['temp_username']);

// Préparation de la nouvelle transaction VIP à enregistrer
$newTransaction = [
    'username'            => $username ?? 'unknown',
    'transaction'         => $transaction,
    'montant'             => $montant,
    'vendeur'             => $vendeur,
    'status'              => $status,
    'control'             => $control,
    'date'                => date('Y-m-d H:i:s'),
    'type'                => 'vip'
];

// Lecture des transactions existantes
if (file_exists($transactionsFile)) {
    $transactions = json_decode(file_get_contents($transactionsFile), true);
    if (!is_array($transactions)) {
        $transactions = [];
    }
} else {
    $transactions = [];
}

// Ajout de la nouvelle transaction
$transactions[] = $newTransaction;

// Sauvegarde dans le fichier JSON et redirection
if (file_put_contents($transactionsFile, json_encode($transactions, JSON_PRETTY_PRINT))) {
    header("Location: profil.php");
} else {
    echo "Erreur lors de l'enregistrement de la transaction.";
}
?>
