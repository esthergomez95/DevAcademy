const radioButtons = document.querySelectorAll('input[name="plan"]');

radioButtons.forEach(radio => {
    radio.addEventListener('change', function() {
        const isPremium = document.getElementById('premium').checked;
        const freePlan = document.querySelector('.plan--free');
        const premiumPlan = document.querySelector('.plan--premium');

        if (isPremium) {
            freePlan.style.display = 'none';
            premiumPlan.style.display = 'block';
        } else {
            freePlan.style.display = 'block';
            premiumPlan.style.display = 'none';
        }
    });
});
