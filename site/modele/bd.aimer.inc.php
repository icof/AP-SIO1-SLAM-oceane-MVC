<?php
// inclusion des autres fichiers modele necessaires
include_once "bd.inc.php";

function getAimerByMailU(string $mailU) : array {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from aimer where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        
        $req->execute();
        
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getAimerByIdR(int $idR) : array{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from aimer where idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);

        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getAimerById(string $mailU, int $idR) : bool {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from aimer where mailU=:mailU and  idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);   
        $req->execute();
        $resultat = $req->rowCount();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function addAimer(string $mailU, int $idR) : bool {
    $resultat = 0;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("insert into aimer (mailU, idR) values(:mailU,:idR)");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        
        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function delAimer(string $mailU, int $idR) : bool {
    $resultat = 0;
    
    // completer le code manquant
 
    return $resultat;
}


// partie de code permettant de tester les fonctions en appelant le script de manière locale
$includes = get_included_files();
// test si le premier include est la page appelée, permet dexecuter le fichier en local pour tester les fonctions
if ($includes[0] == __FILE__ ) {
    require_once "../configBdd.php"; // fichier de configuration de la base de données
    
    // prog de test
    header('Content-Type:text/plain');
    
    echo "\n getAimerByMailU(\"mathieu.capliez@gmail.com\") : \n";
    print_r(getAimerByMailU("mathieu.capliez@gmail.com"));

    echo "\n getAimerByIdR(1) : \n";
    print_r(getAimerByIdR(1));

    echo "\n getAimerById(mailU, idR) : \n";
    print_r(getAimerById("mathieu.capliez@gmail.com", 1));
    
    echo "\n addAimer(\"mathieu.capliez@gmail.com\",7) : \n";
    print_r(addAimer("mathieu.capliez@gmail.com", 7));
}
?>