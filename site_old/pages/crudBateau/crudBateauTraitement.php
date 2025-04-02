<?php
	include_once('BDD/connectBdd.php'); // cette page a besoin d'inclure le code qui crée l'objet PDO $connexion qui permet d'interroger la BDD

	if(isset($_POST['add'])){
		$nom = $_POST['nom'];
		$SQL = "SELECT max(id) FROM bateau";
			$stmt = $connexion->prepare($SQL);
			$stmt->execute();
			$lastId = $stmt->fetch();
			$newId = (int)$lastId[0] +1; // on lit la case du tableau de résultat
		$req = $connexion->prepare('INSERT INTO bateau (id, nom) VALUES (:id, :nom)');
		$req->bindParam(':id', $newId, PDO::PARAM_INT);
		$req->bindParam(':nom', $nom, PDO::PARAM_STR);
		$resultat = $req->execute();
		if($resultat){
			$_SESSION["success"] = 'Bateau ajouté';
		}
		else{
			$_SESSION["error"] = 'Problème lors de l\'ajout du bateau';
		}
	}
	
	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$nom = $_POST['nom'];		
		$req = $connexion->prepare('UPDATE bateau SET nom = :nom WHERE id = :id');
		$req->bindParam(':nom', $nom, PDO::PARAM_STR);
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$resultat = $req->execute();

		if($resultat){
			$_SESSION['success'] = 'Bateau modifié';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la modification du bateau';
		}
	}
	
	if(isset($_POST['supr'])){
		$id = $_POST['id'];
		$req = $connexion->prepare('DELETE FROM bateau WHERE id = :id ');
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$resultat = $req->execute();
		if($resultat){
			$_SESSION['success'] = 'Bateau supprimé';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la suppression du bateau';
		}
	}

	// Redirection avec JavaScript
	echo '<script type="text/javascript">
		window.location.href = "index.php?action=modifieBateau";
	</script>';
	exit; // le script s'arrête ici

	?>