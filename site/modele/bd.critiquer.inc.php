<?php
// inclusion des autres fichiers modele necessaires
include_once "bd.inc.php";

function getCritiquesByIdR(int $idR) : array {
    $resultat = array();
    
    // completer le code manquant
 
    return $resultat;
}

function addCritique(int $idR, string $mailU, string $commentaire, int $note) : void {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("insert into critiquer (idR, mailU, commentaire, note) values (:idR, :mailU, :commentaire, :note)");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
        $req->bindValue(':note', $note, PDO::PARAM_INT);

        $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function delCritique(int $idR, string $mailU) : void {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("delete from critiquer where idR=:idR and mailU=:mailU");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);

        $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function getNoteMoyenneByIdR(int $idR) : float {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select avg(note) as score from critiquer where idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    if ($resultat["score"] != NULL) {
        return $resultat["score"];
    } else {
        return 0;
    }
}

function addNote(int $idR, string $mailU, int $note) : bool {
    $resultat = 0;
    try {
        $cnx = connexionPDO();
        /** Completer le code manquant **/
        
        // on utilise ON DUPLICATE KEY UPDATE pour mettre à jour la note si la combinaison idR, mailU existe déjà

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    } 
    return $resultat;
}


// partie de code permettant de tester les fonctions en appelant le script de manière locale
$includes = get_included_files();
// test si le premier include est la page appelée, permet dexecuter le fichier en local pour tester les fonctions
if ($includes[0] == __FILE__ ) {
    require_once "../configBdd.php"; // fichier de configuration de la base de données
    
    // prog de test
    header('Content-Type:text/plain');
 
    echo "\n getNoteMoyenneByIdR(1) \n";
    print_r(getNoteMoyenneByIdR(1));
}
?>