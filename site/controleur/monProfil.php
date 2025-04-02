<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}

// inclusion des fichiers modele et fonctions
include_once "modele/authentification.inc.php";
include_once "modele/bd.utilisateur.inc.php";
include_once "modele/bd.typecuisine.inc.php";
include_once "modele/bd.resto.inc.php";

// creation du menu burger
$menuBurger = array();
$menuBurger[] = Array("url"=>"./?action=profil","label"=>"Consulter mon profil");
$menuBurger[] = Array("url"=>"./?action=updProfil","label"=>"Modifier mon profil");


// recuperation des donnees GET, POST, et SESSION

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
if (isLoggedOn()){
    $mailU = getMailULoggedOn();
    $util = getUtilisateurByMailU($mailU);
    
    $mesRestosAimes = getRestosAimesByMailU($mailU);

    $mesTypeCuisineAimes = getTypesCuisinePreferesByMailU($mailU);
    
    // appel du script de vue qui permet de gerer l'affichage des donnees
    $titre = "Mon profil";
    include "vue/entete.html.php";
    // var_dump($mesTypeCuisineAimes);
    include "vue/vueMonProfil.php";
    include "vue/pied.html.php";
}
else{
    $titre = "Erreur";
    include "vue/entete.html.php";
    include "vue/vueErreur.php";
    include "vue/pied.html.php";
}

?>