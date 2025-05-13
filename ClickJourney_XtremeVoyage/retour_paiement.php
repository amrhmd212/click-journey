<?php
session_start();


$transactionsFile = __DIR__ . '/data/transactions.json';


$transaction = $_GET['transaction'] ?? '';
$montant     = $_GET['montant'] ?? '';
$vendeur     = $_GET['vendeur'] ?? '';
$status      = $_GET['status'] ?? 'denied';
$control     = $_GET['control'] ?? '';


$paysSelectionne         = $_SESSION['pays_selectionne'] ?? 'Non sélectionné';
$dateDepart              = $_SESSION['departure_date'] ?? 'Non sélectionnée';
$dateRetour              = $_SESSION['return_date'] ?? 'Non précisée';
$nombrePersonnes         = $_SESSION['num_people'] ?? 'Non sélectionné';
$activites               = $_SESSION['activites_selectionnees'] ?? [];
$vol                     = $_SESSION['vol'] ?? 'Non sélectionné';
$vol_retour              = $_SESSION['vol_retour'] ?? 'Non sélectionné';
$hotel                   = $_SESSION['hotel'] ?? 'Non sélectionné';
$optionsSupplementaires  = $_SESSION['options_supplementaires'] ?? [];
$nombreJours = 0;
if ($dateDepart !== 'Non sélectionnée' && $dateRetour !== 'Non précisée') {
    $dateStart = DateTime::createFromFormat('Y-m-d', $dateDepart);
    $dateEnd = DateTime::createFromFormat('Y-m-d', $dateRetour);

    if ($dateStart && $dateEnd && $dateStart <= $dateEnd) {
        $nombreJours = $dateStart->diff($dateEnd)->days + 1;
    }
}



$newTransaction = [
    'username'            => $_SESSION['username'] ?? 'unknown',
    'transaction'         => $transaction,
    'montant'             => $montant,
    'vendeur'             => $vendeur,
    'status'              => $status,
    'control'             => $control,
    'date'                => date('Y-m-d H:i:s'),

    'pays_selectionne'    => $paysSelectionne,
    'date_depart'         => $dateDepart,
    'date_retour'         => $dateRetour,
    'nombre_jours'        => $nombreJours,
    'nombre_personnes'    => $nombrePersonnes,
    'activites'           => $activites,
    'vol'                 => $vol,
    'vol_retour'          => $vol_retour,
    'hotel'               => $hotel,
    'options_supplementaires' => $optionsSupplementaires
];



if (file_exists($transactionsFile)) {
    $transactions = json_decode(file_get_contents($transactionsFile), true);
    if (!is_array($transactions)) {
        $transactions = [];
    }
} else {
    $transactions = [];
}


$transactions[] = $newTransaction;


if (file_put_contents($transactionsFile, json_encode($transactions, JSON_PRETTY_PRINT))) {

    header("Location: profil.php");
} else {
    echo "Erreur lors de l'enregistrement de la transaction.";
}
?>
