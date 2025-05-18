<?php

// Démarrage de la session pour pouvoir la détruire
session_start();

// Suppression de toutes les variables de session
session_unset();
// Destruction de la session
session_destroy();

// Message de déconnexion à afficher sur la page de connexion
$_SESSION['message'] = "Vous avez été déconnecté avec succès.";

// Redirection vers la page de connexion
header("Location: connexion.php");
exit();
?>