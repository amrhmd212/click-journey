<?php

session_start();


session_unset();
session_destroy();


$_SESSION['message'] = "Vous avez été déconnecté avec succès.";


header("Location: connexion.php");
exit();
?>