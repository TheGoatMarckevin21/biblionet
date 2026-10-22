<div class="row justify-content-center mt-4">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow-lg border-0 overflow-hidden">
            <div class="card-header bg-dark text-white text-center py-4">
                <div class="brand-icon mx-auto mb-2" style="width: 48px; height: 48px; font-size: 1.4rem;">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h4 class="mb-1 fw-bold">Espace Bibliothécaire</h4>
                <p class="text-white-50 small mb-0">Connectez-vous pour administrer BiblioNet</p>
            </div>
            <div class="card-body p-4">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger d-flex align-items-center rounded-3 mb-3">
                        <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                        <div><?= e($error) ?></div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= APP_URL ?>/auth/login">
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope text-primary me-1"></i> Adresse Email
                        </label>
                        <input type="email" name="email" id="email" class="form-control" required placeholder="agent.biblio@biblionet.com">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">
                            <i class="bi bi-key text-primary me-1"></i> Mot de passe
                        </label>
                        <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••">
                    </div>

                    <button type="submit" class="btn btn-primary-gradient w-100 py-2 rounded-pill fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Se connecter
                    </button>
                </form>

                <div class="text-center mt-4 pt-3 border-top border-secondary border-opacity-25">
                    <a href="<?= APP_URL ?>/catalogue" class="text-secondary text-decoration-none small">
                        <i class="bi bi-arrow-left me-1"></i> Retour au catalogue public
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>