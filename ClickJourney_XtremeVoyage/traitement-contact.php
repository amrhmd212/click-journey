<?php
session_start(); // Démarre la session pour gérer les données utilisateur

// Récupération et validation des données du formulaire
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING); // Nettoie le champ "nom"
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); // Nettoie le champ "email"
$sujet = filter_input(INPUT_POST, 'sujet', FILTER_SANITIZE_STRING); // Nettoie le champ "sujet"
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING); // Nettoie le champ "message"

// Vérifie si tous les champs sont remplis
if ($nom && $email && $sujet && $message) {
    // Si tous les champs sont valides, affiche un message de succès
    echo "Votre message a bien été envoyé ! Notre équipe vous répondra dans les plus brefs délais.";
} else {
    // Si un ou plusieurs champs sont manquants, retourne une erreur 400 (mauvaise requête)
    http_response_code(400); // Définit le code de réponse HTTP à 400
    echo "Tous les champs sont requis."; 
}
