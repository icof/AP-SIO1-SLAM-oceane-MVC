<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <!-- pour forcer le non-caching des pages par le navigateur -->
        <meta http-equiv='cache-control' content='no-cache'>
        <meta http-equiv='expires' content='0'>
        <meta http-equiv='pragma' content='no-cache'>
        <title><?php echo $titre ?></title>
        <link rel="icon" href="images/logoFavicon.png" type="image/x-icon"> <!-- Ajout du favicon -->
        <link rel="stylesheet" href="css/base.css">
        <link rel="stylesheet" href="css/form.css">
        <link rel="stylesheet" href="css/cgu.css">
        <link rel="stylesheet" href="css/corps.css">

        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

        

        <!-- bootstrap en version v5.2.3 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


    </head>
    <body>
        <nav>
        <ul id="menuGeneral">
            <li><a href="?action=accueil">Accueil</a></li> 
            <li><a href="?action=recherche"><img src="<?= $racine ?>/images/rechercher.png" alt="loupe" />Recherche</a></li>
            <li></li> 

            <li id="logo"><a href="?action=accueil"><img src="<?= $racine ?>/images/logoBarre.png" alt="logo" /></a></li>
            <li></li>

            <?php
            if (isLoggedOn()){
            ?>
                <li><a href="?action=deconnexion"><img src="<?= $racine ?>/images/profil.png" alt="loupe" />deconnexion</a></li>
                <li>
                    <a href="?action=profil">
                        <img src="<?= $racine ?>/images/profil.png" alt="loupe" />
                        Mon Profil
                    </a>
                </li>
            <?php
            }
            else {
            ?>
                <li><a href="?action=connexion"><img src="<?= $racine ?>/images/profil.png" alt="loupe" />Connexion</a></li>
            <?php
            }
            ?>
        </ul>
        </nav>
        <div id="bouton">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <ul id="menuContextuel">
            <li><img src="<?= $racine ?>/images/logoBarre.png" alt="logo" /></li>
            <?php if (isset($menuBurger)) { ?>
                <?php for ($i = 0; $i < count($menuBurger); $i++) { ?>
                    <li>
                        <a href="<?php echo $menuBurger[$i]['url']; ?>">
                            <?php echo $menuBurger[$i]['label']; ?>
                        </a>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>

        <div id="corps">