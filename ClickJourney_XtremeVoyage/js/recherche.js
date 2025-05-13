document.getElementById('filterBtn').addEventListener('click', () => {
        const form = document.getElementById('filterForm');
        const formData = new FormData(form);
        const queryString = new URLSearchParams(formData).toString();

        fetch('recherche_aide_avance.php?' + queryString)
            .then(response => response.text())
            .then(html => {
                document.getElementById('resultsContainer').innerHTML = html;
            })
            .catch(error => {
                console.error('Erreur lors du chargement dynamique :', error);
            });
    });
