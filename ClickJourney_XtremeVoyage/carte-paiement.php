<?php
session_start();

// Vérification si l'utilisateur est connecté
// Si achat de vip, bypass vérif
if (!isset($_GET['vip'])) {
  if (!isset($_SESSION['username'])) {
      $_SESSION['error'] = "Vous devez être connecté pour effectuer un paiement";
      $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
      header("Location: connexion.php");
      exit();
  }
}

// Choix entre le nom d'utilisateur temporaire ou normal
if (!isset($_SESSION['username'])) {
      $_SESSION['temp_username'] = $_GET['username'];
}

// Création URL de retour
$host = $_SERVER['HTTP_HOST'];
$path = dirname($_SERVER['SCRIPT_NAME']);
$Url = 'http://' . $host . $path . '/retour_paiement.php';

//Genération aleatoire du numéro de transaction
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

//Vérification du type d'achat
if (isset($_GET['vip'])) {
$Url = 'http://' . $host . $path . '/retour_paiement_vip.php';
}


$montant = $_GET['montant'] ?? 'Non definie';
$vendeur = 'MI-5_F';
$retour = $Url;

//Vérification de l'existance de l'api
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
      <!-------------- Envoi des informations à l'API ----------------->
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
  <script src="js/theme.js"></script>
</body>
</html>
