<?php
	include_once('BDD/connectBdd.php'); // cette page a besoin d'inclure le code qui crée l'objet PDO $connexion qui permet d'interroger la BDD
?>
	
<h1 class="page-header text-center">CRUD Bateaux</h1>
	<div class="row">
		<div class="row">
		<?php
			if(isset($_SESSION['error'])){
				?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?= $_SESSION['error'] ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php
				unset($_SESSION['error']);
			}
			if(isset($_SESSION['success'])){
				?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<?= $_SESSION['success'] ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php
				unset($_SESSION['success']);
			}
		?>
		</div>

		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addnew">
			Ajouter
		</button>
		<div class="height10">
		</div>
	</div>	
		
	<div class="row">
		<table id="myTable" class="table table-bordered table-striped">
			<thead>
				<th>identifiant</th>
				<th>nom</th>
				<th>photo</th>
				<th></th>
			</thead>
			<tbody>
				<?php
					
					include_once('BDD/connectBdd.php');
					$SQL = "SELECT * FROM bateau";
					$stmt = $connexion->prepare($SQL);
					$stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
					$lesBateaux = $stmt->fetchAll();
					foreach ($lesBateaux as $row){
						?>
						<tr>
							<td><?= $row['id'] ?></td>
							<td><?= $row['nom'] ?></td>
							<td><img height='100px' src='images/bateaux/<?= $row['photo'] ?>'></td>
							<td>
								<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit_<?= $row['id'] ?>">
									<i class="bi bi-pencil-square"></i> Modifier
								</button>
								<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_<?= $row['id'] ?>">
									<i class="bi bi-trash3"></i> Supprimer
								</button>
							</td>
						</tr>
						<?php
						include('crudBateau/edit_delete_modal.php');
					}
				?>
			</tbody>
		</table>
	</div>

<?php include('crudBateau/add_modal.php') ?>


<!-- generate datatable on our table -->
<script>
$(document).ready(function(){
	//inialize datatable
    $('#myTable').DataTable();
});
</script>
