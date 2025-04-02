<?php
session_start();
include "configBdd.php"; // fichier de configuration de la base de données

// définition des variables de métadonnées
$title = "Compagnie Océane";
$keywords = "croisière, morbihan";
$description = "Bienvenue sur le site de la Compagnie Océane, votre partenaire pour des voyages en mer.";

if (isset($_GET['action'])) {
    $page = $_GET['action'];
    switch ($page) {
        case 'accueil':
        case '':
            // pas besoin de controleur pour la page d'accueil car elle est statique
            include "accueil_vue.php";
            break;
            
        case 'afficheBateau':
            // Appeler la fonction du contrôleur
            include_once "controleur/bateau_controleur.php";
            $response = afficherBateaux();
            $view = $response['view'];
            $data = $response['data'];

            // Extraire les données pour les rendre disponibles dans la vue
            extract($data);

            // Inclure la vue
            include $view;
            break;

        case 'modifierBateau':
            // Appeler la fonction du contrôleur
            include_once "controleur/bateau_controleur.php";
            $response = afficherCRUDBateaux();
            $view = $response['view'];
            $data = $response['data'];

            // Extraire les données pour les rendre disponibles dans la vue
            extract($data);

            // Inclure la vue
            include $view;
            break;
        
        case 'ajouterBateau':
            // Appeler la fonction du contrôleur
            include_once "controleur/bateau_controleur.php";
            $response = ajouterBateau();
            $view = $response['view'];
            $data = $response['data'];

            // Extraire les données pour les rendre disponibles dans la vue
            extract($data);

            // Inclure la vue
            include $view;
            break;
        default:
            echo "Vue non trouvée.";
            break;
    }
    
} else {
    include "vue/accueil_vue.php";
}
