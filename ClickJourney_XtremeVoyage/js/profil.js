
        document.addEventListener('DOMContentLoaded', function() {
            const modifiedFields = new Set();
            const submitAllBtn = document.querySelector('.submit-all-btn');
            
            function enableEditing(field) {
                const fieldContainer = field.closest('.profile-field');
                const input = fieldContainer.querySelector('.profile-input');
                const value = fieldContainer.querySelector('.field-value');
                
                input.classList.add('active');
                value.classList.add('hidden');
            }
            
            function disableEditing(field) {
                const fieldContainer = field.closest('.profile-field');
                const input = fieldContainer.querySelector('.profile-input');
                const value = fieldContainer.querySelector('.field-value');
                
                input.classList.remove('active');
                value.classList.remove('hidden');
            }
            
            function saveField(field) {
                const fieldContainer = field.closest('.profile-field');
                const input = fieldContainer.querySelector('.profile-input');
                const value = fieldContainer.querySelector('.field-value');
                const fieldName = fieldContainer.dataset.field;
                
                value.textContent = input.value;
                modifiedFields.add(fieldName);
                disableEditing(field);
                
                if (modifiedFields.size > 0) {
                    submitAllBtn.classList.add('active');
                    submitAllBtn.style.opacity = '1';
                    submitAllBtn.style.pointerEvents = 'auto';
                }
            }
            
            function cancelField(field) {
                const fieldContainer = field.closest('.profile-field');
                const input = fieldContainer.querySelector('.profile-input');
                const value = fieldContainer.querySelector('.field-value');
                const fieldName = fieldContainer.dataset.field;
                
                input.value = value.textContent;
                modifiedFields.delete(fieldName);
                disableEditing(field);
                
                if (modifiedFields.size === 0) {
                    submitAllBtn.classList.remove('active');
                    submitAllBtn.style.opacity = '0.5';
                    submitAllBtn.style.pointerEvents = 'none';
                }
            }
            
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    enableEditing(this);
                });
            });
            
            document.querySelectorAll('.save-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const fieldContainer = this.closest('.profile-field');
                    const input = fieldContainer.querySelector('.profile-input');
                    input.disabled = true; 
                    saveField(this);
                });
            });
            
            document.querySelectorAll('.cancel-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    cancelField(this);
                });
            });
            
            document.querySelectorAll('.profile-input').forEach(input => {
                input.addEventListener('input', function() {
                    const fieldContainer = this.closest('.profile-field');
                    if (fieldContainer) {
                        const fieldName = fieldContainer.dataset.field;
                        modifiedFields.add(fieldName);
                        
                        if (modifiedFields.size > 0) {
                            submitAllBtn.classList.add('active');
                            submitAllBtn.style.opacity = '1';
                            submitAllBtn.style.pointerEvents = 'auto';
                        }
                    }
                });
            });
            
            document.getElementById('profileForm').addEventListener('submit', function(e) {
                const inputs = document.querySelectorAll('.profile-input');


                inputs.forEach(input => {
                    input.disabled = false;
                });

                const modifiedFieldsArray = Array.from(modifiedFields);
                

                const hiddenFields = this.querySelectorAll('input[name="modified_fields[]"]');
                hiddenFields.forEach(field => field.remove());
                

                modifiedFieldsArray.forEach(fieldName => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'modified_fields[]';
                    input.value = fieldName;
                    this.appendChild(input);
                });
                
                if (modifiedFieldsArray.length === 0) {
                    e.preventDefault();
                    alert('Aucune modification à enregistrer.');
                }
            });

            const editButtons = document.querySelectorAll('.edit-btn');
            const inputs = document.querySelectorAll('.profile-input');


            inputs.forEach(input => {
                input.disabled = true;
            });


            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const fieldContainer = this.closest('.profile-field');
                    const input = fieldContainer.querySelector('.profile-input');
                    input.disabled = false;
                    input.focus();
                });
            });
        });
