document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('transaction-form');
    const paymentMessage = document.getElementById('payment-message');

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const paymentMethod = document.querySelector('input[name="payment-method"]:checked').value;
        
        // Mock payment processing logic
        // we can replace this with actual payment gateway integration
        paymentMessage.textContent = `You have selected ${paymentMethod} as your payment method.`;

        // Simulate a successful transaction by redirecting to a confirmation page
        setTimeout(() => {
            window.location.href = 'confirmation.html';
        }, 2000);
    });
});
