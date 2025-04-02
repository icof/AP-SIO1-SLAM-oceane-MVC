<?php
// si le script est appelé directement (pour tests locaux), on redéfinit le chemin de la racine pour les inclusions
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}

// inclusion des fichiers modele et fonctions
include_once "modele/bd.aimer.inc.php";
include_once "modele/bd.critiquer.inc.php";


// recuperation des donnees GET, POST, et SESSION
/** completer le code ici **/
    // valoriser les variables $idR et $note avec les données transmises par la route d'appel

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
/** completer le code ici **/
    // recupérer le mail de l'utilisateur connecté
    // si l'utilisateur n'est pas connecté, on ne fait rien, sinon on ajoute la note en appelant la fonction addNote() avec les paramètres récupérés


// redirection vers le referer
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>