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

function insertBateau(string $nom, int $niveauPMR, int $capacite, string $image) : string{
    try {
        // Insertion du bateau dans la base de données
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        // Récupérer le dernier ID et calculer le nouvel ID
        $SQL = "SELECT MAX(id) FROM bateau";
        $stmt = $connexion->prepare($SQL);
        $stmt->execute();
        $lastId = $stmt->fetch();
        $newId = (int)$lastId[0] + 1;

        $SQL = "INSERT INTO bateau (id, nom, niveauPMR, capacite, image) VALUES (:id, :nom, :niveauPMR, :capacite, :image)";
        $stmt = $connexion->prepare($SQL);
        $stmt->bindParam(':id', $newId, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':niveauPMR', $niveauPMR, PDO::PARAM_INT);
        $stmt->bindParam(':capacite', $capacite, PDO::PARAM_INT);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
        return "Bateau ajouté avec succès !";
    } catch (Exception $e) {
        return "Erreur lors de l'ajout du bateau : " . $e->getMessage();
    }
}

function updateBateau(int $id, string $nom, int $niveauPMR, int $capacite, string $image) : string {
    try {
        // Mise à jour du bateau dans la base de données
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $SQL = "UPDATE bateau SET nom = :nom, niveauPMR = :niveauPMR, capacite = :capacite, image = :image WHERE id = :id";
        $stmt = $connexion->prepare($SQL);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':niveauPMR', $niveauPMR, PDO::PARAM_INT);
        $stmt->bindParam(':capacite', $capacite, PDO::PARAM_INT);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
        return "Bateau mis à jour avec succès !";
    } catch (Exception $e) {
        return "Erreur lors de la mise à jour du bateau : " . $e->getMessage();
    }
}

function deleteBateau(int $id) : string {
    try {
        // Suppression du bateau dans la base de données
        $connexion = getPDO(); // Utilisation de la connexion à la base de données
        $SQL = "DELETE FROM bateau WHERE id = :id";
        $stmt = $connexion->prepare($SQL);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return "Bateau supprimé avec succès !";
    } catch (Exception $e) {
        return "Erreur lors de la suppression du bateau : " . $e->getMessage();
    }
}
