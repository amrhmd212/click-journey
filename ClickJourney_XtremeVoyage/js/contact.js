sdocument.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('contact-form');

            const nomInput = document.getElementById('nom');
            const emailInput = document.getElementById('email');
            const sujetInput = document.getElementById('sujet');
            const messageInput = document.getElementById('message');

            const nomError = document.getElementById('nom-error');
            const emailError = document.getElementById('email-error');
            const sujetError = document.getElementById('sujet-error');
            const messageError = document.getElementById('message-error');

            function updateCharCount(input, counterId, maxLength) {
            const counter = document.getElementById(counterId);
            input.addEventListener('input', () => {
                counter.textContent = `${input.value.length}/${maxLength}`;
            });
        }


            updateCharCount(nomInput, 'nom-count', 50);
            updateCharCount(emailInput, 'email-count', 50);
            updateCharCount(sujetInput, 'sujet-count', 100);
            updateCharCount(messageInput, 'message-count', 500);


            form.addEventListener('submit', function (event) {
                let valid = true;

                nomError.textContent = '';
                emailError.textContent = '';
                sujetError.textContent = '';
                messageError.textContent = '';

                if (nomInput.value.trim() === '') {
                    nomError.textContent = "Le nom est requis.";
                    valid = false;
                }

                if (emailInput.value.trim() === '' || !emailInput.value.includes('@')) {
                    emailError.textContent = "Une adresse email valide est requise.";
                    valid = false;
                }

                if (sujetInput.value.trim() === '') {
                    sujetError.textContent = "Le sujet est requis.";
                    valid = false;
                }

                if (messageInput.value.trim() === '') {
                    messageError.textContent = "Le message ne peut pas être vide.";
                    valid = false;
                }

                if (!valid) {
                    event.preventDefault();
                }
            });
        });

