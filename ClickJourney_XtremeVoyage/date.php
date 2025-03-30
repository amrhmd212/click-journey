<?php 
session_start();

$username = $_SESSION['username'] ?? null;

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $departure_date = $_POST['departure-date'] ?? '';
    $return_date = $_POST['return-date'] ?? '';
    $num_people = $_POST['num-people'] ?? '';

    if (!empty($departure_date) && !empty($return_date) && !empty($num_people)) {
        if ($return_date >= $departure_date) {
            $_SESSION['departure_date'] = $departure_date;
            $_SESSION['return_date'] = $return_date;
            $_SESSION['num_people'] = $num_people;

            header("Location: options.php");
            exit();
        } else {
            $error_message = "La date de retour doit être postérieure ou égale à la date de départ.";
        }
    } else {
        $error_message = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planification du voyage - Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="date.css">
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

    <header>
        <h1 class="main-title">Planifiez votre voyage</h1>
    </header>

    <div class="form-container">
    <?php if (!empty($error_message)) : ?>
    <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

        <form method="POST" action="date.php">
            <div class="form-group">
                <label for="departure-date">Date de départ :</label>
                <input type="date" id="departure-date" name="departure-date" required>
            </div>

            <div class="form-group">
                <label for="return-date">Date de retour :</label>
                <input type="date" id="return-date" name="return-date" required>
            </div>

            <div class="form-group">
                <label for="num-people">Nombre de personnes :</label>
                <input type="number" id="num-people" name="num-people" min="1" max="20" required>
            </div>

            <button type="submit" class="submit-btn">Valider et voir les destinations</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>
</body>
</html>
