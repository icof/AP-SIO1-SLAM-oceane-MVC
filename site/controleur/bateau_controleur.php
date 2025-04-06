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
    $niveauPMR = intval($_POST['niveauPMR']);
    $image = $_FILES['image'];

    // Vérifier si un fichier a été uploadé
    if ($image['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../images/bateaux/';
        $uploadFile = $uploadDir . basename($image['name']);

        // Déplacer le fichier uploadé
        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            // Appeler le modèle pour insérer le bateau
            $msg = insertBateau($nom, $niveauPMR, $image['name']);

            $_SESSION[$msg['status']] = $msg['message'];
        } else {
            $_SESSION['error'] = "Erreur lors du déplacement du fichier.";
        }
    } else {
        $_SESSION['error'] = "Erreur lors de l'upload de l'image.";
    }


    // Rediriger vers la page CRUD
    header('Location: ?p=afficherCRUDBateau');
    exit;
}

function modifierBateau() {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $niveauPMR = $_POST['niveauPMR'];
    $ancienneImage = $_POST['imageOld'];

    // Vérifier si une nouvelle image a été téléchargée
    if ($_FILES['image']['name'] != "") {
        $image = $_FILES['image']['name'];
        // Déplacer le fichier téléchargé vers le répertoire de destination
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../images/bateaux/' . $image);
        // Supprimer l'ancienne image du répertoire
        if (file_exists(__DIR__ . '/../images/bateaux/' . $ancienneImage)) {
            unlink(__DIR__ . '/../images/bateaux/' . $ancienneImage);
        }
    } else {
        // Si aucune nouvelle image n'a été téléchargée, conserver l'ancienne image
        $bateau = getBateauById($id);
        $image = $bateau['photo'];
    }

    // Appeler la fonction pour modifier le bateau
    $msg = updateBateau($id, $nom, $niveauPMR, $image);
    $_SESSION[$msg['status']] = $msg['message'];
    //redirection vers la page de gestion des bateaux
    header('Location: index.php?p=afficherCRUDBateau');
    exit();
}

function supprimerBateau() {
    $id = $_POST['id'];
    $bateau = getBateauById($id);
    $image = $bateau['photo'];

    // Supprimer l'image du répertoire
    if (file_exists(__DIR__ . '/../images/bateaux/' . $image)) {
        unlink(__DIR__ . '/../images/bateaux/' . $image);
    }

    // Appeler la fonction pour supprimer le bateau
    $msg = deleteBateau($id);
    $_SESSION[$msg['status']] = $msg['message'];
    //redirection vers la page de gestion des bateaux
    header('Location: index.php?p=afficherCRUDBateau');
    exit();
}

