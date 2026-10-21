<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📖 Gestion des Livres</h2>
    <a href="<?= APP_URL ?>/livres/create" class="btn btn-primary">+ Ajouter un livre</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Catégorie</th>
                    <th>Année</th>
                    <th>Exemplaires (Dispo / Total)</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livres as $l): ?>
                <tr>
                    <td><?= e((string)$l['id']) ?></td>
                    <td class="fw-bold"><?= e($l['titre']) ?></td>
                    <td><?= e($l['auteur']) ?></td>
                    <td><span class="badge bg-secondary"><?= e($l['categorie']) ?></span></td>
                    <td><?= e((string)$l['annee']) ?></td>
                    <td>
                        <span class="badge <?= ($l['disponibles'] > 0) ? 'bg-success' : 'bg-danger' ?>">
                            <?= e((string)$l['disponibles']) ?> / <?= e((string)$l['nb_exemplaires']) ?>
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="<?= APP_URL ?>/livres/edit/<?= e((string)$l['id']) ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <a href="<?= APP_URL ?>/livres/delete/<?= e((string)$l['id']) ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Supprimer ce livre ?');">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>