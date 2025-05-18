// Ajout d'un gestionnaire d'événements pour le bouton de filtrage
// Ce script permet d'appliquer des filtres dynamiquement et de mettre à jour les résultats affichés.

document.getElementById('filterBtn').addEventListener('click', () => {
    // Récupère le formulaire contenant les filtres
    const form = document.getElementById('filterForm');
    const formData = new FormData(form); // Crée un objet FormData à partir du formulaire
    const queryString = new URLSearchParams(formData).toString(); // Convertit les données du formulaire en chaîne de requête

    // Envoie une requête GET au serveur avec les filtres appliqués
    fetch('recherche_aide_avance.php?' + queryString)
        .then(response => response.text()) // Traite la réponse en tant que texte HTML
        .then(html => {
            // Met à jour dynamiquement le conteneur des résultats avec le contenu reçu
            document.getElementById('resultsContainer').innerHTML = html;
        })
        .catch(error => {
            // Affiche une erreur dans la console en cas de problème avec la requête
            console.error('Erreur lors du chargement dynamique :', error);
        });
});
