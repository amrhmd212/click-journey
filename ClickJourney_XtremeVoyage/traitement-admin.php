<?php
header('Content-Type: application/json');
session_start();

$users_file = __DIR__ . '/data/users.json';
if (!file_exists($users_file)) {
    echo json_encode(['success' => false, 'message' => 'Fichier utilisateurs introuvable']);
    exit;
}

$users = json_decode(file_get_contents($users_file), true);

// Vérification connexion et droits admin
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté']);
    exit;
}

$current_user = null;
foreach ($users as $user) {
    if ($user['username'] === $_SESSION['username']) {
        $current_user = $user;
        break;
    }
}

if (!$current_user || !($current_user['is_admin'] ?? false)) {
    echo json_encode(['success' => false, 'message' => 'Accès réservé aux administrateurs']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
    exit;
}

$action = $_POST['action'] ?? '';
$user_email = $_POST['user_email'] ?? '';

$found = false;
foreach ($users as &$user) {
    if ($user['email'] === $user_email) {
        $found = true;
        switch ($action) {
            case 'toggle_vip':
                $user['vip_status'] = ($user['vip_status'] === 'Actif') ? 'Inactif' : 'Actif';
                break;
            case 'toggle_ban':
                if (!($user['is_admin'] ?? false)) {
                    $user['vip_status'] = ($user['vip_status'] === 'Banni') ? 'Inactif' : 'Banni';
                } else {
                    echo json_encode(['success' => false, 'message' => 'Impossible de bannir un administrateur']);
                    exit;
                }
                break;
            case 'toggle_admin':
                if ($user['username'] !== $_SESSION['username'] && !($user['is_admin'] ?? false)) {
                    $user['is_admin'] = !($user['is_admin'] ?? false);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Impossible de modifier les droits d\'un administrateur']);
                    exit;
                }
                break;
            default:
                echo json_encode(['success' => false, 'message' => 'Action inconnue']);
                exit;
        }
        break;
    }
}

if (!$found) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non trouvé']);
    exit;
}

// Sauvegarde
file_put_contents($users_file, json_encode($users, JSON_PRETTY_PRINT));

echo json_encode(['success' => true, 'message' => 'Modification effectuée avec succès']);
exit;
