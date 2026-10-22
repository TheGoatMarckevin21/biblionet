<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioNet - Gestion de Bibliothèque</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom Dark Style -->
    <link href="<?= APP_URL ?>/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">
    <!-- Navbar moderne Sombre -->
    <nav class="navbar navbar-expand-lg navbar-dark main-navbar mb-4 sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="<?= APP_URL ?>/catalogue">
                <span class="brand-icon"><i class="bi bi-book-half"></i></span>
                <span class="brand-text">Biblio<span class="text-primary-gradient">Net</span></span>
            </a>
            
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                    <li class="nav-item">
                        <a class="nav-link px-3" href="<?= APP_URL ?>/catalogue">
                            <i class="bi bi-grid-fill me-1"></i> Catalogue
                        </a>
                    </li>
                    <?php if (!empty($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="<?= APP_URL ?>/livres">
                                <i class="bi bi-journals me-1"></i> Livres
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="<?= APP_URL ?>/adherents">
                                <i class="bi bi-people-fill me-1"></i> Adhérents
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3" href="<?= APP_URL ?>/emprunts">
                                <i class="bi bi-arrow-left-right me-1"></i> Emprunts
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <?php if (!empty($_SESSION['user'])): ?>
                        <div class="user-chip me-2">
                            <div class="user-avatar">
                                <?= strtoupper(substr($_SESSION['user']['nom'], 0, 1)) ?>
                            </div>
                            <span class="user-name d-none d-sm-inline"><?= e($_SESSION['user']['nom']) ?></span>
                        </div>
                        <a class="btn btn-outline-danger btn-sm rounded-pill px-3" href="<?= APP_URL ?>/auth/logout">
                            <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                        </a>
                    <?php else: ?>
                        <a class="btn btn-primary-gradient btn-sm rounded-pill px-3 py-2 fw-semibold" href="<?= APP_URL ?>/auth/login">
                            <i class="bi bi-shield-lock me-1"></i> Espace Bibliothécaire
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <main class="container py-2 page-fade-in">
        <?php if (!empty($flash) && in_array($flash['type'], ['success', 'danger', 'warning', 'info'], true)): ?>
            <div class="alert alert-<?= $flash['type'] ?> mt-3"><?= e($flash['message']) ?></div>
        <?php endif; ?>
        <?= $content ?>
    </main>

    <!-- Footer sombre épuré -->
    <footer class="footer mt-auto py-3 text-center text-muted">
        <div class="container small">
            <span>&copy; <?= date('Y') ?> <strong class="text-light">BiblioNet</strong> — Système Intégré de Gestion de Bibliothèque</span>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 pour les modales -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts dynamiques BiblioNet -->
    <script src="<?= APP_URL ?>/assets/js/app.js"></script>
</body>
</html>
