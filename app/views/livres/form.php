<?php
$isEdit = isset($livre);
$actionUrl = $isEdit ? APP_URL . "/livres/update/" . $livre['id'] : APP_URL . "/livres/store";
?>

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0"><?= e($title) ?></h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="<?= $actionUrl ?>">
                    <div class="mb-3">
                        <label class="form-label">Titre du livre</label>
                        <input type="text" name="titre" class="form-control" required 
                               value="<?= e($livre['titre'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Auteur</label>
                        <input type="text" name="auteur" class="form-control" required 
                               value="<?= e($livre['auteur'] ?? '') ?>">
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Catégorie</label>
                            <input type="text" name="categorie" class="form-control" required 
                                   value="<?= e($livre['categorie'] ?? '') ?>" placeholder="Roman, Informatique...">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Année de publication</label>
                            <input type="number" name="annee" class="form-control" required 
                                   value="<?= e((string)($livre['annee'] ?? date('Y'))) ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Nombre d'exemplaires</label>
                            <input type="number" name="nb_exemplaires" min="0" class="form-control" required 
                                   value="<?= e((string)($livre['nb_exemplaires'] ?? 1)) ?>">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="<?= APP_URL ?>/livres" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>lace 