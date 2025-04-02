<?php
	session_start(); // mécanisme utilisé pour la gestion des sessions pour les connexions
	include('routes.php');
?>

<!doctype html>
<html lang="fr">
<head>
 	<meta charset="utf-8" />
	<link rel="shortcut icon" href="skin/favicon.ico" />
	<link rel="icon" href="skin/favicon_anime.gif" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<meta name="description" content="<?php echo $description; ?>" />
	<meta name="robots" content="index,follow,all" />
	<title><?php echo $title; ?></title>
	
	<link href="css/style.css" rel="stylesheet" type="text/css" />

	<!-- bootstrap en version v5.2.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

	<!-- jquery en version v3.6.3  -->
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	
	
	<!-- datatable en version v1.13.1  -->
	<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" >
	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

	<!-- https://icons.getbootstrap.com/#usage bibliotheque d'icones bootstrap 5 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

</head>

<body>

	<header>
		<?php include('bandeau.php'); ?>
	</header>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<?php include('menu.php'); ?>
	</nav>

	<div class="container">
		<?php include($affiche); ?>
	</div>	

	<!-- Footer -->
	<footer class="page-footer font-small blue pt-4"">
		<?php include('pied_page.php'); ?>
	</footer>
	<!-- Footer -->

</body>
</html>