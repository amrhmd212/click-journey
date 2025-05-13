<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['deselection'])) {
        if (isset($_POST['vol'])) {
            unset($_SESSION['vol'], $_SESSION['prix_vol']);
            echo "Vol désélectionné.";
            exit;
        }
        if (isset($_POST['vol_retour'])) {
            unset($_SESSION['vol_retour'], $_SESSION['prix_vol_retour']);
            echo "Vol retour désélectionné.";
            exit;
        }
        if (isset($_POST['hotel'])) {
            unset($_SESSION['hotel'], $_SESSION['prix_hotel']);
            echo "Hôtel désélectionné.";
            exit;
        }
        if (isset($_POST['service'])) {
            if (isset($_SESSION['options_supplementaires'])) {
                $_SESSION['options_supplementaires'] = array_filter($_SESSION['options_supplementaires'], function($opt) {
                    return $opt['nom'] !== $_POST['service'];
                });
            }
            echo "Service supprimé.";
            exit;
        }
    }


    if (isset($_POST['vol'])) {
        $_SESSION['vol'] = $_POST['vol'];
        $_SESSION['prix_vol'] = isset($_POST['prix_vol']) ? floatval($_POST['prix_vol']) : 0;
        echo "Vol sélectionné.";
        exit;
    }

    if (isset($_POST['vol_retour'])) {
        $_SESSION['vol_retour'] = $_POST['vol_retour'];
        $_SESSION['prix_vol_retour'] = isset($_POST['prix_vol_retour']) ? floatval($_POST['prix_vol_retour']) : 0;
        echo "Vol retour sélectionné.";
        exit;
    }

    if (isset($_POST['hotel'])) {
        $_SESSION['hotel'] = $_POST['hotel'];
        $_SESSION['prix_hotel'] = isset($_POST['prix_hotel']) ? floatval($_POST['prix_hotel']) : 0;
        echo "Hôtel sélectionné.";
        exit;
    }

    if (isset($_POST['service'])) {
        $service = $_POST['service'];
        $prix = isset($_POST['prix_service']) ? floatval($_POST['prix_service']) : 0;

        if (!isset($_SESSION['options_supplementaires'])) {
            $_SESSION['options_supplementaires'] = [];
        }

        foreach ($_SESSION['options_supplementaires'] as $opt) {
            if ($opt['nom'] === $service) {
                echo "Déjà ajouté.";
                exit;
            }
        }

        $_SESSION['options_supplementaires'][] = ['nom' => $service, 'prix' => $prix];
        echo "Service ajouté.";
        exit;
    }

    echo "Aucune option reconnue.";
} else {
    echo "Requête non autorisée.";
}
