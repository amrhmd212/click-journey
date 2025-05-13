<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}

$username = $_SESSION['username'] ?? null;
$dateDepart = $_SESSION['departure_date'] ?? null;
$dateRetour = $_SESSION['return_date'] ?? null;

$nombreJours = 0;
if (isset($_SESSION['departure_date']) && isset($_SESSION['return_date'])){
    if ($dateDepart !== 'Non sélectionnée' && $dateRetour !== 'Non précisée') {
        $dateStart = DateTime::createFromFormat('Y-m-d', $dateDepart);
        $dateEnd = DateTime::createFromFormat('Y-m-d', $dateRetour);

        if ($dateStart && $dateEnd && $dateStart <= $dateEnd) {
            $nombreJours = $dateStart->diff($dateEnd)->days + 1;
        }
    }
}

if (isset($_SESSION['num_people'])){
    $nombreChambres = ceil(intval($_SESSION['num_people']) / 2);
    $totalHotel = $_SESSION['prix_hotel'] * ($nombreJours - 1) * $nombreChambres;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="panier.css">
    <title>Panier</title>

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

<div class="panier">
    <h2>Votre Panier</h2>

    <?php if (isset($_SESSION['pays_selectionne'])): ?>
        <p><strong>Pays sélectionné :</strong> <?= htmlspecialchars($_SESSION['pays_selectionne']) ?></p>

        <p><strong>Dates :</strong>
            Départ le <?= htmlspecialchars($_SESSION['departure_date'] ?? 'non défini') ?>,
            Retour le <?= htmlspecialchars($_SESSION['return_date'] ?? 'non défini') ?>
        </p>

        <p><strong>Nombre de personnes :</strong> <?= htmlspecialchars($_SESSION['num_people'] ?? 'Non spécifié') ?></p>

        <hr>

        <h3>Vols</h3>
        <p><strong>Aller :</strong> <?= htmlspecialchars($_SESSION['vol'] ?? 'Non sélectionné') ?> <br>
           Prix : <?= htmlspecialchars(($_SESSION['prix_vol'] ?? 0) * ($_SESSION['num_people'] ?? 0)) ?> €</p>

        <p><strong>Retour :</strong> <?= htmlspecialchars($_SESSION['vol_retour'] ?? 'Non sélectionné') ?> <br>
           Prix : <?= htmlspecialchars(($_SESSION['prix_vol_retour'] ?? 0) * ($_SESSION['num_people'] ?? 0)) ?> €</p>

        <hr>

        <h3>Hébergement</h3>
        <p><strong>Hôtel :</strong> <?= htmlspecialchars($_SESSION['hotel'] ?? 'Non sélectionné') ?> <br>
           Prix : <?= htmlspecialchars(($totalHotel ?? 0)) ?> €</p>

        <hr>

        <h3>Activités</h3>
        <?php
        $total_activites = 0;
        if (!empty($_SESSION['activites_selectionnees'])): ?>
            <ul style="list-style-type: none; padding: 0;">
                <?php foreach ($_SESSION['activites_selectionnees'] as $nom => $details):
                    $quantite = (int)$details['quantite'];
                    $prix = (float)$details['prix'];
                    $sous_total = $quantite * $prix;
                    $total_activites += $sous_total;
                    ?>
                    <li>
                        <strong><?= htmlspecialchars($nom) ?></strong><br>
                        Quantité : <?= $quantite ?> | Prix unitaire : <?= $prix ?> €<br>
                        Sous-total : <?= $sous_total ?> €
                    </li><br>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="vide">Pas d’activité sélectionnée.</p>
        <?php endif; ?>

        <hr>

        <h3>Options supplémentaires</h3>
        <?php
        $total_options = 0;
        if (!empty($_SESSION['options_supplementaires'])): ?>
            <ul>
                <?php foreach ($_SESSION['options_supplementaires'] as $option):
                    $total_options += $option['prix'];
                    ?>
                    <li>
                        <?= htmlspecialchars($option['nom']) ?> - <?= $option['prix'] ?> €  x  <?= $nombreJours ?> jours
                    </li>
                <?php endforeach; ?>
                Sous-total : <?= ($total_options) * ($nombreJours) ?> €
            </ul>
        <?php else: ?>
            <p>Aucune option supplémentaire.</p>
        <?php endif; ?>

        <hr>

        <?php
        $total_global =
            ((int)($_SESSION['prix_vol'] ?? 0) * (int)($_SESSION['num_people'] ?? 0))
            + ((int)($_SESSION['prix_vol_retour'] ?? 0) * (int)($_SESSION['num_people'] ?? 0))
            + ($totalHotel ?? 0)
            + $total_activites
            + ($total_options * (int)($nombreJours ?? 0));
        ?>
        <p><strong>Total général :</strong> <?= $total_global ?> € <br>
        <h4> Hors réduction </h4>
        </p>


        <div class="buttons">
            <form action="continuer-panier.php" method="get" style="display:inline;">
                <button type="submit" class="continuer">Continuer l'achat</button>
            </form>
            <form action="supprimer_panier.php" method="post" style="display:inline;">
                <button type="submit" class="supprimer">Supprimer le panier</button>
            </form>
        </div>

    <?php else: ?>
        <p class="vide">Votre panier est vide.</p>
    <?php endif; ?>
</div>
<script src="js/theme.js"></script>
</body>
</html>
