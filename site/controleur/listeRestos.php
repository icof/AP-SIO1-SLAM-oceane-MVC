<?php
// si le script est appelé directement (pour tests locaux), on redéfinit le chemin de la racine pour les inclusions
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}

// inclusion des fichiers modele et fonctions
include_once "modele/bd.resto.inc.php";

// recuperation des donnees GET, POST, et SESSION
;

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$lesRestos = getRestos();

// traitement si necessaire des donnees recuperees
;

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Liste des restaurants répertoriés";
include "vue/entete.html.php";
include "vue/vueListeRestos.php";
include "vue/pied.html.php";
?>