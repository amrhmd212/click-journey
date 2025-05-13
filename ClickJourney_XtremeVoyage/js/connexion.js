    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('login-form');
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const usernameError = document.getElementById('username-error');
        const passwordError = document.getElementById('password-error');
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
            passwordError.textContent = '';

            if (usernameInput.value.trim() === '') {
                usernameError.textContent = "Le nom d'utilisateur est requis.";
                valid = false;
            }

            if (passwordInput.value.trim() === '') {
                passwordError.textContent = "Le mot de passe est requis.";
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
        updateCharCount(passwordInput, 'password-count', 30);

    });
