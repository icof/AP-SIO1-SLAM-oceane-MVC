<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

// inclusion des fichiers modele et fonctions
include_once "modele/bd.resto.inc.php";

// creation du menu burger
$menuBurger = array();
$menuBurger[] = Array("url" => "./?action=recherche&critere=nom", "label" => "Recherche par nom");
$menuBurger[] = Array("url" => "./?action=recherche&critere=adresse", "label" => "Recherche par adresse");

// critere de recherche par defaut
$critere = "nom";
if (isset($_GET["critere"])) {
    $critere = $_GET["critere"];
}
// recuperation des donnees GET, POST, et SESSION
// recherche par nom
$nomR = "";
// recherche par adresse
$voieAdrR = "";
$cpR = "";
$villeR = "";
if (isset($_POST['nomR'])) {
    $nomR = $_POST['nomR'];
}
if (isset($_POST['voieAdrR'])) {
    $voieAdrR = $_POST['voieAdrR'];
}
if (isset($_POST['cpR'])) {
    $cpR = $_POST['cpR'];
}
if (isset($_POST['villeR'])) {
    $villeR = $_POST['villeR'];
}

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
// Si on provient du formulaire de recherche : $critere indique le type de recherche à effectuer
if (!empty($_POST)) {
    // print_r($_POST);
    switch ($critere) {
        case 'nom':
            // recherche par nom
            $listeRestos = getRestosByNomR($nomR);
            break;
        case 'adresse':
            // recherche par adresse
            $listeRestos = getRestosByAdresse($voieAdrR, $cpR, $villeR);
            break;
    }
}

// traitement si necessaire des donnees recuperees
;

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Recherche d'un restaurant";
include "vue/entete.html.php";
include "vue/vueRechercheResto.php";
if (isset($listeRestos)){
    include "vue/vueResultRecherche.php";
}
include "vue/pied.html.php";
?>