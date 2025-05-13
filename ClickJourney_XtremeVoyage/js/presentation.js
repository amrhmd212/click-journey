 document.getElementById('searchBtn').addEventListener('click', () => {
            const query = document.getElementById('searchInput').value.trim();

            fetch('recherche_aide.php?search=' + encodeURIComponent(query))
                .then(response => response.text())
                .then(html => {
                    document.getElementById('resultsContainer').innerHTML = html;
                })
                .catch(error => {
                    console.error('Erreur lors de la recherche :', error);
                });
        });
