<?php
header('Content-Type: application/json'); // Définit le type de contenu de la réponse en JSON
session_start(); // Démarre la session pour gérer les données utilisateur

// Chemin vers le fichier JSON contenant les utilisateurs
$file_path = __DIR__ . '/data/users.json';
if (!file_exists($file_path)) { // Si le fichier n'existe pas, il est créé avec un tableau vide
    file_put_contents($file_path, '[]');
}

// Charge les utilisateurs existants depuis le fichier JSON
$users = json_decode(file_get_contents($file_path), true);

// Récupération et validation des données du formulaire
$username = htmlspecialchars(trim($_POST['username'] ?? '')); // Nettoie le champ "username"
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL); // Nettoie le champ "email"
$password = $_POST['password'] ?? ''; // Récupère le mot de passe
$confirm_password = $_POST['confirm-password'] ?? ''; // Récupère la confirmation du mot de passe
$phone = htmlspecialchars(trim($_POST['phone'] ?? '')); // Nettoie le champ "phone"
$address = htmlspecialchars(trim($_POST['address'] ?? '')); // Nettoie le champ "address"
$vip_status = isset($_POST['subscribe_vip']) ? 'Actif' : 'Inactif'; // Vérifie si l'utilisateur souscrit au VIP
$join_date = date('Y-m-d'); // Date d'inscription
$profile_picture = 'https://th.bing.com/th/id/OIP.jAJJPOd3jC4EmG8cmmoNugHaHa?rs=1&pid=ImgDetMain'; // Image par défaut
$is_admin = false; // Par défaut, l'utilisateur n'est pas administrateur

// Vérification des doublons (email, nom d'utilisateur, téléphone)
foreach ($users as $user) {
    if ($user['email'] === $email) {
        echo json_encode(["success" => false, "message" => "Cette adresse email est déjà utilisée.", "field" => "email"]);
        exit;
    }
    if ($user['username'] === $username) {
        echo json_encode(["success" => false, "message" => "Ce nom d'utilisateur est déjà pris.", "field" => "username"]);
        exit;
    }
    if ($user['phone'] === $phone) {
        echo json_encode(["success" => false, "message" => "Ce numéro de téléphone est déjà utilisé.", "field" => "phone"]);
        exit;
    }
}

// Vérifie si les mots de passe correspondent
if ($password !== $confirm_password) {
    echo json_encode(["success" => false, "message" => "Les mots de passe ne correspondent pas.", "field" => "confirm-password"]);
    exit;
}

// Hachage du mot de passe
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
if ($hashed_password === false) { // Vérifie si le hachage a échoué
    echo json_encode(["success" => false, "message" => "Erreur lors du traitement du mot de passe."]);
    exit;
}

// Création d'un nouvel utilisateur
$new_user = [
    'email' => $email,
    'username' => $username,
    'password' => $hashed_password,
    'phone' => $phone,
    'address' => $address,
    'vip_status' => 'inactif',
    'join_date' => $join_date,
    'profile_picture' => $profile_picture,
    'is_admin' => $is_admin
];

// Ajout du nouvel utilisateur au tableau des utilisateurs
$users[] = $new_user;

// Sauvegarde des utilisateurs dans le fichier JSON
file_put_contents($file_path, json_encode($users, JSON_PRETTY_PRINT));

// Redirige vers la page de paiement si l'utilisateur souscrit au VIP
if ($vip_status === 'Actif') {
    echo json_encode([
        "success" => true,
        "redirect" => "carte-paiement.php?montant=50&username=" . urlencode($username) . "&vip=true"
    ]);
    exit;
}

echo json_encode(["success" => true, "message" => "Inscription réussie. Vous pouvez maintenant vous connecter."]);
exit;
