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
                <form method="POST" action="<?= $actionUrl ?>" enctype="multipart/form-data">
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

                    <div class="mb-3">
                        <label class="form-label">Image de couverture <small class="text-secondary">(JPG, PNG ou WebP, 2 Mo max)</small></label>
                        <?php if (!empty($livre['image'])): ?>
                            <div class="mb-2">
                                <img src="<?= e(book_image($livre['image'])) ?>" alt="Couverture actuelle"
                                     style="height: 140px; border-radius: 8px; object-fit: cover;">
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="remove_image">
                                <label class="form-check-label" for="remove_image">Supprimer l'image actuelle</label>
                            </div>
                        <?php endif; ?>
                        <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="<?= APP_URL ?>/livres" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 