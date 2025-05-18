// Ajout d'un écouteur d'événements pour exécuter le script une fois que le DOM est complètement chargé.
document.addEventListener('DOMContentLoaded', function () {
    // Récupération des éléments du formulaire et des champs d'entrée
    const form = document.getElementById('register-form'); // Formulaire d'inscription

    const usernameInput = document.getElementById('username'); // Champ pour le nom d'utilisateur
    const emailInput = document.getElementById('email'); // Champ pour l'email
    const passwordInput = document.getElementById('password'); // Champ pour le mot de passe
    const confirmInput = document.getElementById('confirm-password'); // Champ pour confirmer le mot de passe
    const phoneInput = document.getElementById('phone'); // Champ pour le numéro de téléphone
    const addressInput = document.getElementById('address'); // Champ pour l'adresse

    // Récupération des éléments pour afficher les messages d'erreur
    const usernameError = document.getElementById('username-error'); // Message d'erreur pour le nom d'utilisateur
    const emailError = document.getElementById('email-error'); // Message d'erreur pour l'email
    const passwordError = document.getElementById('password-error'); // Message d'erreur pour le mot de passe
    const confirmError = document.getElementById('confirm-password-error'); // Message d'erreur pour la confirmation du mot de passe
    const phoneError = document.getElementById('phone-error'); // Message d'erreur pour le numéro de téléphone
    const addressError = document.getElementById('address-error'); // Message d'erreur pour l'adresse

    // Gestion des icônes pour afficher/masquer les mots de passe
    const toggleIcons = document.querySelectorAll('.toggle-password'); // Sélectionne toutes les icônes de bascule

    toggleIcons.forEach(icon => {
        icon.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target'); // Récupère l'ID du champ cible
            const targetInput = document.getElementById(targetId); // Récupère le champ cible

            // Alterne entre afficher et masquer le mot de passe
            if (targetInput.type === 'password') {
                targetInput.type = 'text'; // Change le type en texte pour afficher le mot de passe
                this.classList.remove('fa-eye'); // Change l'icône en "œil barré"
                this.classList.add('fa-eye-slash');
            } else {
                targetInput.type = 'password'; // Change le type en mot de passe pour masquer
                this.classList.remove('fa-eye-slash'); // Change l'icône en "œil"
                this.classList.add('fa-eye');
            }
        });
    });

    // Gestion de la soumission du formulaire
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Empêche l'envoi par défaut du formulaire

        let valid = true; // Variable pour suivre la validité du formulaire

        // Réinitialisation des messages d'erreur
        usernameError.textContent = '';
        emailError.textContent = '';
        passwordError.textContent = '';
        confirmError.textContent = '';
        phoneError.textContent = '';
        addressError.textContent = '';

        // Validation du champ "Nom d'utilisateur"
        if (!/^[a-zA-Z0-9_]{3,20}$/.test(usernameInput.value.trim())) {
            usernameError.textContent = "Nom d'utilisateur invalide (3-20 caractères alphanumériques).";
            valid = false; // Marque le formulaire comme invalide
        }

        // Validation du champ "Email"
        if (!/^\S+@\S+\.\S+$/.test(emailInput.value.trim())) {
            emailError.textContent = "Adresse email invalide.";
            valid = false;
        }

        // Validation du champ "Mot de passe"
        if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(passwordInput.value)) {
            passwordError.textContent = "Mot de passe trop faible (8 caractères, majuscule, minuscule, chiffre).";
            valid = false;
        }

        // Validation du champ "Confirmation du mot de passe"
        if (confirmInput.value !== passwordInput.value) {
            confirmError.textContent = "Les mots de passe ne correspondent pas.";
            valid = false;
        } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(confirmInput.value)) {
            confirmError.textContent = "Mot de passe trop faible (8 caractères, majuscule, minuscule, chiffre).";
            valid = false;
        }

        // Validation du champ "Téléphone"
        if (!/^\+?[0-9]{10,15}$/.test(phoneInput.value.trim())) {
            phoneError.textContent = "Numéro de téléphone invalide.";
            valid = false;
        }

        // Validation du champ "Adresse"
        const addressRegex = /^\d+\s+[\w\sàâäéèêëïîôöùûüç'-]+,\s*[\w\sàâäéèêëïîôöùûüç'-]+,\s*\d{5}$/;
        if (!addressInput.value.trim()) {
            addressError.textContent = "L'adresse est obligatoire.";
            valid = false;
        } else if (addressInput.value.length > 255) {
            addressError.textContent = "Adresse trop longue (255 caractères max).";
            valid = false;
        } else if (!addressRegex.test(addressInput.value.trim())) {
            addressError.textContent = "Format d'adresse invalide. Exemple : 12 rue Victor Hugo, Paris, 75001";
            valid = false;
        }

        if (!valid) return; // Arrête l'exécution si le formulaire n'est pas valide

        // Préparation des données du formulaire pour l'envoi
        const formData = new FormData(form);

        // Envoi des données via une requête AJAX
        fetch('traitement-inscription.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Conversion de la réponse en JSON
        .then(data => {
            const messageBox = document.getElementById('form-message'); // Élément pour afficher les messages

            if (data.success) { // Si l'inscription est réussie
                if (data.redirect) {
                    window.location.href = data.redirect; // Redirige vers une autre page si spécifié
                } else {
                    // Affiche un message de succès
                    messageBox.innerHTML = `<div style="background-color: #e8f5e9; color: #2e7d32; padding: 12px; border-radius: 5px; font-weight: bold;">
                        Compte créé avec succès. Vous pouvez maintenant vous <a href="connexion.php" style="color: #2e7d32; text-decoration: underline;">vous connecter</a>.
                    </div>`;
                    form.reset(); // Réinitialise le formulaire
                    document.querySelectorAll('.char-counter').forEach(c => c.textContent = ''); // Réinitialise les compteurs de caractères
                }
            } else { // Si une erreur survient
                messageBox.innerHTML = ''; // Efface les anciens messages
                usernameError.textContent = '';
                emailError.textContent = '';
                phoneError.textContent = '';
                confirmError.textContent = '';
                passwordError.textContent = '';

                // Affiche les messages d'erreur spécifiques
                if (data.field === 'username') {
                    usernameError.textContent = data.message;
                } else if (data.field === 'email') {
                    emailError.textContent = data.message;
                } else if (data.field === 'phone') {
                    phoneError.textContent = data.message;
                } else if (data.field === 'confirm-password') {
                    confirmError.textContent = data.message;
                } else {
                    messageBox.innerHTML = `<div style="background-color: #ffebee; color: #c62828; padding: 12px; border-radius: 5px;">
                        ${data.message}
                    </div>`;
                }
            }
        })
        .catch(error => {
            console.error('Erreur AJAX :', error); // Affiche une erreur dans la console
            alert("Erreur serveur."); // Alerte en cas d'erreur serveur
        });
    });

    // Fonction pour mettre à jour les compteurs de caractères
    function updateCharCount(input, counterId, maxLength) {
        const counter = document.getElementById(counterId);
        input.addEventListener('input', () => {
            counter.textContent = `${input.value.length}/${maxLength}`; // Met à jour le compteur
        });
    }

    // Ajout des compteurs de caractères pour chaque champ
    updateCharCount(usernameInput, 'username-count', 30);
    updateCharCount(emailInput, 'email-count', 50);
    updateCharCount(passwordInput, 'password-count', 30);
    updateCharCount(confirmInput, 'confirm-password-count', 30);
    updateCharCount(phoneInput, 'phone-count', 15);
    updateCharCount(addressInput, 'address-count', 255);
});
