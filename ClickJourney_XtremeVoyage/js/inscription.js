
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('register-form');

            const usernameInput = document.getElementById('username');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('confirm-password');
            const phoneInput = document.getElementById('phone');
            const addressInput = document.getElementById('address');

            const usernameError = document.getElementById('username-error');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            const confirmError = document.getElementById('confirm-password-error');
            const phoneError = document.getElementById('phone-error');
            const addressError = document.getElementById('address-error');

            const toggleIcons = document.querySelectorAll('.toggle-password');

            toggleIcons.forEach(icon => {
                icon.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const targetInput = document.getElementById(targetId);

                    if (targetInput.type === 'password') {
                        targetInput.type = 'text';
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    } else {
                        targetInput.type = 'password';
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    }
                });
            });

            form.addEventListener('submit', function (event) {
                let valid = true;
                usernameError.textContent = '';
                emailError.textContent = '';
                passwordError.textContent = '';
                confirmError.textContent = '';
                phoneError.textContent = '';
                addressError.textContent = '';


                if (!/^[a-zA-Z0-9_]{3,20}$/.test(usernameInput.value.trim())) {
                    usernameError.textContent = "Nom d'utilisateur invalide (3-20 caractères alphanumériques).";
                    valid = false;
                }


                if (!/^\S+@\S+\.\S+$/.test(emailInput.value.trim())) {
                    emailError.textContent = "Adresse email invalide.";
                    valid = false;
                }


                if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(passwordInput.value)) {
                    passwordError.textContent = "Mot de passe trop faible (8 caractères, majuscule, minuscule, chiffre).";
                    valid = false;
                }


                if (confirmInput.value !== passwordInput.value ) {
                    confirmError.textContent = "Les mots de passe ne correspondent pas.";
                    valid = false;
                } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(confirmInput.value)){
                    confirmError.textContent = "Mot de passe trop faible (8 caractères, majuscule, minuscule, chiffre).";
                    valid = false;
                }

 
                if (!/^\+?[0-9]{10,15}$/.test(phoneInput.value.trim())) {
                    phoneError.textContent = "Numéro de téléphone invalide.";
                    valid = false;
                }


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


                if (!valid) {
                    event.preventDefault(); 
                }
            });


            function updateCharCount(input, counterId, maxLength) {
            const counter = document.getElementById(counterId);
            input.addEventListener('input', () => {
                counter.textContent = `${input.value.length}/${maxLength}`;
            });
        }

            updateCharCount(usernameInput, 'username-count', 30);
            updateCharCount(emailInput, 'email-count', 50);
            updateCharCount(passwordInput, 'password-count', 30);
            updateCharCount(confirmInput, 'confirm-password-count', 30);
            updateCharCount(phoneInput, 'phone-count', 15);
            updateCharCount(addressInput, 'address-count', 255);
        });

