<?php
session_start();

//Adapte les nom des pays aux url des pages
function transformer_url($url) {
    $url = iconv('UTF-8', 'ASCII//TRANSLIT', $url);
    $url = str_replace(' ', '-', $url);
    $url = strtolower($url);
    return $url;
}

$pays_url = transformer_url($_SESSION['pays_selectionne']);

//Redirige selon l'avancé de l'achat
if (!isset($_SESSION['pays_selectionne'])) {
    header("Location: index.php");
    exit;
}
if (empty($_SESSION['activites_selectionnees'])) {
    header("Location: {$pays_url}-activites.php");
    exit;
}
if (empty($_SESSION['departure_date']) || empty($_SESSION['return_date']) || empty($_SESSION['num_people'])) {
    header("Location: date.php");
    exit;
}
if (
    empty($_SESSION['vol']) || empty($_SESSION['prix_vol']) ||
    empty($_SESSION['vol_retour']) || empty($_SESSION['prix_vol_retour']) ||
    empty($_SESSION['hotel']) || empty($_SESSION['prix_hotel'])
) {
    header("Location: options.php");
    exit;
}

header("Location: recap.php");
exit;
