<?php
session_start();

if (empty($_SESSION['vol']) || empty($_SESSION['hotel'])) {
    header("Location: options.php?error=Veuillez+choisir+un+vol+et+un+hôtel+avant+de+consulter+le+recapitulatif");
    exit();
}

$username = $_SESSION['username'] ?? null;


$users_file = __DIR__ . '/data/users.json';
if (!file_exists($users_file)) {
    die("Erreur : Fichier des utilisateurs introuvable.");
}
$users = json_decode(file_get_contents($users_file), true);


$isVip = false;
foreach ($users as $user) {
    if ($user['username'] === $username && $user['vip_status'] === 'Actif') {
        $isVip = true;
        break;
    }
}

$paysSelectionne = $_SESSION['pays_selectionne'] ?? 'Non sélectionné';
$dateDepart = $_SESSION['departure_date'] ?? 'Non sélectionnée';
$nombrePersonnes = $_SESSION['num_people'] ?? 'Non sélectionné';
$activites = $_SESSION['activites_selectionnees'] ?? [];
$vol = $_SESSION['vol'] ?? 'Non sélectionné';
$vol_retour = $_SESSION['vol_retour'] ?? 'Non sélectionné';
$prixVolRetourParPersonne = $_SESSION['prix_vol_retour'] ?? 0;
$hotel = $_SESSION['hotel'] ?? 'Non sélectionné';
$prixVolParPersonne = $_SESSION['prix_vol'] ?? 0;
$prixVolRetour = $_SESSION['prix_vol_retour'] ?? 0;
$prixHotelParNuit = $_SESSION['prix_hotel'] ?? 0;
$optionsSupplementaires = $_SESSION['options_supplementaires'] ?? [];


$departureDate = new DateTime($_SESSION['departure_date'] ?? '');
$returnDate = new DateTime($_SESSION['return_date'] ?? '');
$nombreNuits = $departureDate && $returnDate ? $departureDate->diff($returnDate)->days : 0;
$nombreJours = $nombreNuits + 1;

$totalActivites = 0;
foreach ($activites as $nom => $infos) {
    $qte = intval($infos['quantite']);
    $prix = floatval($infos['prix']);
    $totalActivites += $prix * $qte;
}

$nombreChambres = ceil(intval($nombrePersonnes) / 2);
$totalHotel = $prixHotelParNuit * $nombreNuits * $nombreChambres;

$totalVol = $prixVolParPersonne * intval($nombrePersonnes);
$totalVolRetour = $prixVolRetourParPersonne * intval($nombrePersonnes);

$totalOptions = 0;
foreach ($optionsSupplementaires as $opt) {
    $totalOptions += ($opt['prix'] ?? 0) * $nombreJours;
}

$totalGeneral = $totalActivites + $totalHotel + $totalVol + $totalVolRetour + $totalOptions;

$discount = $isVip ? $totalGeneral * 0.2 : 0;
$totalAfterDiscount = $totalGeneral - $discount;
?>


<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif de Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="recap.css">
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

