<?php
// inclusion des autres fichiers modele necessaires
include_once "bd.inc.php"; // fichier de connexion à la base de données

function getNiveauxAccessibilite() : array {
    $connexion = getPDO(); // Utilisation de la connexion à la base de données
    $SQL = 'SELECT * FROM niveau_accessibilite';
    $stmt = $connexion->prepare($SQL);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}

function getBateauxParNiveau($niveauPMR) : array {
    $connexion = getPDO(); // Utilisation de la connexion à la base de données
    $SQL = "SELECT * FROM bateau b JOIN niveau_accessibilite n ON b.niveauPMR=n.idNiveau WHERE b.niveauPMR = ? ORDER BY b.nom";
    $stmt = $connexion->prepare($SQL);
    $stmt->execute([$niveauPMR]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}

function getTousLesBateaux() : array {
    $connexion = getPDO(); // Utilisation de la connexion à la base de données
    $SQL = "SELECT * FROM bateau b JOIN niveau_accessibilite n ON b.niveauPMR=n.idNiveau ORDER BY b.nom";
    $stmt = $connexion->prepare($SQL);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}

function getBateauById(int $idBateau) : array {
    $connexion = getPDO(); // Utilisation de la connexion à la base de données
    $SQL = "SELECT * FROM bateau b JOIN niveau_accessibilite n ON b.niveauPMR=n.idNiveau WHERE b.id = :idBateau";
    $stmt = $connexion->prepare($SQL);
    $stmt->bindParam(':idBateau', $idBateau, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
}
?>