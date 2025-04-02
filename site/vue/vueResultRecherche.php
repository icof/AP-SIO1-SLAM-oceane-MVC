<h1>Liste des restaurants</h1>

<?php
foreach ($listeRestos as $unResto) {
    ?>
    <div class="card">
        <div class="descrCard"><?php echo "<a href='./?action=detail&idR=" . $unResto['idR'] . "'>" . $unResto['nomR'] . "</a>"; ?>
            <br />
            <?= $unResto["numAdrR"] ?>
            <?= $unResto["voieAdrR"] ?>
            <br />
            <?= $unResto["cpR"] ?>
            <?= $unResto["villeR"] ?>
        </div>
        <div class="tagCard">
            <ul id="tagFood">		
            </ul>
        </div>
    </div>
    <?php
}
?>