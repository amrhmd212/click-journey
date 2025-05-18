<?php
// Démarre la session pour gérer les variables de session
session_start();

// Récupère le nom d'utilisateur de la session s'il existe, sinon null
$username = $_SESSION['username'] ?? null;
// Initialisation du message d'erreur
$error_message = '';

// Détection requête AJAX
$is_ajax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

// Vérification si le formulaire a été soumis (méthode POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $departure_date = $_POST['departure-date'] ?? '';
    $return_date = $_POST['return-date'] ?? '';
    $num_people = $_POST['num-people'] ?? '';

    // Conversion des dates en objets DateTime pour la validation
    $departure = DateTime::createFromFormat('Y-m-d', $departure_date);
    $return = DateTime::createFromFormat('Y-m-d', $return_date);
    $today = new DateTime('today');

    // Validation
    if (!$departure || !$return || empty($num_people)) {
        $error_message = "Veuillez remplir tous les champs correctement.";
    } elseif ($departure < $today) {
        $error_message = "La date de départ ne peut pas être antérieure à aujourd'hui.";
    } elseif ($return < $departure) {
        $error_message = "La date de retour doit être postérieure ou égale à la date de départ.";
    } elseif (!is_numeric($num_people) || intval($num_people) < 1 || intval($num_people) > 20) {
        $error_message = "Le nombre de personnes doit être compris entre 1 et 20.";
    } else {
        $_SESSION['departure_date'] = $departure_date;
        $_SESSION['return_date'] = $return_date;
        $_SESSION['num_people'] = intval($num_people);

        if ($is_ajax) {
            echo json_encode(['success' => true]);
            exit();
        } else {
            header("Location: options.php");
            exit();
        }
    }

    if ($is_ajax) {
        echo json_encode(['success' => false, 'message' => $error_message]);
        exit();
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

        <form id="date-form" method="POST" action="date.php">
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

    <script src="js/theme.js"></script>
    <script>
        // Restriction date
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('departure-date').setAttribute('min', today);
        document.getElementById('return-date').setAttribute('min', today);

        // AJAX Form
        document.getElementById('date-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('date.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'options.php';
                } else {
                    let errorDiv = document.querySelector('.error-message');
                    if (errorDiv) {
                        errorDiv.textContent = data.message;
                    } else {
                        errorDiv = document.createElement('div');
                        errorDiv.className = 'error-message';
                        errorDiv.textContent = data.message;
                        document.querySelector('.form-container').prepend(errorDiv);
                    }
                }
            })
            .catch(error => console.error('Erreur AJAX :', error));
        });
    </script>
</body>
</html>
