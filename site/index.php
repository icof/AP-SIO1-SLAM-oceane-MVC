<?php
session_start();
include "configBdd.php"; // fichier de configuration de la base de données

// définition des variables de métadonnées
$title = "Compagnie Océane";
$keywords = "croisière, morbihan";
$description = "Bienvenue sur le site de la Compagnie Océane, votre partenaire pour des voyages en mer.";

function chargerVue(array $response) {
    // Fonction pour charger une vue
    $vue = $response['view'];
    $data = $response['data'];

    // Vérifier si la vue existe
    if (!file_exists($vue)) {
        echo "Vue non trouvée.";
        return;
    }
    // Extraire les données pour les rendre disponibles dans la vue
    extract($data);
    // Inclure la vue
    include $vue;
}

if (isset($_GET['p'])) {
    $page = $_GET['p'];
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
            chargerVue($response);
            break;

        case 'afficherCRUDBateau':
            // Appeler la fonction du contrôleur
            include_once "controleur/bateau_controleur.php";
            $response = afficherCRUDBateaux();
            chargerVue($response);
            break;

        case 'chargerModaleBateau':
            // Appeler la fonction du contrôleur
            include_once "controleur/bateau_controleur.php";
            if (isset($_POST['action'])) {
                $action = $_POST['action'];
                $id = isset($_POST['id']) ? $_POST['id'] : null; // Récupérer l'ID du bateau (null si action = add);
                $response = ChargerModale($action, $id);
                chargerVue($response);
                
            } else {
                echo "Aucune action spécifiée.";
                exit;
            }
            break;

        case 'actionCRUDBateau':
            // Appeler la fonction du contrôleur
            include_once "controleur/bateau_controleur.php";
            switch ($_GET['action']) {
                case 'add':
                    ajouterBateau();
                    break;
                case 'edit':
                    $nom = $_POST['nom'];
                    $id = $_POST['id'];
                    modifierBateau($id, $nom);
                    break;
                case 'delete':
                    supprimerBateau();
                    break;
                default:
                    echo "Action non reconnue.";
                    break;
            }
            break;
        default:
            echo "Vue non trouvée.";
            break;
    }
    
} else {
    include "vue/accueil_vue.php";
}
