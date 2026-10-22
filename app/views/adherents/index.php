<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1 text-white">
            <i class="bi bi-people-fill text-primary me-2"></i>Gestion des Adhérents
        </h2>
        <p class="text-secondary mb-0 small">Consultez et administrez les membres inscrits à la bibliothèque.</p>
    </div>
    <a href="<?= APP_URL ?>/adherents/create" class="btn btn-primary-gradient rounded-pill px-4 py-2">
        <i class="bi bi-person-plus me-1"></i> Nouvel Adhérent
    </a>
</div>

<!-- Barre de recherche temps réel Sombre -->
<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body p-3">
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text border-end-0 text-secondary">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 table-live-search ps-0" 
                           placeholder="Filtrer par nom, prénom, classe, téléphone..." 
                           data-target-table="#adherentsTable"
                           data-count-badge="#adherentsCount">
                </div>
            </div>
            <div class="col-md-6 text-md-end text-secondary small">
                Total : <strong id="adherentsCount" class="text-primary"><?= count($adherents ?? []) ?></strong> adhérent(s)
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="adherentsTable">
            <thead>
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th>Nom & Prénom</th>
                    <th>Classe / Promo</th>
                    <th>Téléphone</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($adherents)): ?>
                    <?php foreach ($adherents as $a): ?>
                        <tr>
                            <td class="text-secondary fw-semibold">#<?= $a['id'] ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar" style="width: 34px; height: 34px; font-size: 0.85rem;">
                                        <?= strtoupper(substr($a['nom'], 0, 1)) ?>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-white"><?= htmlspecialchars($a['nom']) ?> <?= htmlspecialchars($a['prenom']) ?></div>
                                        <small class="text-secondary">Membre BiblioNet</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-soft-info">
                                    <i class="bi bi-mortarboard me-1"></i><?= htmlspecialchars($a['classe']) ?>
                                </span>
                            </td>
                            <td>
                                <i class="bi bi-telephone text-secondary me-1 small"></i>
                                <?= htmlspecialchars($a['telephone']) ?>
                            </td>
                            <td class="text-end">
                                <a href="<?= APP_URL ?>/adherents/edit/<?= $a['id'] ?>" 
                                   class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1">
                                    <i class="bi bi-pencil-square me-1"></i> Modifier
                                </a>
                                <a href="<?= APP_URL ?>/adherents/delete/<?= $a['id'] ?>" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                   data-confirm-message="Supprimer définitivement l'adhérent <?= htmlspecialchars($a['nom'] . ' ' . $a['prenom']) ?> ?">
                                    <i class="bi bi-trash3 me-1"></i> Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-secondary">
                            <i class="bi bi-people fs-1 d-block mb-2 text-secondary"></i>
                            <span class="fs-6">Aucun adhérent enregistré.</span>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
