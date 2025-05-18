<?php
/**
 * Page affichée aux utilisateurs bannis
 * Cette page détruit la session active et informe l'utilisateur de son bannissement
 * PHP Version 7.4
 */
// Démarre la session pour pouvoir la détruire
session_start();
// Détruit la session active pour déconnecter l'utilisateur
session_destroy();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Configuration de base du document -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès Refusé</title>
    <!-- Importation des polices Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    
</head>
<body>
    <!-- Message principal -->
    <h1>Accès Refusé</h1>
    <!-- Message d'information pour l'utilisateur -->
    <p>Votre compte a été banni. Si vous pensez que c'est une erreur, veuillez contacter l'administrateur.</p>
    <!-- Lien vers la page de contact -->
    <a href="contact.php">Contactez-nous</a>
</body>
</html>
