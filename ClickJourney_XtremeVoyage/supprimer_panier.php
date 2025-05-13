<?php
session_start();
unset($_SESSION['pays_selectionne']);
unset($_SESSION['activites_selectionnees']);
unset($_SESSION['departure_date']);
unset($_SESSION['return_date']);
unset($_SESSION['num_people']);
unset($_SESSION['vol']);
unset($_SESSION['prix_vol']);
unset($_SESSION['vol_retour']);
unset($_SESSION['prix_vol_retour']);
unset($_SESSION['hotel']);
unset($_SESSION['prix_hotel']);
unset($_SESSION['options_supplementaires']);
header('Location: panier.php');
exit;