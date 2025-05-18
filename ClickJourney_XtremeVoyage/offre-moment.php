<?php
session_start(); // Démarre la session pour stocker les données de l'offre

// Définit le pays sélectionné pour l'offre
$_SESSION['pays_selectionne'] = 'Portugal';

// Définit les activités sélectionnées pour l'offre avec leurs quantités et prix
$_SESSION['activites_selectionnees'] = [
    'Nager avec des dauphins' => [
        'quantite' => 2, 
        'prix' => 51 
    ],
    'Visite des grottes en bateau' => [
        'quantite' => 2,
        'prix' => 30.5
    ],
    'Croisière dans la Vallée du Douro' => [
        'quantite' => 2,
        'prix' => 57.5
    ]
];

// Définit les dates de départ et de retour pour l'offre
$_SESSION['departure_date'] = '2025-05-14'; 
$_SESSION['return_date'] = '2025-05-17';
// Définit le nombre de personnes pour l'offre
$_SESSION['num_people'] = 2;

// Définit les informations sur le vol aller
$_SESSION['vol'] = 'Vol 1 - Paris (CDG) à Portugal-Porto - 08:00-11:00 - Air France';
$_SESSION['prix_vol'] = 441; 

// Définit les informations sur le vol retour
$_SESSION['vol_retour'] = 'Retour - Portugal-Porto à Paris (CDG) - 10:00-13:00 - TAP Portugal';
$_SESSION['prix_vol_retour'] = 380.5; 

// Définit les informations sur l'hôtel
$_SESSION['hotel'] = 'Hotel Avenida Palace - 5 étoiles';
$_SESSION['prix_hotel'] = 170; 

// Définit les options supplémentaires sélectionnées pour l'offre
$_SESSION['options_supplementaires'] = [
    [
        'nom' => 'All Inclusive', 
        'prix' => 17
    ]
];

// Redirige vers la page de récapitulatif
header("Location: recap.php");
exit(); 
?>
