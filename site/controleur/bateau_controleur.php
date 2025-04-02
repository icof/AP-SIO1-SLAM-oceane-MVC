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

function ajouterBateau() {
    if (isset($_POST['ajouter'])) {
        $nom = $_POST['nom'];
        $niveauPMR = $_POST['niveauPMR'];
        $capacite = $_POST['capacite'];
        $image = $_FILES['image']['name'];

        // Déplacer le fichier téléchargé vers le répertoire de destination
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../images/' . $image);

        // Appeler la fonction pour ajouter le bateau
        insertBateau($nom, $niveauPMR, $capacite, $image);
    }

    // Retourner le chemin de la vue et les données
    return [
        'view' => __DIR__ . '/../vue/ajouter_bateau_vue.php',
        'data' => []
    ];
}

