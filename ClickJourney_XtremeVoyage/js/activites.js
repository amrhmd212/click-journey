// Ajout d'un écouteur d'événements pour s'assurer que le script s'exécute uniquement après que le DOM est complètement chargé.
document.addEventListener('DOMContentLoaded', function () {
    // Sélectionne toutes les cartes d'activités affichées sur la page.
    const activityCards = document.querySelectorAll('.activity-card');
    // Sélectionne les éléments où seront affichés le nombre total d'activités et le prix total.
    const totalActivitiesSpan = document.getElementById('total-activities');
    const totalPriceSpan = document.getElementById('total-price');

    // Initialise les compteurs pour le nombre total d'activités sélectionnées et le prix total.
    let totalActivities = 0;
    let totalPrice = 0;

    // Parcourt chaque carte d'activité pour ajouter des gestionnaires d'événements aux boutons + et -.
    activityCards.forEach(card => {
        // Récupère le prix et le nom de l'activité depuis les attributs de données de la carte.
        const price = parseFloat(card.dataset.price); // Prix de l'activité
        const name = card.dataset.name; // Nom de l'activité

        // Sélectionne les boutons + et - pour ajuster la quantité.
        const plusBtn = card.querySelector('.quantity-btn:last-child'); // Bouton +
        const minusBtn = card.querySelector('.quantity-btn:first-child'); // Bouton -

        // Sélectionne l'élément qui affiche la quantité sélectionnée et le champ caché pour envoyer la quantité au serveur.
        const countSpan = card.querySelector('.selected-count'); // Affichage de la quantité
        const inputQte = card.querySelector(`input[name="activites[${name}][qte]"]`); // Champ caché pour la quantité

        // Initialise la quantité sélectionnée pour cette activité à 0.
        let count = 0;

        // Ajoute un gestionnaire d'événements au bouton + pour augmenter la quantité.
        plusBtn.addEventListener('click', () => {
            count++; // Incrémente la quantité
            countSpan.textContent = count; // Met à jour l'affichage de la quantité
            totalActivities++; // Incrémente le total des activités
            totalPrice += price; // Ajoute le prix de l'activité au total
            inputQte.value = count; // Met à jour la valeur du champ caché
            updateSummary(); // Met à jour le résumé affiché
        });

        // Ajoute un gestionnaire d'événements au bouton - pour diminuer la quantité.
        minusBtn.addEventListener('click', () => {
            if (count > 0) { // Vérifie que la quantité est supérieure à 0 avant de décrémenter
                count--; // Décrémente la quantité
                countSpan.textContent = count; // Met à jour l'affichage de la quantité
                totalActivities--; // Décrémente le total des activités
                totalPrice -= price; // Soustrait le prix de l'activité du total
                inputQte.value = count; // Met à jour la valeur du champ caché
                updateSummary(); // Met à jour le résumé affiché
            }
        });
    });

    // Fonction pour mettre à jour le résumé des activités sélectionnées et le prix total.
    function updateSummary() {
        // Compte le nombre d'activités sélectionnées (quantité > 0).
        const nbActivitiesSelected = Array.from(document.querySelectorAll('.activity-card'))
            .filter(card => parseInt(card.querySelector('.selected-count').textContent) > 0).length;

        // Met à jour l'affichage du nombre total d'activités sélectionnées.
        totalActivitiesSpan.textContent = nbActivitiesSelected;

        // Met à jour l'affichage du prix total avec deux décimales et ajoute le symbole €.
        totalPriceSpan.textContent = totalPrice.toFixed(2) + ' €';
    }
});
