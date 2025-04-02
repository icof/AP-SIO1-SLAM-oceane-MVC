<h1><?= $unResto['nomR']; ?>
    <span id="aimer">
        <?php if ($aimer != false) { ?>
            <a href="?action=aimer&idR=<?= $unResto['idR']; ?>" ><img class="aimer" src="images/aime.png" alt="j'aime ce restaurant"></a>
        <?php } else { ?>
            <a href="?action=aimer&idR=<?= $unResto['idR']; ?>" ><img class="aimer" src="images/aimepas.png" alt="je n'aime pas encore ce restaurant"></a>
        <?php } ?>
    </span>
</h1>

<span id="note">
    <?php for ($i = 1; $i <= 5; $i++) { ?>
        <a class="aimer" href="./?action=noter&note=<?= $i ?>&idR=<?= $unResto['idR']; ?>" >
            <?php if ($i <= $noteMoy) { ?>
                <img class="note" src="images/like.png" alt="">
            <?php } else {
                ?>
                <img class="note" src="images/neutre.png" alt="line neutre">
            <?php } ?>
        </a>
    <?php } ?>
</span>

<section>
    Cuisine <br />
    <ul id="tagFood">		
        <?php foreach ($lesTypesCuisine as $unTypeCuisine) { ?>
            <li class="tag"><span class="tag">#</span><?= $unTypeCuisine["libelleTC"] ?></li>
        <?php } ?>
    </ul>
</section>

<p id="principal">
    <?php if (count($lesPhotos) > 0) { ?>
        <img src="photos/<?= $lesPhotos[0]["cheminP"] ?>" alt="photo du restaurant" />
    <?php } ?>
    <br />
    <?= $unResto['descR']; ?>
</p>
<h2 id="adresse">Adresse</h2>
<p>
    <?= $unResto['numAdrR']; ?>
    <?= $unResto['voieAdrR']; ?><br />
    <?= $unResto['cpR']; ?>
    <?= $unResto['villeR']; ?>

</p>

<h2 id="photos">Photos</h2>
<ul id="galerie">
    <?php foreach ($lesPhotos as $unePhoto) { ?>
        <li> <img class="galerie" src="photos/<?= $unePhoto["cheminP"] ?>" alt="" /></li>
    <?php } ?>
</ul>

<h2 id="horaires">Horaires</h2> 
<?= $unResto['horairesR']; ?>
<br/>

<h2 id="crit">Critiques</h2>
<ul id="critiques">
    <?php foreach ($critiques as $uneCritique) { ?>
        <li>
            <span>
                <?= $uneCritique["mailU"] ?> 
                <?php if ($uneCritique["mailU"] == $mailU) { ?>
                    <a href='./?action=supprimerCritique&idR=<?= $unResto['idR']; ?>'>Supprimer</a>
                <?php } ?>
            </span>
            <div>
                <span>
                    <?php
                    if ($uneCritique["note"]) {
                        echo $uneCritique["note"] . "/5";
                    }
                    ?>
                </span>
                <span><?= $uneCritique["commentaire"] ?> </span>
            </div>

        </li>
    <?php } ?>

</ul>
