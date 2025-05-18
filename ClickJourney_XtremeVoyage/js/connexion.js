// Ajout d'un écouteur d'événements pour s'assurer que le script s'exécute uniquement après que le DOM est complètement chargé.
document.addEventListener('DOMContentLoaded', function () {
    // Sélectionne le formulaire de connexion et les champs d'entrée pour le nom d'utilisateur et le mot de passe.
    const form = document.getElementById('login-form');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    // Sélectionne les éléments pour afficher les messages d'erreur pour le nom d'utilisateur et le mot de passe.
    const usernameError = document.getElementById('username-error');
    const passwordError = document.getElementById('password-error');

    // Sélectionne tous les icônes permettant de basculer l'affichage du mot de passe (visible/masqué).
    const toggleIcons = document.querySelectorAll('.toggle-password');


    // Ajoute un gestionnaire d'événements à chaque icône pour basculer l'affichage du mot de passe.
    toggleIcons.forEach(icon => {
        icon.addEventListener('click', function () {
            // Récupère l'ID de l'élément cible (champ mot de passe) à partir de l'attribut data-target.
            const targetId = this.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);

            // Bascule entre le type "password" et "text" pour afficher ou masquer le mot de passe.
            if (targetInput.type === 'password') {
                targetInput.type = 'text'; // Affiche le mot de passe
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                targetInput.type = 'password'; // Masque le mot de passe
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });

    // Ajoute un gestionnaire d'événements pour valider le formulaire lors de la soumission.
    form.addEventListener('submit', function (event) {
        let valid = true; // Initialise une variable pour suivre la validité du formulaire.

        // Réinitialise les messages d'erreur avant de valider les champs.
        usernameError.textContent = '';
        passwordError.textContent = '';

        // Vérifie si le champ du nom d'utilisateur est vide.
        if (usernameInput.value.trim() === '') {
            usernameError.textContent = "Le nom d'utilisateur est requis."; // Affiche un message d'erreur.
            valid = false; // Marque le formulaire comme invalide.
        }

        // Vérifie si le champ du mot de passe est vide.
        if (passwordInput.value.trim() === '') {
            passwordError.textContent = "Le mot de passe est requis."; // Affiche un message d'erreur.
            valid = false; // Marque le formulaire comme invalide.
        }

        // Si le formulaire n'est pas valide, empêche l'envoi.
        if (!valid) {
            event.preventDefault(); // Empêche la soumission du formulaire.
        }
    });

    // Fonction pour mettre à jour le compteur de caractères pour un champ donné.
    function updateCharCount(input, counterId, maxLength) {
        const counter = document.getElementById(counterId); // Sélectionne l'élément compteur.
        input.addEventListener('input', () => {
            // Met à jour le compteur avec le nombre de caractères saisis et la longueur maximale autorisée.
            counter.textContent = `${input.value.length}/${maxLength}`;
        });
    }

    // Ajoute des compteurs de caractères pour les champs du nom d'utilisateur et du mot de passe.
    updateCharCount(usernameInput, 'username-count', 30);
    updateCharCount(passwordInput, 'password-count', 30);

});
