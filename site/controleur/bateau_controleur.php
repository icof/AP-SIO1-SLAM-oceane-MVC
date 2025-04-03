<?php

include_once __DIR__ . '/../modele/bateau_modele.php';


function afficherBateaux() {
    $lesNiveauxPMR = getNiveauxAccessibilite();
    if ((isset($_POST['niveauPMR'])) && ($_POST['niveauPMR'] != "")){
        $niveauPMR = $_POST['niveauPMR'];
        $lesBateaux = getBateauxParNiveau($niveauPMR);
    } else {
        $lesBateaux = getTousLesBateaux();
    }
    
    // Retourner le chemin de la vue et les données
    return [
        'view' => __DIR__ . '/../vue/bateau_vue.php',
        'data' => [
            'lesNiveauxPMR' => $lesNiveauxPMR,
            'lesBateaux' => $lesBateaux
        ]
    ];
}

function afficherCRUDBateaux() {
    $lesBateaux = getTousLesBateaux();

    // Retourner le chemin de la vue et les données
    return [
        'view' => __DIR__ . '/../vue/bateau_CRUD_vue.php',
        'data' => [
            'lesBateaux' => $lesBateaux
        ]
    ];
}

function ChargerModale(string $action, ? string $id) {

    if ($id !== "") {
        $id = intval($id);
    }
    switch ($action) {
        case 'add':
            $view = __DIR__ . '/../vue/bateauCRUD/bateauCrudAddModale_vue.php';
            $data = [
                'bateau' => null,
                'lesNiveauxPMR' => getNiveauxAccessibilite()
            ];
            break;
        case 'edit':
            $view = __DIR__ . '/../vue/bateauCRUD/bateauCrudEditModale_vue.php';
            $data = [
                'bateau' => getBateauById($id),
                'lesNiveauxPMR' => getNiveauxAccessibilite()
            ];
            break;
        case 'delete':
            $view = __DIR__ . '/../vue/bateauCRUD/bateauCrudDeleteModale_vue.php';
            $data = [
                'bateau' => getBateauById($id)
            ];
            break;
        default:
            throw new Exception("Action non reconnue");
    }

    // Retourner le chemin de la vue et les données
    return [
        'view' => $view,
        'data' => $data
    ];

}

function ajouterBateau() {
    $nom = $_POST['nom'];
    $niveauPMR = $_POST['niveauPMR'];
    $image = $_FILES['image']['name'];

    // Déplacer le fichier téléchargé vers le répertoire de destination
    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../images/bateaux/' . $image);

    // Appeler la fonction pour ajouter le bateau
    $msg = insertBateau($nom, $niveauPMR, $image);
    afficherCRUDBateaux();

}

