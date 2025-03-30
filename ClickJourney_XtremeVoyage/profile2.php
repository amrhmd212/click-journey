<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit();
}


$file_path = __DIR__ . '/data/users.json';


if (!file_exists($file_path)) {
    die("Erreur : Fichier des utilisateurs introuvable.");
}


$users = json_decode(file_get_contents($file_path), true);


$username = $_SESSION['username'];
$user_data = null;

foreach ($users as $user) {
    if ($user['username'] === $username) {
        $user_data = $user;
        break;
    }
}

if (!$user_data) {
    die("Erreur : Utilisateur introuvable.");
}


$email = $user_data['email'] ?? 'Non défini';
$phone = $user_data['phone'] ?? 'Non défini';
$address = $user_data['address'] ?? 'Non défini';
$vip_status = $user_data['vip_status'] ?? 'Inactif';
$join_date = $user_data['join_date'] ?? 'Janvier 2023';
$profile_picture = $user_data['profile_picture'] ?? 'https://th.bing.com/th/id/OIP.jAJJPOd3jC4EmG8cmmoNugHaHa?rs=1&pid=ImgDetMain';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
    if ($_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_name = uniqid() . '_' . basename($_FILES['profile_picture']['name']);
        $target_file = $upload_dir . $file_name;

        
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
                
                foreach ($users as &$user) {
                    if ($user['username'] === $username) {
                        $user['profile_picture'] = 'uploads/' . $file_name;
                        break;
                    }
                }
                
                file_put_contents($file_path, json_encode($users, JSON_PRETTY_PRINT));
                $_SESSION['profile_picture'] = 'uploads/' . $file_name;
                $profile_picture = 'uploads/' . $file_name;
            }
        }
    }
    
    header("Location: profil.php");
    exit();
}


function updateUserFile($file_path, $username, $new_data) {
    $users = json_decode(file_get_contents($file_path), true);

    foreach ($users as &$user) {
        if ($user['username'] === $username) {
            $user = array_merge($user, $new_data);
            break;
        }
    }

    file_put_contents($file_path, json_encode($users, JSON_PRETTY_PRINT));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Xtreme Voyage</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="profil.css">
    <style>
        .profile-picture-container {
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
        }
        
        .profile-picture-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-picture-container form {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
        }
        
        .profile-picture-container:hover::after {
            content: 'Changer';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.7);
            color: white;
            text-align: center;
            padding: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="presentation.php">Présentation</a></li>
            <li><a href="quisommesnous.php">Qui sommes-nous</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="logout.php" class="login-btn no-effect">Déconnexion</a></li>
            <li><a href="recherche.php"><i class="fas fa-search search-icon"></i></a></li>
        </ul>
    </nav>

    <h1>Mon Profil</h1>
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-header-info">
                <h2><?= htmlspecialchars($username) ?></h2>
                <p>Membre depuis <?= htmlspecialchars($join_date) ?></p>
            </div>
            <div class="profile-picture-container">
                <img src="<?= htmlspecialchars($profile_picture) ?>" alt="Photo de profil">
                <form method="POST" action="profil.php" enctype="multipart/form-data">
                    <input type="file" name="profile_picture" accept="image/*" style="width:100%; height:100%; cursor:pointer;">
                </form>
            </div>
        </div>
        
        <div class="profile-details">
            
            <div class="profile-field">
                <div class="field-info">
                    <h3>Nom</h3>
                    <p><?= htmlspecialchars($username) ?></p>
                </div>
                <form method="POST" action="profil.php" style="display:inline;">
                    <input type="hidden" name="field" value="username">
                    <input type="text" name="new_value" placeholder="Nouveau nom" required>
                    <button type="submit" class="edit-btn">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </form>
            </div>

            
            <div class="profile-field">
                <div class="field-info">
                    <h3>Email</h3>
                    <p><?= htmlspecialchars($email) ?></p>
                </div>
                <form method="POST" action="profil.php" style="display:inline;">
                    <input type="hidden" name="field" value="email">
                    <input type="email" name="new_value" placeholder="Nouvel email" required>
                    <button type="submit" class="edit-btn">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </form>
            </div>

            
            <div class="profile-field">
                <div class="field-info">
                    <h3>Téléphone</h3>
                    <p><?= htmlspecialchars($phone) ?></p>
                </div>
                <form method="POST" action="profil.php" style="display:inline;">
                    <input type="hidden" name="field" value="phone">
                    <input type="text" name="new_value" placeholder="Nouveau téléphone" required>
                    <button type="submit" class="edit-btn">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </form>
            </div>

            
            <div class="profile-field">
                <div class="field-info">
                    <h3>Adresse</h3>
                    <p><?= htmlspecialchars($address) ?></p>
                </div>
                <form method="POST" action="profil.php" style="display:inline;">
                    <input type="hidden" name="field" value="address">
                    <input type="text" name="new_value" placeholder="Nouvelle adresse" required>
                    <button type="submit" class="edit-btn">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </form>
            </div>

            
            <div class="profile-field">
                <div class="field-info">
                    <h3>Statut VIP</h3>
                    <p><?= htmlspecialchars($vip_status) ?></p>
                </div>
                <form method="POST" action="profil.php" style="display:inline;">
                    <input type="hidden" name="field" value="vip_status">
                    <select name="new_value" required>
                        <option value="Actif" <?= ($vip_status === 'Actif') ? 'selected' : '' ?>>Actif</option>
                        <option value="Inactif" <?= ($vip_status === 'Inactif') ? 'selected' : '' ?>>Inactif</option>
                    </select>
                    <button type="submit" class="edit-btn">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Xtreme VOYAGES - Droits Réservés | <a href="politique.php">Politique de remboursement</a></p>
        <p>Contactez-nous pour plus d'informations</p>
    </footer>

    <script>
        
        document.querySelector('input[name="profile_picture"]').addEventListener('change', function() {
            this.form.submit();
        });
    </script>
</body>
</html>