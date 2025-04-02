
<h1>Mon profil</h1>

Mon adresse électronique : <?= $util["mailU"] ?> <br />
Mon pseudo : <?= $util["pseudoU"] ?> <br />

<hr>

les restaurants que j'aime : <br>
    <?php foreach ($mesRestosAimes as $unResto) { ?>
        <a href="?action=detail&idR=<?= $unResto["idR"] ?>"><?= $unResto["nomR"] ?></a><br>
    <?php } ?>
<hr>
les types de cuisine que j'aime : 
<ul id="tagFood">
    <?php foreach ($mesTypeCuisineAimes as $unTypeCuisine) { ?>
        <li class="tag"><span class="tag">#</span><?= $unTypeCuisine["libelleTC"] ?></li>
    <?php } ?>
</ul>
<hr>
<a href="?action=deconnexion">se deconnecter</a>


