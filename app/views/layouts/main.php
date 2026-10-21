<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioNet - Gestion de Bibliothèque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= APP_URL ?>/catalogue">📚 BiblioNet</a>
            
            <div class="navbar-nav ms-auto align-items-center">
                <a class="nav-link" href="<?= APP_URL ?>/catalogue">Catalogue public</a>

                <?php if (!empty($_SESSION['user'])): ?>
                    <a class="nav-link" href="<?= APP_URL ?>/livres">Livres</a>
                    <a class="nav-link" href="<?= APP_URL ?>/adherents">Adhérents</a>
                    <a class="nav-link" href="<?= APP_URL ?>/emprunts">Emprunts</a>
                    <span class="text-light ms-3 me-2 small">👤 <?= e($_SESSION['user']['nom']) ?></span>
                    <a class="btn btn-outline-danger btn-sm" href="<?= APP_URL ?>/auth/logout">Déconnexion</a>
                <?php else: ?>
                    <a class="btn btn-primary btn-sm ms-3" href="<?= APP_URL ?>/auth/login">Connexion Bibliothécaire</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="container">
        <?= $content ?>
    </main>
</body>
</html>