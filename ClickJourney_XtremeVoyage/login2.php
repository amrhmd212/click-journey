<?php

$valid_username = 'koa';
$valid_password = '123';


$username = $_POST['username'];
$password = $_POST['password'];


if ($username === $valid_username && $password === $valid_password) {
    
    session_start();
    $_SESSION['username'] = $username;
    header('Location: dashboard.php');
    exit();
} else {
    
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}
?>