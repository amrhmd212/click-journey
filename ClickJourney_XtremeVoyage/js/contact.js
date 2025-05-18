// Ajout d'un écouteur d'événements pour exécuter le script une fois que le DOM est complètement chargé.
document.addEventListener('DOMContentLoaded', function () {
    // Récupération des éléments du formulaire et des champs d'entrée
    const form = document.getElementById('contact-form');
    const feedback = document.getElementById('feedback-message');

    const nomInput = document.getElementById('nom'); // Champ pour le nom
    const emailInput = document.getElementById('email'); // Champ pour l'email
    const sujetInput = document.getElementById('sujet'); // Champ pour le sujet
    const messageInput = document.getElementById('message'); // Champ pour le message

    // Récupération des éléments pour afficher les messages d'erreur
    const nomError = document.getElementById('nom-error');
    const emailError = document.getElementById('email-error');
    const sujetError = document.getElementById('sujet-error');
    const messageError = document.getElementById('message-error');

    // Fonction pour mettre à jour le compteur de caractères pour les champs de texte.
    function updateCharCount(input, counterId, maxLength) {
        const counter = document.getElementById(counterId);
        counter.style.display = 'none'; // Cacher le compteur au départ

        input.addEventListener('input', () => {
            if (input.value.length > 0) {
                counter.style.display = 'inline'; // Afficher le compteur si du texte est saisi
                counter.textContent = `${input.value.length}/${maxLength}`;
            } else {
                counter.style.display = 'none'; // Cacher le compteur si le champ est vide
            }
        });
    }

    // Ajout des compteurs de caractères pour chaque champ
    updateCharCount(nomInput, 'nom-count', 50);
    updateCharCount(emailInput, 'email-count', 50);
    updateCharCount(sujetInput, 'sujet-count', 100);
    updateCharCount(messageInput, 'message-count', 500);

    // Gestion de la soumission du formulaire
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Empêche l'envoi par défaut du formulaire

        // Réinitialisation des messages d'erreur et du message de retour
        nomError.textContent = '';
        emailError.textContent = '';
        sujetError.textContent = '';
        messageError.textContent = '';
        feedback.innerHTML = '';

        let valid = true; // Variable pour suivre la validité du formulaire

        // Validation du champ "Nom"
        if (nomInput.value.trim() === '') {
            nomError.textContent = "Le nom est requis.";
            valid = false;
        }

        // Validation du champ "Email"
        if (emailInput.value.trim() === '' || !emailInput.value.includes('@')) {
            emailError.textContent = "Une adresse email valide est requise.";
            valid = false;
        }

        // Validation du champ "Sujet"
        if (sujetInput.value.trim() === '') {
            sujetError.textContent = "Le sujet est requis.";
            valid = false;
        }

        // Validation du champ "Message"
        if (messageInput.value.trim() === '') {
            messageError.textContent = "Le message ne peut pas être vide.";
            valid = false;
        }

        if (!valid) return; // Arrête l'exécution si le formulaire n'est pas valide

        // Préparation des données du formulaire pour l'envoi
        const formData = new FormData(form);

        // Envoi des données via une requête AJAX
        fetch('traitement-contact.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text()) // Traite la réponse en tant que texte
        .then(data => {
            // Affiche un message de succès
            feedback.innerHTML = `<div style="color: green; background-color: #e8f5e9; padding: 10px; border-radius: 5px;">
                ${data}
            </div>`;
            form.reset(); // Réinitialise le formulaire
            document.querySelectorAll('.char-counter').forEach(c => c.textContent = ''); // Réinitialise les compteurs de caractères
        })
        .catch(error => {
            // Affiche un message d'erreur en cas de problème avec la requête
            feedback.innerHTML = `<div style="color: red; background-color: #ffebee; padding: 10px; border-radius: 5px;">
                Erreur lors de l'envoi du message.
            </div>`;
            console.error(error); // Affiche l'erreur dans la console
        });
    });
});
