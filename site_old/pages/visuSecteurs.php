<?php
	include_once('BDD/connectBdd.php'); // cette page a besoin d'inclure le code qui crée l'objet PDO $connexion qui permet d'interroger la BDD
?>
	
<h1 class="page-header text-center">Liste des destinations</h1>

<?php
	$SQL = "SELECT * FROM secteur";
	$stmt = $connexion->prepare($SQL);
	$stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
	$lesDestinations = $stmt->fetchAll();
?>

<p>Découvrez nos destinations insulaires.</p><br>
<div class="row row-cols-1 row-cols-md-1 g-4">
<?php
	foreach ($lesDestinations as $uneDestination){
	?>
		<div class="col">
			<div class="card">
				<img src="images/secteurs/<?= $uneDestination['photo'] ?>" class="img-fluid rounded-start" alt="photo de <?= $uneDestination['nom'] ?>">
				<div class="card-body">
					<h5 class="card-title"><?= $uneDestination['nom'] ?></h5>
					<p class="card-text"><?= $uneDestination['description'] ?>
				</div>
				<div class="card-footer">
					<p class="card-text"><small class="text-muted">Retrouvez toutes les informations pratiques sur le site <a href="https://<?= $uneDestination['url'] ?>" target="_blank"><?= $uneDestination['url'] ?></a></small></p>
				</div>
			</div>
		</div>
	<?php
	}
?>
</div>
