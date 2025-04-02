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

