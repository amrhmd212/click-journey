document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.user-actions form');

        forms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const button = this.querySelector('button');
                button.disabled = true;
                button.textContent = 'Modification...';

                
                setTimeout(() => {
                    this.submit();
                }, 1000);
            });
        });
    });
