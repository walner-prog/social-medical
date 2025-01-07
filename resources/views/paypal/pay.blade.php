<!doctype html>
<html lang="en">
<head>
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('app.paypal_id') }}&currency=USD"></script>
</head>
<body>
    <h1>Selecciona tu plan de suscripción</h1>
    <button id="monthly" class="subscription-button" data-amount="5.00" data-plan="Mensual">Mensual ($5)</button>
    <button id="semiannual" class="subscription-button" data-amount="50.00" data-plan="Semestral">Semestral ($50)</button>
    <button id="annual" class="subscription-button" data-amount="80.00" data-plan="Anual">Anual ($80)</button>
    
    <div id="paypal-button-container"></div>

 <script>
document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded and parsed');
    const subscriptionButtons = document.querySelectorAll('.subscription-button');
    let selectedAmount = null;
    let selectedPlan = null;

    subscriptionButtons.forEach(button => {
        button.addEventListener('click', () => {
            selectedAmount = button.getAttribute('data-amount');
            selectedPlan = button.getAttribute('data-plan');
            document.getElementById('paypal-button-container').innerHTML = ''; // Reset PayPal buttons

            paypal.Buttons({
                createOrder: function(data, actions) {
                    console.log("Creating order", data);
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: selectedAmount
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    console.log("Order approved", data);
                    return actions.order.capture().then(function(details) {
                        console.log('Transaction completed by ' + details.payer.name.given_name);
                        // Enviar detalles al servidor
                        fetch('/save_subscription', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                orderID: data.orderID,
                                amount: selectedAmount,
                                plan: selectedPlan,
                                details: details
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                alert('Suscripción registrada exitosamente.');
                            } else {
                                console.error('Error del servidor:', data.message);
                            }
                        })
                        .catch(error => console.error('Error guardando la suscripción:', error));
                    });
                },
                onError: function(err) {
                    console.error('Error during transaction', err);
                }
            }).render('#paypal-button-container');
        });
    });
});

 </script>
</body>
</html>
