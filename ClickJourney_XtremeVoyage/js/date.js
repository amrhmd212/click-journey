// Script pour restreindre la sélection des dates à aujourd'hui ou plus tard
const today = new Date().toISOString().split('T')[0];
document.getElementById('departure-date').setAttribute('min', today);
document.getElementById('return-date').setAttribute('min', today);

// Script AJAX pour le formulaire
document.getElementById('date-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Empêche le rechargement de la page

    const formData = new FormData(this);

    fetch('date.php', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest' // Pour que le PHP détecte l'AJAX
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirige vers la page des options si tout est valide
            window.location.href = 'options.php';
        } else {
            // Affiche l'erreur reçue du serveur
            let errorDiv = document.querySelector('.error-message');
            if (errorDiv) {
                errorDiv.textContent = data.message;
            } else {
                errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.textContent = data.message;
                document.querySelector('.form-container').prepend(errorDiv);
            }
        }
    })
    .catch(error => {
        console.error('Erreur lors de la requête AJAX :', error);
    });
});
