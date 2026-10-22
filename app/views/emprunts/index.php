<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des Emprunts</h2>
    <a href="/emprunts/create" class="btn btn-primary">Nouvel Emprunt</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Adhérent</th>
                    <th>Livre</th>
                    <th>Date d'emprunt</th>
                    <th>Retour Prévu</th>
                    <th>Statut</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($emprunts)): ?>
                    <?php foreach ($emprunts as $e): ?>
                        <tr>
                            <td><?= $e['id'] ?></td>
                            <td><?= htmlspecialchars($e['nom'] . ' ' . $e['prenom']) ?></td>
                            <td><?= htmlspecialchars($e['titre']) ?></td>
                            <td><?= $e['date_emprunt'] ?></td>
                            <td><?= $e['date_retour_prevue'] ?></td>
                            <td>
                                <span class="badge bg-<?= $e['statut'] === 'retourné' ? 'success' : 'warning text-dark' ?>">
                                    <?= $e['statut'] ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <?php if ($e['statut'] !== 'retourné'): ?>
                                    <a href="/emprunts/retourner/<?= $e['id'] ?>" class="btn btn-sm btn-outline-success">Marquer comme retourné</a>
                                <?php else: ?>
                                    <span class="text-muted">Clôturé</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">Aucun emprunt enregistré.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>