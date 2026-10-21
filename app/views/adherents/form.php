<?php 
$isEdit = isset($adherent); 
$action = $isEdit ? "/adherents/update/{$adherent['id']}" : "/adherents/store";
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><?= $title ?></h4>
            </div>
            <div class="card-body">
                <form action="<?= $action ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="<?= $isEdit ? htmlspecialchars($adherent['nom']) : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="<?= $isEdit ? htmlspecialchars($adherent['prenom']) : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Classe</label>
                        <input type="text" name="classe" class="form-control" value="<?= $isEdit ? htmlspecialchars($adherent['classe']) : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="telephone" class="form-control" value="<?= $isEdit ? htmlspecialchars($adherent['telephone']) : '' ?>" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/adherents" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-success"><?= $isEdit ? 'Mettre à jour' : 'Enregistrer' ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>