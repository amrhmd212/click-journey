<?php
session_start();


function generateTransactionId($min = 10, $max = 24) {
    $length = rand($min, $max);
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


$transaction = generateTransactionId();


$montant = $_GET['montant'] ?? '18000.99';
$vendeur = $_GET['vendeur'] ?? 'TEST';
$retour = $_GET['retour'] ?? 'http://localhost/ClickJourney_XtremeVoyage/retour_paiement.php';


if (file_exists('getapikey.php')) {
    require('getapikey.php');
    $api_key = getAPIKey($vendeur);
} else {
    
    $api_key = "0123456789abcde";
}


$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paiement par Carte - Xtreme Voyage</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="carte-paiement.css">
</head>
<body>
  <main style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="container">
      <h1>Paiement par Carte</h1>
      <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
        <input type="hidden" name="transaction" value="<?php echo htmlspecialchars($transaction); ?>">
        <input type="hidden" name="montant" value="<?php echo htmlspecialchars($montant); ?>">
        <input type="hidden" name="vendeur" value="<?php echo htmlspecialchars($vendeur); ?>">
        <input type="hidden" name="retour" value="<?php echo htmlspecialchars($retour); ?>">
        <input type="hidden" name="control" value="<?php echo htmlspecialchars($control); ?>">
        <button type="submit">Payer</button>
      </form>
    </div>
  </main>
</body>
</html>
