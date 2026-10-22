<!-- Bannière Hero moderne Sombre -->
<div class="hero-banner text-white mb-4">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <span class="badge bg-primary bg-opacity-75 mb-2 px-3 py-2 rounded-pill">
                <i class="bi bi-stars me-1"></i> Portail de Recherche
            </span>
            <h1 class="display-6 fw-bold mb-2">Catalogue en ligne de BiblioNet</h1>
            <p class="text-white-50 mb-4 fs-6">Consultez en temps réel les ouvrages disponibles et leur statut d'emprunt.</p>
            
            <form method="GET" action="<?= APP_URL ?>/catalogue" class="row g-2">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text border-0 ps-3">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="q" class="form-control form-control-lg border-0 ps-1" 
                               placeholder="Titre, auteur (ex: 1984, Camus...)" 
                               value="<?= e($search ?? '') ?>"
                               style="border-radius: 0 50px 50px 0;">
                    </div>
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary-gradient btn-lg rounded-pill flex-grow-1">
                        Rechercher
                    </button>
                    <?php if (!empty($search)): ?>
                        <a href="<?= APP_URL ?>/catalogue" class="btn btn-outline-light btn-lg rounded-pill" title="Réinitialiser">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="col-lg-4 d-none d-lg-block text-center">
            <i class="bi bi-book-half" style="font-size: 7rem; opacity: 0.2;"></i>
        </div>
    </div>
</div>

<!-- En-tête des résultats -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h6 class="mb-0 text-secondary fw-semibold">
        <i class="bi bi-journal-bookmark me-1 text-primary"></i>
        <?= count($livres) ?> ouvrage(s) répertorié(s)
        <?= !empty($search) ? ' pour « <span class="text-white">' . e($search) . '</span> »' : '' ?>
    </h6>
</div>

<!-- Grille des Livres Sombre -->
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php foreach ($livres as $l): ?>
    <div class="col">
        <div class="card h-100 card-hover-effect">
            <img src="<?= e(book_image($l['image'] ?? null, $l['titre'], $l['categorie'])) ?>" alt="Couverture de <?= e($l['titre']) ?>"
                 class="card-img-top" loading="lazy" style="height: 260px; object-fit: cover;">
            <div class="card-body d-flex flex-column p-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge badge-soft-info">
                        <?= e($l['categorie']) ?>
                    </span>
                    <small class="text-secondary fw-medium">
                        <i class="bi bi-calendar-event me-1"></i><?= e((string)$l['annee']) ?>
                    </small>
                </div>
                
                <h5 class="card-title fw-bold text-white mt-2 mb-1"><?= e($l['titre']) ?></h5>
                <p class="text-secondary small mb-4">
                    <i class="bi bi-person me-1"></i> Par <strong class="text-light"><?= e($l['auteur']) ?></strong>
                </p>
                
                <div class="mt-auto pt-3 border-top border-secondary border-opacity-25 d-flex justify-content-between align-items-center">
                    <?php if ($l['disponibles'] > 0): ?>
                        <span class="badge badge-soft-success">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            <?= e((string)$l['disponibles']) ?> / <?= e((string)$l['nb_exemplaires']) ?> dispo
                        </span>
                    <?php else: ?>
                        <span class="badge badge-soft-danger">
                            <i class="bi bi-x-circle-fill me-1"></i>
                            Indisponible (0 / <?= e((string)$l['nb_exemplaires']) ?>)
                        </span>
                    <?php endif; ?>

                    <span class="text-secondary small">
                        #<?= e((string)$l['id']) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>