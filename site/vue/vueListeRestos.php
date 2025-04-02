<h1>Liste des restaurants</h1>

<div class="row row-cols-1 row-cols-md-3 g-4">
<?php
foreach ($lesRestos as $unResto) {
    ?>
    <div class="col">
        <div class="card h-100">
            <div class="card-img-top">
                <!-- place pour les photos -->
            </div>

            <div class="card-body">
                <h5 class="card-title"><?= $unResto['nomR'] ?></h5>
                <p class="card-text">
                    <?= $unResto["numAdrR"] ?>
                    <?= $unResto["voieAdrR"] ?>
                    <br />
                    <?= $unResto["cpR"] ?>
                    <?= $unResto["villeR"] ?>
                    <a href="?action=detail&idR=<?= $unResto['idR'] ?>" class="btn btn-primary">plus d'infos ...</a>
                </p>
            </div>
            <div class="card-footer">
                <ul id="tagFood">	
                    <!-- place pour la liste des types de cuisine -->
                </ul>
            </div>
        </div>
    </div>
    <?php
}
?>
</div>