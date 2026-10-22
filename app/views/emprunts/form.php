<div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
        <div class="card shadow-md border-0">
            <div class="card-header bg-dark text-white p-4">
                <div class="d-flex align-items-center gap-2">
                    <span class="brand-icon" style="width: 36px; height: 36px; font-size: 1rem;">
                        <i class="bi bi-bookmark-plus"></i>
                    </span>
                    <div>
                        <h4 class="mb-0 fw-bold"><?= $title ?? 'Enregistrer un emprunt' ?></h4>
                        <small class="text-white-50">Attribuez un livre disponible à un adhérent</small>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="<?= APP_URL ?>/emprunts/store" method="POST">
                    <div class="mb-3">
                        <label for="adherent_id" class="form-label">
                            <i class="bi bi-person-fill text-primary me-1"></i> Adhérent bénéficiaire
                        </label>
                        <select name="adherent_id" id="adherent_id" class="form-select" required>
                            <option value="">-- Choisir un adhérent --</option>
                            <?php if (!empty($adherents)): ?>
                                <?php foreach ($adherents as $a): ?>
                                    <option value="<?= $a['id'] ?>">
                                        <?= htmlspecialchars($a['nom'] . ' ' . $a['prenom'] . ' (' . $a['classe'] . ')') ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="livre_id" class="form-label">
                            <i class="bi bi-book-half text-primary me-1"></i> Livre à emprunter
                        </label>
                        <select name="livre_id" id="livre_id" class="form-select" required>
                            <option value="">-- Choisir un livre --</option>
                            <?php if (!empty($livres)): ?>
                                <?php foreach ($livres as $l): ?>
                                    <option value="<?= $l['id'] ?>">
                                        <?= htmlspecialchars($l['titre'] . ' — ' . $l['auteur'] . ' (' . $l['disponibles'] . ' dispo)') ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="date_emprunt" class="form-label">
                            <i class="bi bi-calendar-event text-primary me-1"></i> Date d'emprunt
                        </label>
                        <input type="date" name="date_emprunt" id="date_emprunt" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-2">
                        <a href="<?= APP_URL ?>/emprunts" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-x-lg me-1"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary-gradient rounded-pill px-4 py-2">
                            <i class="bi bi-check2-circle me-1"></i> Valider l'emprunt
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
