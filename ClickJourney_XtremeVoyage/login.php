<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();


$file_path = __DIR__ . '/data/users.json';


if (!file_exists($file_path)) {
    $_SESSION['error'] = "Erreur : Fichier des utilisateurs introuvable.";
    header("Location: connexion.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $password = trim($_POST['password'] ?? '');

    
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Tous les champs doivent être remplis.";
        header("Location: connexion.php");
        exit();
    }

    
    $users = json_decode(file_get_contents($file_path), true);

    
    $user_found = false;
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            $user_found = true;
            
            if (password_verify($password, $user['password'])) {
                
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['phone'] = $user['phone'];
                $_SESSION['address'] = $user['address'];
                $_SESSION['vip_status'] = $user['vip_status'];
                $_SESSION['join_date'] = $user['join_date'];
                $_SESSION['profile_picture'] = $user['profile_picture'];

                
                $_SESSION['success'] = "Connexion réussie !";
                header("Location: profil.php");
                exit();
            } else {
                
                $_SESSION['error'] = "Nom d'utilisateur ou mot de passe incorrect.";
                header("Location: connexion.php");
                exit();
            }
        }
    }

    
    if (!$user_found) {
        $_SESSION['error'] = "Nom d'utilisateur ou mot de passe incorrect.";
        header("Location: connexion.php");
        exit();
    }
}
?>