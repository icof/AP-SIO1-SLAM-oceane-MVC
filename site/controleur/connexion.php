<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "modele/authentification.inc.php";

// creation du menu burger
$menuBurger = array();
$menuBurger[] = Array("url"=>"./?action=connexion","label"=>"Connexion");
$menuBurger[] = Array("url"=>"./?action=inscription","label"=>"Inscription");

// recuperation des donnees GET, POST, et SESSION
if (!isset($_POST["mailU"]) || !isset($_POST["mdpU"])){
    // on affiche le formulaire de connexion
    $titre = "authentification";
    include "vue/entete.html.php";
    include "vue/vueAuthentification.php";
    include "vue/pied.html.php";
} else {
    $mailU=$_POST["mailU"];
    $mdpU=$_POST["mdpU"];
    login($mailU,$mdpU);
    if (isLoggedOn()){ 
        // si l'utilisateur est connecté on redirige vers le controleur monProfil
        include "controleur/monProfil.php";
    } else {
        // sinon on affiche le formulaire de connexion
        $titre = "authentification";
        include "vue/entete.html.php";
        include "vue/vueAuthentification.php";
        include "vue/pied.html.php";
    }
}

?>