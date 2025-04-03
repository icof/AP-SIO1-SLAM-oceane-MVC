<div class="modal-body">
    <p class="text-center">Etes-vous sure de vouloir supprimer le bateau <?php echo $bateau['nom']; ?></p>
</div>
<div class="modal-footer">
    <form method="POST" action="?p=actionCRUDBateau&action=delete">
        <input type="hidden" class="form-control" name="id" value="<?php echo $bateau['id']; ?>">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Annuler
        </button>
        <button type="submit" name="supr" class="btn btn-danger">
            <i class="bi bi-download"></i> Enregistrer
        </button>
    </form>
</div>