<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1 text-white">
            <i class="bi bi-arrow-left-right text-primary me-2"></i>Gestion des Emprunts
        </h2>
        <p class="text-secondary mb-0 small">Suivez les prêts de livres et enregistrez les retours facilement.</p>
    </div>
    <a href="<?= APP_URL ?>/emprunts/create" class="btn btn-primary-gradient rounded-pill px-4 py-2">
        <i class="bi bi-plus-circle me-1"></i> Nouvel Emprunt
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
                           placeholder="Filtrer par adhérent, titre de livre..." 
                           data-target-table="#empruntsTable"
                           data-count-badge="#empruntsCount">
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end gap-2 flex-wrap">
                <button type="button" class="filter-pill active" data-filter-group="status" data-filter-value="all" data-target-table="#empruntsTable">
                    Tous (<span id="empruntsCount"><?= count($emprunts ?? []) ?></span>)
                </button>
                <button type="button" class="filter-pill" data-filter-group="status" data-filter-value="en-cours" data-target-table="#empruntsTable">
                    <i class="bi bi-clock-history me-1 text-warning"></i> En cours
                </button>
                <button type="button" class="filter-pill" data-filter-group="status" data-filter-value="retourne" data-target-table="#empruntsTable">
                    <i class="bi bi-check-circle me-1 text-success"></i> Retournés
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Tableau sombre -->
<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="empruntsTable">
            <thead>
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th>Adhérent</th>
                    <th>Livre emprunté</th>
                    <th>Date d'emprunt</th>
                    <th>Date de retour</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($emprunts)): ?>
                    <?php foreach ($emprunts as $e): 
                        $isEnCours = empty($e['date_retour']);
                        $statusGroup = $isEnCours ? 'en-cours' : 'retourne';
                    ?>
                        <tr data-status="<?= $statusGroup ?>">
                            <td class="text-secondary fw-semibold">#<?= $e['id'] ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar" style="width: 32px; height: 32px; font-size: 0.85rem;">
                                        <?= strtoupper(substr($e['nom'], 0, 1)) ?>
                                    </div>
                                    <span class="fw-semibold text-white"><?= htmlspecialchars($e['nom'] . ' ' . $e['prenom']) ?></span>
                                </div>
                            </td>
                            <td>
                                <i class="bi bi-book text-secondary me-1"></i>
                                <span class="fw-medium text-light"><?= htmlspecialchars($e['titre']) ?></span>
                            </td>
                            <td>
                                <i class="bi bi-calendar3 text-secondary me-1 small"></i>
                                <?= htmlspecialchars($e['date_emprunt']) ?>
                            </td>
                            <td>
                                <?php if (!$isEnCours): ?>
                                    <i class="bi bi-calendar-check text-success me-1 small"></i>
                                    <?= htmlspecialchars($e['date_retour']) ?>
                                <?php else: ?>
                                    <span class="text-secondary">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($isEnCours): ?>
                                    <span class="badge badge-soft-warning">
                                        <i class="bi bi-hourglass-split me-1"></i> En cours
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-soft-success">
                                        <i class="bi bi-check2-circle me-1"></i> Retourné
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <?php if ($isEnCours): ?>
                                    <a href="<?= APP_URL ?>/emprunts/retourner/<?= $e['id'] ?>" 
                                       class="btn btn-sm btn-outline-success rounded-pill px-3">
                                        <i class="bi bi-arrow-return-left me-1"></i> Retourner
                                    </a>
                                <?php else: ?>
                                    <span class="text-secondary small"><i class="bi bi-check2 text-secondary me-1"></i> Clôturé</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5 text-secondary">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                            <span class="fs-6">Aucun emprunt enregistré pour le moment.</span>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
