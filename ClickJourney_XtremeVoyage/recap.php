<?php
session_start();


if (empty($_SESSION['vol']) || empty($_SESSION['hotel'])) {
    header("Location: options.php?error=Veuillez+choisir+un+vol+et+un+hôtel+avant+de+consulter+le+recapitulatif");
    exit();
}

$username = $_SESSION['username'] ?? null;


$paysSelectionne = $_SESSION['pays_selectionne'] ?? 'Non sélectionné';
$dateDepart = $_SESSION['departure_date'] ?? 'Non sélectionnée';
$nombrePersonnes = $_SESSION['num_people'] ?? 'Non sélectionné';
$activites = $_SESSION['activites_selectionnees'] ?? [];
$vol = $_SESSION['vol'] ?? 'Non sélectionné';
$hotel = $_SESSION['hotel'] ?? 'Non sélectionné';
$optionsSupplementaires = $_SESSION['options_supplementaires'] ?? [];
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
            <h2>Nombre de personnes :</h2>
            <p><?php echo htmlspecialchars($nombrePersonnes); ?></p>
        </div>

        
        <div class="recap-item">
            <h2>Activités choisies :</h2>
            <?php if (!empty($activites)): ?>
                <ul>
                    <?php foreach ($activites as $activite): ?>
                        <li><?php echo htmlspecialchars($activite); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucune activité sélectionnée.</p>
            <?php endif; ?>
        </div>

        
        <div class="recap-item">
            <h2>Vol :</h2>
            <p><?php echo htmlspecialchars($vol); ?></p>
        </div>

        
        <div class="recap-item">
            <h2>Hôtel sélectionné :</h2>
            <p><?php echo htmlspecialchars($hotel); ?></p>
        </div>

        
        <div class="recap-item">
            <h2>Options supplémentaires :</h2>
            <?php if (!empty($optionsSupplementaires)): ?>
                <ul>
                    <?php foreach ($optionsSupplementaires as $option): ?>
                        <li><?php echo htmlspecialchars($option); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucune option supplémentaire sélectionnée.</p>
            <?php endif; ?>
        </div>

        
        <div class="navigation-buttons">
            <a href="options.php" class="back-btn">← Retour aux options</a>
            <button class="confirm-btn" onclick="window.location.href='carte-paiement.php'">Procéder au paiement</button>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
</body>
</html>