<div class="row justify-content-center">
<div class="col-md-6">
<div class="card shadow-sm border-0">
<div class="card-body p-4">
<h2 class="mb-4 fw-bold"><?= isset($livre) ? 'Modifier l\'ouvrage' : 'Ajouter un nouvel ouvrage' ?></h2>
<form action="<?= APP_URL ?>/livres/<?= isset($livre) ? 'update/' . $livre['id'] : 'store' ?>" method="POST">
<div class="mb-3"><label class="form-label">Titre</label><input type="text" name="titre" class="form-control" value="<?= e($livre['titre'] ?? '') ?>" required></div>
<div class="mb-3"><label class="form-label">Auteur</label><input type="text" name="auteur" class="form-control" value="<?= e($livre['auteur'] ?? '') ?>" required></div>
<div class="mb-3"><label class="form-label">Catégorie</label><input type="text" name="categorie" class="form-control" value="<?= e($livre['categorie'] ?? '') ?>" required></div>
<div class="row">
<div class="col-md-6 mb-3"><label class="form-label">Année</label><input type="number" name="annee" class="form-control" value="<?= e((string)($livre['annee'] ?? date('Y'))) ?>" required></div>
<div class="col-md-6 mb-3"><label class="form-label">Nombre d'exemplaires</label><input type="number" name="nb_exemplaires" class="form-control" value="<?= e((string)($livre['nb_exemplaires'] ?? 1)) ?>" min="1" required></div>
</div>
<div class="d-flex justify-content-between mt-4">
<a href="<?= APP_URL ?>/livres" class="btn btn-outline-secondary">Annuler</a>
<button type="submit" class="btn btn-primary"><?= isset($livre) ? 'Mettre à jour' : 'Enregistrer' ?></button>
</div>
</form>
</div>
</div>
</div>
</div>
