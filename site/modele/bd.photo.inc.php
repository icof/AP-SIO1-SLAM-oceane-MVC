<?php
// inclusion des autres fichiers modele necessaires
include_once "bd.inc.php";

function getPhotosByIdR(int $idR) : array {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from photo where idR=:idR");
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


$includes = get_included_files();
// test si le premier include est la page appelée, permet dexecuter le fichier en local pour tester les fonctions
if ($includes[0] == __FILE__ ) {
    require_once "../configBdd.php"; // fichier de configuration de la base de données

    // prog principal de test
    header('Content-Type:text/plain');

    echo "\n getPhotosByIdR(1) : \n";
    print_r(getPhotosByIdR(1));

    echo "\n getPhotosByIdR(4) : \n";
    print_r(getPhotosByIdR(4));

}
?>