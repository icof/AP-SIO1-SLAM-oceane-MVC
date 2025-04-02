<?php
	include_once('BDD/connectBdd.php'); // cette page a besoin d'inclure le code qui crée l'objet PDO $connexion qui permet d'interroger la BDD

	
    $SQL = 'SELECT * FROM niveau_accessibilite'; 
    $stmt = $connexion->prepare($SQL);
    $stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
    $lesNiveauxPMR = $stmt->fetchAll(PDO::FETCH_ASSOC); // on met le resultat de la requete dans un tableau
    $stmt->closeCursor(); // on ferme le curseur des résultats
?>	
	
<h1 class="page-header text-center">Nos Navires</h1>
<p>Bienvenue à bord ! Découvrez notre flotte et les caractéristiques de nos différents ferries.</p><br>

<form method="post" action="index.php?action=afficheBateau">
    <div>
        <label for="niveauPMR">Niveau d'accessibilité :</label>
        <select name="niveauPMR">
		    <option value="">--sélectionner un niveau d'accessibilité--</option>
			<?php
			foreach ($lesNiveauxPMR as $unNiveauPMR) {
				$selected = "";
				if ((isset($_POST['niveauPMR'])) && ($_POST['niveauPMR']==$unNiveauPMR['idNiveau'])) {
					$selected = "selected";
				}
				echo '<option value="'.$unNiveauPMR['idNiveau'].'" '.$selected.'>'.$unNiveauPMR['libelle'].'</option>';
			}
			?>
	    </select>
    </div>
	<input type="submit" value="Afficher les navires" title="Afficher les navires" />
</form>

<br>

<?php
if ((isset($_POST['niveauPMR'])) && ($_POST['niveauPMR'] != "")){
	$niveauPMR = $_POST['niveauPMR'];
	$SQL = "SELECT * FROM bateau b JOIN niveau_accessibilite n ON b.niveauPMR=n.idNiveau WHERE b.niveauPMR = ? ORDER BY b.nom";
	$stmt = $connexion->prepare($SQL);
	$stmt->execute(array($niveauPMR)); // on passe dans le tableaux les paramètres si il y en a à fournir
	$lesBateaux = $stmt->fetchAll();
} else {
	$SQL = "SELECT * FROM bateau b JOIN niveau_accessibilite n ON b.niveauPMR=n.idNiveau  ORDER BY b.nom";
	$stmt = $connexion->prepare($SQL);
	$stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
	$lesBateaux = $stmt->fetchAll();
}?>


<div class="row">
	<table id="myTable" class="table table-bordered table-striped">
		<thead>
			<th>Nom du navire</th>
			<th>Photo</th>
			<th>Informations d'accessibilité</th>
		</thead>
		<tbody>
			<?php
				foreach ($lesBateaux as $unBateau){
				?>
					<tr>
						<td><?= $unBateau['nom'] ?></td>
						<td><img height='100px' src='images/bateaux/<?= $unBateau['photo'] ?>'></td>
						<td><?= $unBateau['descriptionAccessibilite'] ?></td>
					</tr>
				<?php
				}
			?>
		</tbody>
	</table>
</div>
