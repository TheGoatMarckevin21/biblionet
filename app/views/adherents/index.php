<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des Adhérents</h2>
    <a href="<?= APP_URL ?>/adherents/create" class="btn btn-primary">
        <i class="bi bi-person-plus"></i> Nouveau Membre
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Classe</th>
                    <th>Téléphone</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($adherents)): ?>
                    <?php foreach ($adherents as $a): ?>
                        <tr>
                            <td><?= $a['id'] ?></td>
                            <td><?= htmlspecialchars($a['nom']) ?></td>
                            <td><?= htmlspecialchars($a['prenom']) ?></td>
                            <td><span class="badge bg-info text-dark"><?= htmlspecialchars($a['classe']) ?></span></td>
                            <td><?= htmlspecialchars($a['telephone']) ?></td>
                            <td class="text-center">
                                <a href="<?= APP_URL ?>/adherents/edit/<?= $a['id'] ?>" class="btn btn-sm btn-outline-warning me-1">Modifier</a>
                                <a href="<?= APP_URL ?>/adherents/delete/<?= $a['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aucun adhérent enregistré.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
