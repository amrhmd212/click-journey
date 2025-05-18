// Ajout d'un gestionnaire d'événements pour le bouton de recherche

document.getElementById('searchBtn').addEventListener('click', () => {
    // Récupère la valeur saisie dans la barre de recherche
    const query = document.getElementById('searchInput').value.trim();

    // Envoie une requête GET au serveur avec le terme de recherche
    fetch('recherche_aide.php?search=' + encodeURIComponent(query))
        .then(response => response.text()) // Traite la réponse en tant que texte HTML
        .then(html => {
            // Met à jour dynamiquement le conteneur des résultats avec le contenu reçu
            document.getElementById('resultsContainer').innerHTML = html;
        })
        .catch(error => {
            // Affiche une erreur dans la console en cas de problème avec la requête
            console.error('Erreur lors de la recherche :', error);
        });
});
