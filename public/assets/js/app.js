// Script principal BiblioNet
document.addEventListener('DOMContentLoaded', () => {
    // Fermeture automatique des alertes après 4 secondes
    const alerts = document.querySelectorAll('.alert-dismissible, .alert-success');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 4000);
    });
});