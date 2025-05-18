<?php
session_start();

// Vérifie si les informations nécessaires pour afficher le récapitulatif sont présentes dans la session
if (empty($_SESSION['vol']) || empty($_SESSION['hotel'])) {
    // Si l'utilisateur n'a pas sélectionné de vol ou d'hôtel, redirige vers la page des options avec un message d'erreur
    header("Location: options.php?error=Veuillez+choisir+un+vol+et+un+hôtel+avant+de+consulter+le+recapitulatif");
    exit(); // Arrête l'exécution pour éviter tout traitement supplémentaire
}

// Récupère le nom d'utilisateur depuis la session, ou null si non défini
$username = $_SESSION['username'] ?? null;

// Chemin vers le fichier des utilisateurs
$users_file = __DIR__ . '/data/users.json';
if (!file_exists($users_file)) {
    // Si le fichier des utilisateurs n'existe pas, arrête le script avec un message d'erreur
    die("Erreur : Fichier des utilisateurs introuvable.");
}

// Lecture et décodage du fichier JSON des utilisateurs
$users = json_decode(file_get_contents($users_file), true);

// Vérifie si l'utilisateur est VIP
$isVip = false;
foreach ($users as $user) {
    if ($user['username'] === $username && $user['vip_status'] === 'Actif') {
        // Si l'utilisateur a un statut VIP actif, définit $isVip à true
        $isVip = true;
        break;
    }
}

// Récupère les informations de voyage depuis la session, avec des valeurs par défaut si elles ne sont pas définies
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

// Calcul du nombre de nuits et de jours en fonction des dates de départ et de retour
$departureDate = new DateTime($_SESSION['departure_date'] ?? '');
$returnDate = new DateTime($_SESSION['return_date'] ?? '');
$nombreNuits = $departureDate && $returnDate ? $departureDate->diff($returnDate)->days : 0;
$nombreJours = $nombreNuits + 1;

// Calcul du coût total des activités
$totalActivites = 0;
foreach ($activites as $nom => $infos) {
    $qte = intval($infos['quantite']); // Quantité de participants pour l'activité
    $prix = floatval($infos['prix']); // Prix unitaire de l'activité
    $totalActivites += $prix * $qte; // Ajoute le coût total de l'activité au total général
}

// Calcul du nombre de chambres nécessaires (2 personnes par chambre)
$nombreChambres = ceil(intval($nombrePersonnes) / 2);
// Calcul du coût total de l'hôtel
$totalHotel = $prixHotelParNuit * $nombreNuits * $nombreChambres;

// Calcul du coût total des vols aller et retour
$totalVol = $prixVolParPersonne * intval($nombrePersonnes);
$totalVolRetour = $prixVolRetourParPersonne * intval($nombrePersonnes);

// Calcul du coût total des options supplémentaires
$totalOptions = 0;
foreach ($optionsSupplementaires as $opt) {
    $totalOptions += ($opt['prix'] ?? 0) * $nombreJours; // Multiplie le prix de l'option par le nombre de jours
}

// Calcul du coût total général
$totalGeneral = $totalActivites + $totalHotel + $totalVol + $totalVolRetour + $totalOptions;

// Calcul de la réduction VIP si applicable
$discount = $isVip ? $totalGeneral * 0.2 : 0;
// Calcul du total après application de la réduction
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
                <!-- Si aucune activité n'est sélectionnée, affiche un message informatif -->
                <p>Aucune activité sélectionnée.</p>
            <?php endif; ?>
        </div>

        <div class="recap-item">
            <h2>Vol aller :</h2>
            <p>
                <!-- Affiche les détails du vol aller, y compris le nombre de personnes et le coût total -->
                <?php echo htmlspecialchars($vol); ?> — <?php echo $nombrePersonnes; ?> personne<?php echo $nombrePersonnes > 1 ? 's' : ''; ?> × 
                <?php echo number_format($prixVolParPersonne, 2, '.', ''); ?> € = 
                <?php echo number_format($totalVol, 2, '.', ''); ?> €
            </p>
        </div>

        <div class="recap-item">
            <h2>Vol retour :</h2>
            <p>
                <!-- Affiche les détails du vol retour, y compris le nombre de personnes et le coût total -->
                <?php echo htmlspecialchars($vol_retour); ?> — <?php echo $nombrePersonnes; ?> personne<?php echo $nombrePersonnes > 1 ? 's' : ''; ?> × 
                <?php echo number_format($prixVolRetourParPersonne, 2, '.', ''); ?> € = 
                <?php echo number_format($totalVolRetour, 2, '.', ''); ?> €
            </p>
        </div>

        <div class="recap-item">
            <h2>Hôtel sélectionné :</h2>
            <p>
                <!-- Affiche les détails de l'hôtel sélectionné, y compris le nombre de nuits, le prix par nuit, le nombre de chambres et le coût total -->
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
                <!-- Si des options supplémentaires sont sélectionnées, affiche une liste détaillée -->
                <ul>
                    <?php foreach ($optionsSupplementaires as $opt): ?>
                        <li>
                            <!-- Affiche le nom de l'option, le nombre de jours et le coût total pour cette option -->
                            <?php echo htmlspecialchars($opt['nom']); ?> — <?php echo $nombreJours; ?> jour<?php echo $nombreJours > 1 ? 's' : ''; ?>
                            × <?php echo number_format($opt['prix'], 2, '.', ''); ?> € = <?php echo number_format($opt['prix'] * $nombreJours, 2, '.', ''); ?> €
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p><strong>Total options :</strong> <?php echo number_format($totalOptions, 2, '.', ''); ?> €</p>
            <?php else: ?>
                <!-- Si aucune option supplémentaire n'est sélectionnée, affiche un message informatif -->
                <p>Aucune option supplémentaire sélectionnée.</p>
            <?php endif; ?>
        </div>


        <div class="recap-item total">
            <h2>Total général :</h2>
            <!-- Affiche le coût total général avant toute réduction -->
            <p><strong><?php echo number_format($totalGeneral, 2, '.', ''); ?> €</strong></p>
        </div>

        <?php if ($isVip): ?>
        <div class="recap-item discount">
            <h2>Réduction VIP (20%) :</h2>
            <!-- Affiche la réduction VIP si applicable -->
            <p>- <?php echo number_format($discount, 2, '.', ''); ?> €</p>
        </div>

        <div class="recap-item total-after-discount">
            <h2>Total après réduction :</h2>
            <!-- Affiche le coût total après application de la réduction VIP -->
            <p><strong><?php echo number_format($totalAfterDiscount, 2, '.', ''); ?> €</strong></p>
        </div>
        <?php endif; ?>

        <div class="navigation-buttons">
            <!-- Bouton pour revenir à la page des options -->
            <a href="options.php" class="back-btn">← Retour aux options</a>
            <!-- Bouton pour procéder au paiement, avec le montant total après réduction -->
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

