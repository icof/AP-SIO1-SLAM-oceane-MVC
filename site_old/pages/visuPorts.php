<?php
	include_once('BDD/connectBdd.php'); // cette page a besoin d'inclure le code qui crée l'objet PDO $connexion qui permet d'interroger la BDD
?>
	
<h1 class="page-header text-center">Liste des gares maritimes</h1>

<?php
	$SQL = "SELECT * FROM port";
	$stmt = $connexion->prepare($SQL);
	$stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
	$lesPorts = $stmt->fetchAll();
?>

<p>Découvrez les gares d'embarquements de nos traversées.</p><br>
<div class="row row-cols-1 row-cols-md-3 g-4">
<?php
	foreach ($lesPorts as $unPort){
	?>
		<div class="col">
			<div class="card">
				<img src="images/ports/<?= $unPort['photo'] ?>" class="img-fluid rounded-start" alt="photo du port de <?= $unPort['nom_court'] ?>">
				<div class="card-body">
					<h5 class="card-title"><?= $unPort['nom'] ?></h5>
					<p class="card-text"><?= $unPort['description'] ?>
					<p class="card-text"><small class="text-muted">Adresse : <?= $unPort['adresse'] ?></small></p>
					<p class="card-text"><small class="text-muted"><a href="<?= $unPort['camera'] ?>" target="_blank">Voir la caméra</a> </small></p>
				</div>
			</div>
		</div>
	<?php
	}
?>
</div>
