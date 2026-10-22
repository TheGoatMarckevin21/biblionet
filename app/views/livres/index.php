<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1 text-white">
            <i class="bi bi-journals text-primary me-2"></i>Gestion des Livres
        </h2>
        <p class="text-secondary mb-0 small">Gérez les titres, exemplaires et catégories de votre bibliothèque.</p>
    </div>
    <a href="<?= APP_URL ?>/livres/create" class="btn btn-primary-gradient rounded-pill px-4 py-2">
        <i class="bi bi-plus-circle me-1"></i> Nouveau Livre
    </a>
</div>

<!-- Barre d'outils interactive Sombre -->
<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body p-3">
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text border-end-0 text-secondary">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 table-live-search ps-0" 
                           placeholder="Filtrer en direct par titre, auteur, catégorie..." 
                           data-target-table="#livresTable"
                           data-count-badge="#livresCount">
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end gap-2 flex-wrap">
                <button type="button" class="filter-pill active" data-filter-group="dispo" data-filter-value="all" data-target-table="#livresTable">
                    Tous (<span id="livresCount"><?= count($livres) ?></span>)
                </button>
                <button type="button" class="filter-pill" data-filter-group="dispo" data-filter-value="disponible" data-target-table="#livresTable">
                    <i class="bi bi-check2 text-success me-1"></i> Disponibles
                </button>
                <button type="button" class="filter-pill" data-filter-group="dispo" data-filter-value="epuise" data-target-table="#livresTable">
                    <i class="bi bi-dash-circle text-danger me-1"></i> Indisponibles
                </button>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="livresTable">
            <thead>
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th style="width: 70px;">Image</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Catégorie</th>
                    <th>Année</th>
                    <th>Disponibilité</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livres as $l): 
                    $isDispo = ($l['disponibles'] > 0);
                    $dispoGroup = $isDispo ? 'disponible' : 'epuise';
                ?>
                <tr data-dispo="<?= $dispoGroup ?>">
                    <td class="text-secondary fw-semibold">#<?= e((string)$l['id']) ?></td>
                    <td>
                        <img src="<?= e(book_image($l['image'] ?? null, $l['titre'], $l['categorie'])) ?>" alt="" loading="lazy"
                             style="width: 44px; height: 60px; object-fit: cover; border-radius: 4px;">
                    </td>
                    <td class="fw-bold text-white"><?= e($l['titre']) ?></td>
                    <td>
                        <i class="bi bi-person text-secondary me-1"></i><?= e($l['auteur']) ?>
                    </td>
                    <td>
                        <span class="badge badge-soft-secondary"><?= e($l['categorie']) ?></span>
                    </td>
                    <td><?= e((string)$l['annee']) ?></td>
                    <td>
                        <span class="badge <?= $isDispo ? 'badge-soft-success' : 'badge-soft-danger' ?>">
                            <?= e((string)$l['disponibles']) ?> / <?= e((string)$l['nb_exemplaires']) ?> dispo
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="<?= APP_URL ?>/livres/edit/<?= e((string)$l['id']) ?>" 
                           class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1">
                            <i class="bi bi-pencil-square me-1"></i> Modifier
                        </a>
                        <a href="<?= APP_URL ?>/livres/delete/<?= e((string)$l['id']) ?>" 
                           class="btn btn-sm btn-outline-danger rounded-pill px-3"
                           data-confirm-message="Voulez-vous vraiment supprimer le livre « <?= e($l['titre']) ?> » ?">
                            <i class="bi bi-trash3 me-1"></i> Supprimer
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
