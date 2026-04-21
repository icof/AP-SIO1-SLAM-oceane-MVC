<form method="POST" action="?p=actionCRUDBateau&action=add" enctype="multipart/form-data" id="formAddBateau">
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-sm-2">
                <label class="control-label modal-label">Nom:</label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nomBateau" name="nom" required>
                <div id="nomFeedback" class="invalid-feedback" style="display:none;">
                    Ce nom de bateau existe déjà.
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-2">
                <label class="control-label modal-label">Niveau PMR:</label>
            </div>
            <div class="col-sm-10">
                <select name="niveauPMR" class="form-control" required>
                    <?php foreach ($lesNiveauxPMR as $niveau) : ?>
                        <option value="<?php echo $niveau['idNiveau']; ?>"><?php echo $niveau['libelle']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-2">
                <label class="control-label modal-label">Image:</label>
            </div>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="image" accept=".jpg, .jpeg, .png" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Annuler
        </button>
        <button type="submit" id="btnAddBateau" name="add" class="btn btn-primary">
            <i class="bi bi-download"></i> Enregistrer
        </button>
    </div>
</form>


<script>
    // Validation du nom de bateau en temps réel via requête AJAX
    $(document).ready(function() {
        var typingTimer;
        var delay = 300; // ms après la dernière frappe

        // Écouteur d'événement sur le champ de nom de bateau
        $('#nomBateau').on('input', function() {
            clearTimeout(typingTimer);
            var nom = $(this).val().trim();

            if (nom === '') {
                $('#nomBateau').removeClass('is-invalid is-valid');
                $('#nomFeedback').hide();
                $('#btnAddBateau').prop('disabled', false);
                return;
            }

            typingTimer = setTimeout(function() {
                $.ajax({
                    url: 'index.php?p=checkNomBateau',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        nom: nom
                    },
                    success: function(data) {
                        if (data.existe) {
                            $('#nomBateau').addClass('is-invalid').removeClass('is-valid');
                            $('#nomFeedback').show();
                            $('#btnAddBateau').prop('disabled', true);
                        } else {
                            $('#nomBateau').addClass('is-valid').removeClass('is-invalid');
                            $('#nomFeedback').hide();
                            $('#btnAddBateau').prop('disabled', false);
                        }
                    }
                });
            }, delay);
        });
    });
</script>