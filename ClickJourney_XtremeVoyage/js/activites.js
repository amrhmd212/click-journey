
        document.addEventListener('DOMContentLoaded', function () {
            const activityCards = document.querySelectorAll('.activity-card');
            const totalActivitiesSpan = document.getElementById('total-activities');
            const totalPriceSpan = document.getElementById('total-price');

            let totalActivities = 0;
            let totalPrice = 0;

            activityCards.forEach(card => {
                const price = parseFloat(card.dataset.price);
                const name = card.dataset.name;
                const plusBtn = card.querySelector('.quantity-btn:last-child');
                const minusBtn = card.querySelector('.quantity-btn:first-child');
                const countSpan = card.querySelector('.selected-count');
                const inputQte = card.querySelector(`input[name="activites[${name}][qte]"]`);


                let count = 0;

                plusBtn.addEventListener('click', () => {
                    count++;
                    countSpan.textContent = count;
                    totalActivities++;
                    totalPrice += price;
                    inputQte.value = count;
                    updateSummary();
                });

                minusBtn.addEventListener('click', () => {
                    if (count > 0) {
                        count--;
                        countSpan.textContent = count;
                        totalActivities--;
                        totalPrice -= price;
                        inputQte.value = count;
                        updateSummary();
                    }
                });

            });

            function updateSummary() {
                const nbActivitiesSelected = Array.from(document.querySelectorAll('.activity-card'))
                    .filter(card => parseInt(card.querySelector('.selected-count').textContent) > 0).length;

                totalActivitiesSpan.textContent = nbActivitiesSelected;
                totalPriceSpan.textContent = totalPrice.toFixed(2) + ' €';
            }
        });
