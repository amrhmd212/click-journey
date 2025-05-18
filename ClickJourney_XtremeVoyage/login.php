<?php

// Affichage des erreurs pour le debug (à désactiver en production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Démarrage de la session pour gérer les informations utilisateur
session_start();

// Chemin vers le fichier JSON des utilisateurs
$file_path = __DIR__ . '/data/users.json';

// Vérification de l'existence du fichier utilisateurs
if (!file_exists($file_path)) {
    $_SESSION['error'] = "Erreur : Fichier des utilisateurs introuvable.";
    header("Location: connexion.php");
    exit();
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Récupération et sécurisation des champs du formulaire
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $password = trim($_POST['password'] ?? '');

    // Vérification que tous les champs sont remplis
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Tous les champs doivent être remplis.";
        header("Location: connexion.php");
        exit();
    }

    // Lecture des utilisateurs depuis le fichier JSON
    $users = json_decode(file_get_contents($file_path), true);

    // Recherche de l'utilisateur dans la liste
    $user_found = false;
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            $user_found = true;
            
            // Vérification du mot de passe
            if (password_verify($password, $user['password'])) {
                
                // Stockage des infos utilisateur en session
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['phone'] = $user['phone'];
                $_SESSION['address'] = $user['address'];
                $_SESSION['vip_status'] = $user['vip_status'];
                $_SESSION['join_date'] = $user['join_date'];
                $_SESSION['profile_picture'] = $user['profile_picture'];

                // Message de succès et redirection vers le profil
                $_SESSION['success'] = "Connexion réussie !";
                header("Location: profil.php");
                exit();
            } else {
                // Mot de passe incorrect
                $_SESSION['error'] = "Nom d'utilisateur ou mot de passe incorrect.";
                header("Location: connexion.php");
                exit();
            }
        }
    }

    // Aucun utilisateur trouvé avec ce nom
    if (!$user_found) {
        $_SESSION['error'] = "Nom d'utilisateur ou mot de passe incorrect.";
        header("Location: connexion.php");
        exit();
    }
}
?>