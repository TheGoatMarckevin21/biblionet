/**
 * BiblioNet — Interactions dynamiques JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {

    // 1. Fermeture automatique et en douceur des alertes après 4 secondes
    const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), transform 0.5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 500);
        }, 4000);
    });

    // 2. Recherche en temps réel dans les tableaux (Live Table Search)
    const searchInputs = document.querySelectorAll('.table-live-search');
    searchInputs.forEach(input => {
        const targetTableId = input.getAttribute('data-target-table');
        const targetTable = targetTableId ? document.querySelector(targetTableId) : document.querySelector('table');
        if (!targetTable) return;

        const countBadge = document.querySelector(input.getAttribute('data-count-badge'));
        const tbody = targetTable.querySelector('tbody');
        const rows = tbody.querySelectorAll('tr');

        // Création d'une ligne "aucun résultat"
        let noResultRow = tbody.querySelector('.no-search-results');
        if (!noResultRow) {
            noResultRow = document.createElement('tr');
            noResultRow.className = 'no-search-results text-center py-4 text-muted';
            noResultRow.style.display = 'none';
            const colCount = targetTable.querySelectorAll('thead th').length || 6;
            noResultRow.innerHTML = `<td colspan="${colCount}" class="py-4">
                <i class="bi bi-search fs-2 d-block text-muted mb-2"></i>
                <span class="fw-semibold">Aucun résultat ne correspond à votre recherche</span>
            </td>`;
            tbody.appendChild(noResultRow);
        }

        input.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            let visibleCount = 0;

            rows.forEach(row => {
                if (row === noResultRow) return;
                const text = row.textContent.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (noResultRow) {
                noResultRow.style.display = visibleCount === 0 ? '' : 'none';
            }

            if (countBadge) {
                countBadge.textContent = visibleCount;
            }
        });
    });

    // 3. Filtres interactifs par pilules (Pill Filters)
    const filterPills = document.querySelectorAll('.filter-pill[data-filter-group]');
    filterPills.forEach(pill => {
        pill.addEventListener('click', () => {
            const group = pill.getAttribute('data-filter-group');
            const value = pill.getAttribute('data-filter-value');
            const targetTable = document.querySelector(pill.getAttribute('data-target-table') || 'table');
            if (!targetTable) return;

            // Mettre à jour la classe active sur les boutons
            document.querySelectorAll(`.filter-pill[data-filter-group="${group}"]`).forEach(p => p.classList.remove('active'));
            pill.classList.add('active');

            const rows = targetTable.querySelectorAll('tbody tr:not(.no-search-results)');
            let visibleCount = 0;

            rows.forEach(row => {
                const rowValue = row.getAttribute(`data-${group}`);
                if (value === 'all' || rowValue === value) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            const countBadge = document.querySelector(pill.getAttribute('data-count-badge'));
            if (countBadge) countBadge.textContent = visibleCount;
        });
    });

    // 4. Boîtes de confirmation modernes de suppression avec SweetAlert2
    document.addEventListener('click', (e) => {
        const deleteLink = e.target.closest('a[onclick*="confirm"], a.btn-delete-confirm');
        if (!deleteLink) return;

        // Si SweetAlert2 est présent, on intercepte
        if (typeof Swal !== 'undefined') {
            e.preventDefault();
            e.stopImmediatePropagation();

            const url = deleteLink.getAttribute('href');
            const customMessage = deleteLink.getAttribute('data-confirm-message') || 'Êtes-vous sûr de vouloir supprimer cet élément ?';

            Swal.fire({
                title: 'Confirmation',
                text: customMessage,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="bi bi-trash3 me-1"></i> Supprimer',
                cancelButtonText: 'Annuler',
                reverseButtons: true,
                focusCancel: true,
                customClass: {
                    popup: 'rounded-4 shadow-lg border-0',
                    confirmButton: 'btn btn-danger rounded-pill px-4',
                    cancelButton: 'btn btn-secondary rounded-pill px-4'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    });

    // 5. Feedback dynamique lors de la soumission des formulaires
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                // Petite pause pour laisser la validation HTML5 s'effectuer
                setTimeout(() => {
                    if (form.checkValidity()) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = `
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            Enregistrement...
                        `;
                    }
                }, 50);
            }
        });
    });

    // 6. Focus automatique sur le premier champ d'un formulaire
    const firstInput = document.querySelector('form input:not([type="hidden"]):not([readonly])');
    if (firstInput && !firstInput.value) {
        firstInput.focus();
    }
});
