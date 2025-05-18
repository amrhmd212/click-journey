// Script pour gérer la sélection des options (vol, hôtel, services supplémentaires)

window.addEventListener('DOMContentLoaded', () => {
    // Récupère les données de session encodées dans la page
    const sessionData = JSON.parse(document.getElementById('session-data').textContent);

    // Pour chaque bouton de sélection d'option
    document.querySelectorAll('.js-select-option').forEach(button => {
        const form = button.closest('form'); // Récupère le formulaire parent du bouton
        const type = form.dataset.type; // Récupère le type d'option (vol, hôtel, service)
        const inputs = form.querySelectorAll('input[type="hidden"]'); // Récupère tous les champs cachés du formulaire
        let idValue = '';

        // Récupère la valeur de l'option selon le type
        inputs.forEach(input => {
            if ((type !== 'service' && input.name === type) || (type === 'service' && input.name === 'service')) {
                idValue = input.value; // Stocke la valeur de l'option
            }
        });

        button.dataset.id = idValue; // Associe l'ID de l'option au bouton
        button.dataset.type = type; // Associe le type d'option au bouton

        // Affiche l'état sélectionné si déjà choisi en session
        if (type === 'service') {
            const selectedServices = sessionData.options_supplementaires || []; // Récupère les services sélectionnés en session
            if (selectedServices.some(opt => opt.nom === idValue)) {
                button.classList.add('selected'); // Ajoute une classe pour indiquer la sélection
                button.style.backgroundColor = "#4CAF50"; // Change la couleur de fond pour indiquer la sélection
                button.textContent = "✓ Sélectionné"; // Change le texte du bouton
            }
        } else {
            if (sessionData[type] === idValue) {
                button.classList.add('selected'); // Ajoute une classe pour indiquer la sélection
                button.style.backgroundColor = "#4CAF50"; // Change la couleur de fond pour indiquer la sélection
                button.textContent = "✓ Sélectionné"; // Change le texte du bouton
            }
        }
    });
});

// Gestion du clic sur les boutons de sélection
document.querySelectorAll('.js-select-option').forEach(button => {
    button.addEventListener('click', async () => {
        const form = button.closest('form'); // Récupère le formulaire parent du bouton
        const formData = new FormData(form); // Crée un objet FormData avec les données du formulaire
        const type = form.dataset.type; // Récupère le type d'option (vol, hôtel, service)
        const id = button.dataset.id; // Récupère l'ID de l'option
        const isService = (type === 'service'); // Vérifie si l'option est un service supplémentaire
        const alreadySelected = button.classList.contains('selected'); // Vérifie si l'option est déjà sélectionnée

        if (alreadySelected) {
            formData.append('deselection', '1'); // Ajoute un champ pour indiquer la désélection
        }

        try {
            // Envoie une requête AJAX pour sauvegarder l'option sélectionnée
            const response = await fetch('ajax_sauvegarde_option.php', {
                method: 'POST', // Utilise la méthode POST pour envoyer les données
                body: formData // Envoie les données du formulaire
            });

            const result = await response.text(); // Récupère la réponse du serveur sous forme de texte

            if (isService) {
                // Gestion spécifique pour les services supplémentaires
                if (alreadySelected) {
                    button.textContent = "Sélectionner"; // Change le texte du bouton pour indiquer la désélection
                    button.classList.remove('selected'); // Retire la classe de sélection
                    button.style.backgroundColor = ""; // Réinitialise la couleur de fond
                    button.disabled = false; // Réactive le bouton
                } else {
                    button.textContent = "✓ Sélectionné"; // Change le texte du bouton pour indiquer la sélection
                    button.classList.add('selected'); // Ajoute une classe pour indiquer la sélection
                    button.style.backgroundColor = "#4CAF50"; // Change la couleur de fond pour indiquer la sélection
                    button.disabled = false; // Réactive le bouton
                }
            } else {
                // Gestion pour les autres types d'options (vol, hôtel)
                document.querySelectorAll(`form[data-type="${type}"] .js-select-option`).forEach(btn => {
                    btn.textContent = "Sélectionner"; // Réinitialise le texte des autres boutons
                    btn.classList.remove('selected'); // Retire la classe de sélection des autres boutons
                    btn.style.backgroundColor = ""; // Réinitialise la couleur de fond des autres boutons
                    btn.disabled = false; // Réactive les autres boutons
                });

                if (!alreadySelected) {
                    button.textContent = "✓ Sélectionné"; // Change le texte du bouton pour indiquer la sélection
                    button.classList.add('selected'); // Ajoute une classe pour indiquer la sélection
                    button.style.backgroundColor = "#4CAF50"; // Change la couleur de fond pour indiquer la sélection
                    button.disabled = false; // Réactive le bouton
                }
            }
        } catch (error) {
            // En cas d'erreur, affiche un message d'erreur dans la console et une alerte
            console.error('Erreur AJAX :', error);
            alert("Une erreur s'est produite.");
        }
    });
});