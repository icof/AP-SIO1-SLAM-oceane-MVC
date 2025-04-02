<?php
// si le script est appelé directement (pour tests locaux), on redéfinit le chemin de la racine pour les inclusions
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}

// inclusion des fichiers modele et fonctions
include_once "modele/bd.resto.inc.php";
include_once "modele/bd.typecuisine.inc.php";
include_once "modele/bd.photo.inc.php";
include_once "modele/bd.critiquer.inc.php";
include_once "modele/bd.aimer.inc.php";
include_once "modele/authentification.inc.php";

// creation du menu burger
$menuBurger = array();
$menuBurger[] = Array("url"=>"#top","label"=>"Le restaurant");
$menuBurger[] = Array("url"=>"#adresse","label"=>"Adresse");
$menuBurger[] = Array("url"=>"#photos","label"=>"Photos");
$menuBurger[] = Array("url"=>"#horaires","label"=>"Horaires");
$menuBurger[] = Array("url"=>"#crit","label"=>"Critiques");

// recuperation des donnees GET, POST, et SESSION
$idR = $_GET["idR"];

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$unResto = getRestoByIdR($idR);
$lesTypesCuisine = getTypesCuisineByIdR($idR);
$lesPhotos = getPhotosByIdR($idR);
$noteMoy = round(getNoteMoyenneByIdR($idR), 0);
$mailU = getMailULoggedOn();
$aimer = getAimerById($mailU, $idR);
$critiques = getCritiquesByIdR($idR);

// traitement si necessaire des donnees recuperees
;

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "detail d'un restaurant";
include "vue/entete.html.php";
include "vue/vueDetailResto.php";
include "vue/pied.html.php";
?>