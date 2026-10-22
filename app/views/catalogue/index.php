<<<<<<< HEAD
<div class="p-4 mb-4 bg-dark text-white rounded-3 shadow-sm">
    <div class="container-fluid py-2">
        <h1 class="display-6 fw-bold">📚 Catalogue public BiblioNet</h1>
        <p class="col-md-8 fs-6 mb-3">Consultez en temps réel la disponibilité des ouvrages de notre bibliothèque.</p>
        
        <form method="GET" action="<?= APP_URL ?>/catalogue" class="row g-2">
            <div class="col-md-8">
                <input type="text" name="q" class="form-control form-control-lg" 
                       placeholder="Rechercher par titre ou par auteur..." 
                       value="<?= e($search ?? '') ?>">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-lg flex-grow-1">🔍 Rechercher</button>
                <?php if (!empty($search)): ?>
                    <a href="<?= APP_URL ?>/catalogue" class="btn btn-outline-light btn-lg">Réinitialiser</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 text-muted">
        <?= count($livres) ?> ouvrage(s) trouvé(s)
        <?= !empty($search) ? ' pour « ' . e($search) . ' »' : '' ?>
    </h5>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($livres as $l): ?>
    <div class="col">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="badge bg-secondary"><?= e($l['categorie']) ?></span>
                    <small class="text-muted"><?= e((string)$l['annee']) ?></small>
                </div>
                <h5 class="card-title fw-bold"><?= e($l['titre']) ?></h5>
                <p class="card-text text-muted mb-4">Par <strong><?= e($l['auteur']) ?></strong></p>
                
                <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                    <?php if ($l['disponibles'] > 0): ?>
                        <span class="badge bg-success fs-6">
                            ✔ Disponible (<?= e((string)$l['disponibles']) ?> / <?= e((string)$l['nb_exemplaires']) ?>)
                        </span>
                    <?php else: ?>
                        <span class="badge bg-danger fs-6">
                            ✖ Indisponible (0 / <?= e((string)$l['nb_exemplaires']) ?>)
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
=======
<div class="p-5 mb-4 bg-white rounded-3 shadow-sm">
    <h1 class="display-5 fw-bold">Bienvenue sur BiblioNet</h1>
    <p class="fs-4">Le socle MVC et la base de données sont opérationnels !</p>
    <span class="badge bg-success fs-6">Livres en base : <?= e((string)$nbLivres) ?></span>
>>>>>>> e077a350f33c36a7ed5e99e172b68f9a5c5c62db
</div>