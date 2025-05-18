<?php
session_start(); // Démarre la session pour accéder aux variables de session

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si la requête est de type POST

    // Gestion de la désélection des options
    if (isset($_POST['deselection'])) {
        if (isset($_POST['vol'])) { // Désélection d'un vol
            unset($_SESSION['vol'], $_SESSION['prix_vol']); // Supprime les données du vol de la session
            echo "Vol désélectionné.";
            exit;
        }
        if (isset($_POST['vol_retour'])) { // Désélection d'un vol retour
            unset($_SESSION['vol_retour'], $_SESSION['prix_vol_retour']); // Supprime les données du vol retour de la session
            echo "Vol retour désélectionné.";
            exit;
        }
        if (isset($_POST['hotel'])) { // Désélection d'un hôtel
            unset($_SESSION['hotel'], $_SESSION['prix_hotel']); // Supprime les données de l'hôtel de la session
            echo "Hôtel désélectionné.";
            exit;
        }
        if (isset($_POST['service'])) { // Désélection d'un service supplémentaire
            if (isset($_SESSION['options_supplementaires'])) {
                // Filtre les services pour supprimer celui correspondant à la demande
                $_SESSION['options_supplementaires'] = array_filter($_SESSION['options_supplementaires'], function($opt) {
                    return $opt['nom'] !== $_POST['service'];
                });
            }
            echo "Service supprimé.";
            exit;
        }
    }

    // Gestion de la sélection des options
    if (isset($_POST['vol'])) { // Sélection d'un vol
        $_SESSION['vol'] = $_POST['vol']; // Enregistre le vol dans la session
        $_SESSION['prix_vol'] = isset($_POST['prix_vol']) ? floatval($_POST['prix_vol']) : 0; // Enregistre le prix du vol
        echo "Vol sélectionné.";
        exit;
    }

    if (isset($_POST['vol_retour'])) { // Sélection d'un vol retour
        $_SESSION['vol_retour'] = $_POST['vol_retour']; // Enregistre le vol retour dans la session
        $_SESSION['prix_vol_retour'] = isset($_POST['prix_vol_retour']) ? floatval($_POST['prix_vol_retour']) : 0; // Enregistre le prix du vol retour
        echo "Vol retour sélectionné.";
        exit;
    }

    if (isset($_POST['hotel'])) { // Sélection d'un hôtel
        $_SESSION['hotel'] = $_POST['hotel']; // Enregistre l'hôtel dans la session
        $_SESSION['prix_hotel'] = isset($_POST['prix_hotel']) ? floatval($_POST['prix_hotel']) : 0; // Enregistre le prix de l'hôtel
        echo "Hôtel sélectionné.";
        exit;
    }

    if (isset($_POST['service'])) { // Sélection d'un service supplémentaire
        $service = $_POST['service']; // Nom du service
        $prix = isset($_POST['prix_service']) ? floatval($_POST['prix_service']) : 0; // Prix du service

        if (!isset($_SESSION['options_supplementaires'])) {
            $_SESSION['options_supplementaires'] = []; // Initialise le tableau des options supplémentaires si nécessaire
        }

        // Vérifie si le service est déjà ajouté
        foreach ($_SESSION['options_supplementaires'] as $opt) {
            if ($opt['nom'] === $service) {
                echo "Déjà ajouté."; 
                exit;
            }
        }

        // Ajoute le service à la session
        $_SESSION['options_supplementaires'][] = ['nom' => $service, 'prix' => $prix];
        echo "Service ajouté.";
        exit;
    }

    echo "Aucune option reconnue."; 
} else {
    echo "Requête non autorisée."; 
}
?>
