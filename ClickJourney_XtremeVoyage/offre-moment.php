<?php
session_start();
$_SESSION['pays_selectionne'] = 'Portugal';

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

$_SESSION['departure_date'] = '2025-05-14';
$_SESSION['return_date'] = '2025-05-17';
$_SESSION['num_people'] = 2;

$_SESSION['vol'] = 'Vol 1 - Paris (CDG) à Portugal-Porto - 08:00-11:00 - Air France';
$_SESSION['prix_vol'] = 441;

$_SESSION['vol_retour'] = 'Retour - Portugal-Porto à Paris (CDG) - 10:00-13:00 - TAP Portugal';
$_SESSION['prix_vol_retour'] = 380.5;

$_SESSION['hotel'] = 'Hotel Avenida Palace - 5 étoiles';
$_SESSION['prix_hotel'] = 170;

$_SESSION['options_supplementaires'] = [
    [
        'nom' => 'All Inclusive',
        'prix' => 17
    ]
];

header("Location: recap.php");
    exit();

?>