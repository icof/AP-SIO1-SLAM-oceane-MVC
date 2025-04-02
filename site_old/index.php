


<?php 
include "template/header_vue.php";
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'accueil':
            include "controleur/produits_controleur.php";
            if (isset($_GET['cat'])) {
                $id = intval($_GET['cat']);
                afficherProduitsCategorie($id);
            } else {
                afficherProduits();
            }
            break;
        case 'c':
            include "controleur/commandes_controleur.php";
            if (isset($_GET['id'])) {
                $id_utilisateur = intval($_GET['id']);
                afficherCommandes($id_utilisateur);
            } else {
                echo "ID utilisateur non spécifié.";
            }
            break;
        default:
            echo "Vue non trouvée.";
            break;
    }
    
} else {
    echo "Aucune vue spécifiée.";
}
include "template/footer_vue.php";
