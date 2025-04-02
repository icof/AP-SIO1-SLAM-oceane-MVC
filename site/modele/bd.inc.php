<?php

function connexionPDO() : PDO{
    $login = $_ENV["username"];
    $mdp = $_ENV["password"];
    $dsn = $_ENV["dsn"];

    try {
        $cnx = new PDO($dsn, $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $cnx;
    } catch (PDOException $e) {
        print "Erreur de connexion PDO ";
        die();
    }
}


// partie de code permettant de tester les fonctions en appelant le script de manière locale
$includes = get_included_files();
// test si le premier include est la page appelée, permet dexecuter le fichier en local pour tester les fonctions
if ($includes[0] == __FILE__ ) {
    require_once "../configBdd.php"; // fichier de configuration de la base de données
    
    // prog de test
    header('Content-Type:text/plain');

    echo "connexionPDO() : \n";
    print_r(connexionPDO());
}
?>
