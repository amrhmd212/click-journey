document.addEventListener('DOMContentLoaded', function() {
    const modifiedFields = new Set(); // Ensemble pour suivre les champs modifiés
    const submitAllBtn = document.querySelector('.submit-all-btn'); // Bouton pour soumettre toutes les modifications
    
    // Active le mode édition pour un champ
    function enableEditing(field) {
        const fieldContainer = field.closest('.profile-field'); // Conteneur du champ
        const input = fieldContainer.querySelector('.profile-input'); // Champ d'entrée
        const value = fieldContainer.querySelector('.field-value'); // Valeur affichée
        
        input.classList.add('active'); // Active le champ d'entrée
        value.classList.add('hidden'); // Cache la valeur affichée
    }
    
    // Désactive le mode édition pour un champ
    function disableEditing(field) {
        const fieldContainer = field.closest('.profile-field');
        const input = fieldContainer.querySelector('.profile-input');
        const value = fieldContainer.querySelector('.field-value');
        
        input.classList.remove('active'); // Désactive le champ d'entrée
        value.classList.remove('hidden'); // Affiche la valeur
    }
    
    // Sauvegarde les modifications d'un champ
    function saveField(field) {
        const fieldContainer = field.closest('.profile-field');
        const input = fieldContainer.querySelector('.profile-input');
        const value = fieldContainer.querySelector('.field-value');
        const fieldName = fieldContainer.dataset.field; // Nom du champ
        
        value.textContent = input.value; // Met à jour la valeur affichée
        modifiedFields.add(fieldName); // Ajoute le champ modifié à l'ensemble
        disableEditing(field); // Désactive le mode édition
        
        // Active le bouton de soumission si des champs ont été modifiés
        if (modifiedFields.size > 0) {
            submitAllBtn.classList.add('active');
            submitAllBtn.style.opacity = '1';
            submitAllBtn.style.pointerEvents = 'auto';
        }
    }
    
    // Annule les modifications d'un champ
    function cancelField(field) {
        const fieldContainer = field.closest('.profile-field');
        const input = fieldContainer.querySelector('.profile-input');
        const value = fieldContainer.querySelector('.field-value');
        const fieldName = fieldContainer.dataset.field;
        
        input.value = value.textContent; // Réinitialise la valeur du champ
        modifiedFields.delete(fieldName); // Supprime le champ de l'ensemble des modifications
        disableEditing(field);
        
        // Désactive le bouton de soumission si aucun champ n'est modifié
        if (modifiedFields.size === 0) {
            submitAllBtn.classList.remove('active');
            submitAllBtn.style.opacity = '0.5';
            submitAllBtn.style.pointerEvents = 'none';
        }
    }
    
    // Ajoute un événement pour activer le mode édition sur les boutons "Modifier"
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            enableEditing(this);
        });
    });
    
    // Ajoute un événement pour sauvegarder les modifications sur les boutons "Sauvegarder"
    document.querySelectorAll('.save-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const fieldContainer = this.closest('.profile-field');
            const input = fieldContainer.querySelector('.profile-input');
            input.disabled = true; // Désactive le champ après sauvegarde
            saveField(this);
        });
    });
    
    // Ajoute un événement pour annuler les modifications sur les boutons "Annuler"
    document.querySelectorAll('.cancel-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            cancelField(this);
        });
    });
    
    // Suivi des modifications en temps réel dans les champs d'entrée
    document.querySelectorAll('.profile-input').forEach(input => {
        input.addEventListener('input', function() {
            const fieldContainer = this.closest('.profile-field');
            if (fieldContainer) {
                const fieldName = fieldContainer.dataset.field;
                modifiedFields.add(fieldName); // Ajoute le champ à l'ensemble des modifications
                
                // Active le bouton de soumission si des champs ont été modifiés
                if (modifiedFields.size > 0) {
                    submitAllBtn.classList.add('active');
                    submitAllBtn.style.opacity = '1';
                    submitAllBtn.style.pointerEvents = 'auto';
                }
            }
        });
    });
    
    // Gestion de la soumission du formulaire
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        const inputs = document.querySelectorAll('.profile-input');
        
        // Réactive tous les champs désactivés avant la soumission
        inputs.forEach(input => {
            input.disabled = false;
        });

        const modifiedFieldsArray = Array.from(modifiedFields); // Convertit l'ensemble en tableau
        
        // Supprime les champs cachés existants
        const hiddenFields = this.querySelectorAll('input[name="modified_fields[]"]');
        hiddenFields.forEach(field => field.remove());
        
        // Ajoute les champs modifiés comme champs cachés dans le formulaire
        modifiedFieldsArray.forEach(fieldName => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'modified_fields[]';
            input.value = fieldName;
            this.appendChild(input);
        });
        
        // Empêche la soumission si aucun champ n'a été modifié
        if (modifiedFieldsArray.length === 0) {
            e.preventDefault();
            alert('Aucune modification à enregistrer.');
        }
    });

    // Désactive tous les champs d'entrée au chargement de la page
    const editButtons = document.querySelectorAll('.edit-btn');
    const inputs = document.querySelectorAll('.profile-input');

    inputs.forEach(input => {
        input.disabled = true;
    });

    // Active un champ d'entrée lorsqu'on clique sur le bouton "Modifier"
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const fieldContainer = this.closest('.profile-field');
            const input = fieldContainer.querySelector('.profile-input');
            input.disabled = false; // Active le champ
            input.focus(); // Place le curseur dans le champ
        });
    });
});
