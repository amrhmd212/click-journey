window.addEventListener('DOMContentLoaded', () => {
    const sessionData = JSON.parse(document.getElementById('session-data').textContent);
    document.querySelectorAll('.js-select-option').forEach(button => {
        const form = button.closest('form');
        const type = form.dataset.type;
        const inputs = form.querySelectorAll('input[type="hidden"]');
        let idValue = '';
        inputs.forEach(input => {
            if ((type !== 'service' && input.name === type) || (type === 'service' && input.name === 'service')) {
                idValue = input.value;
            }
        });
        button.dataset.id = idValue;
        button.dataset.type = type;
        if (type === 'service') {
            const selectedServices = sessionData.options_supplementaires || [];
            if (selectedServices.some(opt => opt.nom === idValue)) {
                button.classList.add('selected');
                button.style.backgroundColor = "#4CAF50";
                button.textContent = "✓ Sélectionné";
            }
        } else {
            if (sessionData[type] === idValue) {
                button.classList.add('selected');
                button.style.backgroundColor = "#4CAF50";
                button.textContent = "✓ Sélectionné";
            }
        }
    });
});
document.querySelectorAll('.js-select-option').forEach(button => {
    button.addEventListener('click', async () => {
        const form = button.closest('form');
        const formData = new FormData(form);
        const type = form.dataset.type;
        const id = button.dataset.id;
        const isService = (type === 'service');
        const alreadySelected = button.classList.contains('selected');
        if (alreadySelected) {
            formData.append('deselection', '1');
        }
        try {
            const response = await fetch('ajax_sauvegarde_option.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.text();
            if (isService) {
                if (alreadySelected) {
                    button.textContent = "Sélectionner";
                    button.classList.remove('selected');
                    button.style.backgroundColor = "";
                    button.disabled = false;
                } else {
                    button.textContent = "✓ Sélectionné";
                    button.classList.add('selected');
                    button.style.backgroundColor = "#4CAF50";
                    button.disabled = false;
                }
            } else {
                document.querySelectorAll(`form[data-type="${type}"] .js-select-option`).forEach(btn => {
                    btn.textContent = "Sélectionner";
                    btn.classList.remove('selected');
                    btn.style.backgroundColor = "";
                    btn.disabled = false;
                });
                if (!alreadySelected) {
                    button.textContent = "✓ Sélectionné";
                    button.classList.add('selected');
                    button.style.backgroundColor = "#4CAF50";
                    button.disabled = false;
                }
            }
        } catch (error) {
            console.error('Erreur AJAX :', error);
            alert("Une erreur s'est produite.");
        }
    });
});