// Script d'administration pour la gestion AJAX des utilisateurs

document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour récupérer la page courante de la pagination
    function getCurrentPage() {
        // Utilise l'URL actuelle pour extraire le paramètre "page"
        const params = new URLSearchParams(window.location.search);
        return params.get('page') || '1'; // Retourne "1" par défaut si aucun paramètre "page" n'est trouvé
    }

    // Fonction pour attacher les gestionnaires d'événements aux formulaires
    function attachFormHandlers() {
        // Sélectionne tous les formulaires dans la section des actions utilisateur
        const forms = document.querySelectorAll('.user-actions form');

        forms.forEach(form => {
            // Supprime tout gestionnaire d'événement existant pour éviter les doublons
            form.removeEventListener('submit', handleSubmit);
            // Ajoute un gestionnaire d'événement pour gérer la soumission du formulaire
            form.addEventListener('submit', handleSubmit);
        });
    }

    // Fonction de gestion de la soumission AJAX
    function handleSubmit(event) {
        event.preventDefault(); // Empêche le comportement par défaut de soumission du formulaire

        const form = event.currentTarget; // Récupère le formulaire soumis
        const button = form.querySelector('button'); // Récupère le bouton de soumission du formulaire
        const originalText = button.textContent; // Sauvegarde le texte original du bouton

        button.disabled = true; // Désactive le bouton pour éviter les soumissions multiples
        button.textContent = 'Modification...'; // Change le texte du bouton pour indiquer que l'action est en cours

        const formData = new FormData(form); // Crée un objet FormData contenant les données du formulaire

        // Envoi AJAX vers le script PHP pour traiter les données
        fetch('traitement-admin.php', {
            method: 'POST', // Utilise la méthode POST pour envoyer les données
            body: formData, // Envoie les données du formulaire
            credentials: 'same-origin' // Inclut les cookies pour maintenir la session
        })
        .then(response => {
            if (!response.ok) throw new Error('Erreur serveur'); // Vérifie si la réponse est correcte
            return response.json(); // Convertit la réponse en JSON
        })
        .then(data => {
            if (data.success) {
                // Si la réponse indique un succès, recharge la liste des utilisateurs et la pagination
                const currentPage = getCurrentPage(); // Récupère la page courante

                return fetch('admin.php?page=' + currentPage) // Fait une requête pour récupérer la page actuelle
                    .then(response => response.text()) // Convertit la réponse en texte HTML
                    .then(html => {
                        const parser = new DOMParser(); // Crée un parseur DOM pour analyser le HTML
                        const doc = parser.parseFromString(html, 'text/html'); // Analyse le HTML reçu
                        const newUserList = doc.querySelector('.user-list'); // Récupère la nouvelle liste des utilisateurs
                        const newPagination = doc.querySelector('.pagination'); // Récupère la nouvelle pagination

                        // Remplace le contenu actuel par le nouveau contenu
                        document.querySelector('.user-list').innerHTML = newUserList.innerHTML;
                        document.querySelector('.pagination').innerHTML = newPagination.innerHTML;

                        attachFormHandlers(); // Réattache les gestionnaires d'événements aux nouveaux formulaires

                        button.textContent = 'Modifié !'; // Indique que la modification a été effectuée
                    });
            } else {
                // Si la réponse indique un échec, affiche un message d'erreur
                alert(data.message || "Erreur inconnue");
                button.textContent = originalText; // Restaure le texte original du bouton
            }
        })
        .catch(error => {
            // En cas d'erreur, affiche un message d'erreur dans la console et une alerte
            console.error('Erreur AJAX:', error);
            alert("Erreur serveur");
            button.textContent = originalText; // Restaure le texte original du bouton
        })
        .finally(() => {
            // Réactive le bouton après un délai pour éviter les soumissions multiples
            setTimeout(() => {
                button.textContent = originalText; // Restaure le texte original du bouton
                button.disabled = false; // Réactive le bouton
            }, 1000);
        });
    }

    // Attache les gestionnaires d'événements au chargement de la page
    attachFormHandlers();
});