```
<div class="container">
    <h1>Récapitulatif de votre voyage</h1>

    
    <div class="recap-item">
        <h2>Pays sélectionné :</h2>
        <p><?php echo htmlspecialchars($paysSelectionne); ?></p>
    </div>

    
    <div class="recap-item">
        <h2>Date de départ :</h2>
        <p><?php echo htmlspecialchars($dateDepart); ?></p>
    </div>

    <div class="recap-item">
        <h2>Date de retour :</h2>
        <p><?php echo htmlspecialchars($_SESSION['return_date'] ?? 'Non sélectionnée'); ?></p>
    </div>


    
    <div class="recap-item">
        <h2>Nombre de personnes :</h2>
        <p><?php echo htmlspecialchars($nombrePersonnes); ?></p>
    </div>

    
    <div class="recap-item">
        <h2>Activités choisies :</h2>
        <?php if (!empty($activites)): ?>
            <ul>
                <?php
                $totalActivites = 0;
                foreach ($activites as $nom => $infos):
                    $qte = intval($infos['quantite']);
                    $prix = floatval($infos['prix']);
                    $sousTotal = $prix * $qte;
                    $totalActivites += $sousTotal;
                ?>
                    <?php if ($qte > 0): ?>
                        <li>
                            <?php echo htmlspecialchars($nom); ?> — <?php echo $qte; ?> personne<?php echo $qte > 1 ? 's' : ''; ?>
                            × <?php echo number_format($prix, 2, '.', ''); ?> € = <?php echo number_format($sousTotal, 2, '.', ''); ?> €

                        </li>

                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <p><strong>Total activités :</strong> <?php echo number_format($totalActivites, 2, '.', ''); ?> €</p>
        <?php else: ?>
            <p>Aucune activité sélectionnée.</p>
        <?php endif; ?>
    </div>




    
    <div class="recap-item">
        <h2>Vol aller :</h2>
        <p>
            <?php echo htmlspecialchars($vol); ?> — <?php echo $nombrePersonnes; ?> personne<?php echo $nombrePersonnes > 1 ? 's' : ''; ?> × 
            <?php echo number_format($prixVolParPersonne, 2, '.', ''); ?> € = 
            <?php echo number_format($totalVol, 2, '.', ''); ?> €
        </p>
    </div>

    <div class="recap-item">
        <h2>Vol retour :</h2>
        <p>
            <?php echo htmlspecialchars($vol_retour); ?> — <?php echo $nombrePersonnes; ?> personne<?php echo $nombrePersonnes > 1 ? 's' : ''; ?> × 
            <?php echo number_format($prixVolRetourParPersonne, 2, '.', ''); ?> € = 
            <?php echo number_format($totalVolRetour, 2, '.', ''); ?> €
        </p>
    </div>




    
    <div class="recap-item">
        <h2>Hôtel sélectionné :</h2>
        <p>
            <?php echo htmlspecialchars($hotel); ?> — 
            <?php echo $nombreNuits; ?> nuit<?php echo $nombreNuits > 1 ? 's' : ''; ?> × 
            <?php echo number_format($prixHotelParNuit, 2, '.', ''); ?> € × 
            <?php echo $nombreChambres; ?> chambre<?php echo $nombreChambres > 1 ? 's' : ''; ?> 
            (<?php echo $nombrePersonnes; ?> personne<?php echo $nombrePersonnes > 1 ? 's' : ''; ?>) 
            = <?php echo number_format($totalHotel, 2, '.', ''); ?> €
        </p>
    </div>



    
    <div class="recap-item">
        <h2>Options supplémentaires :</h2>
        <?php if (!empty($optionsSupplementaires)): ?>
            <ul>
                <?php foreach ($optionsSupplementaires as $opt): ?>
                    <li>

                    <?php echo htmlspecialchars($opt['nom']); ?> — <?php echo $nombreJours; ?> jour<?php echo $nombreJours > 1 ? 's' : ''; ?>
                    × <?php echo number_format($opt['prix'], 2, '.', ''); ?> € = <?php echo number_format($opt['prix'] * $nombreJours, 2, '.', ''); ?> €

                    </li>

                <?php endforeach; ?>
            </ul>
            <p><strong>Total options :</strong> <?php echo number_format($totalOptions, 2, '.', ''); ?> €</p>
        <?php else: ?>
            <p>Aucune option supplémentaire sélectionnée.</p>
        <?php endif; ?>
    </div>


    <div class="recap-item total">
        <h2>Total général :</h2>
        <p><strong><?php echo number_format($totalGeneral, 2, '.', ''); ?> €</strong></p>
    </div>

    <?php if ($isVip): ?>
    <div class="recap-item discount">
        <h2>Réduction VIP (20%) :</h2>
        <p>- <?php echo number_format($discount, 2, '.', ''); ?> €</p>
    </div>

    <div class="recap-item total-after-discount">
        <h2>Total après réduction :</h2>
        <p><strong><?php echo number_format($totalAfterDiscount, 2, '.', ''); ?> €</strong></p>
    </div>
    <?php endif; ?>

    <div class="navigation-buttons">
        <a href="options.php" class="back-btn">← Retour aux options</a>
        <button class="confirm-btn" onclick="window.location.href='carte-paiement.php?montant=<?php echo urlencode($totalAfterDiscount); ?>'">Procéder au paiement</button>
    </div>
</div>

<footer>
    <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
    <p>Contactez-nous pour plus d'informations</p>
</footer>
<script src="js/theme.js"></script>

</body>
</html>

