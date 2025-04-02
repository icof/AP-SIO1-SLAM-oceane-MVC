<div class="container-fluid">
	<a class="navbar-brand" href="index.php?">Accueil</a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	<ul class="navbar-nav me-auto mb-2 mb-lg-0">
		<li class="nav-item">
			<a class="nav-link" aria-current="page" href="index.php?action=afficheBateau">Navires</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php?action=affichePort">Gares maritimes</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="index.php?action=afficheSecteur">Destinations</a>
		</li>


		<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
			partie CRUD
		</a>
		<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
			<li>
				<a class="dropdown-item" href="index.php?action=modifieBateau">Modifier les bateaux</a>
			</li>
			<li>
				<a class="dropdown-item disabled" href="index.php?action=modifiePort" >Modifier les ports</a>
			</li>
		</ul>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" href="index.php?action=connexion" tabindex="-1" aria-disabled="true">connexion</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" href="index.php?action=deconnexion" tabindex="-1" aria-disabled="true">deconnexion</a>
		</li>
	</ul>
	</div>
</div>
