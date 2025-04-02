<?php
ob_start();
session_start();
$racine = basename(dirname(__FILE__)); // pour avoir le nom du répertoire racine (TP1)
$racine = "/$racine"; // pour avoir le chemin relatif à la racine du serveur
include "configBdd.php"; // fichier de configuration de la base de données
include "controleur/controleurPrincipal.php";
include_once "modele/authentification.inc.php"; // pour pouvoir utiliser isLoggedOn()

if (isset($_GET["action"])){
    $action = $_GET["action"];
}
else{
    
    $action = "defaut";
}

$fichier = controleurPrincipal($action);
include "controleur/$fichier";

?>
     