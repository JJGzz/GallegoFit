document.addEventListener('DOMContentLoaded', function() {
    const togglePagoElements = document.querySelectorAll('.toggle-pago');

    togglePagoElements.forEach(element => {
        element.addEventListener('click', function() {
            const socioId = this.getAttribute('data-id');
            const currentStatus = this.getAttribute('data-status');

            // Realizar la solicitud AJAX para actualizar el estado
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'togglePago.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    // Actualizar la imagen y el estado
                    const newStatus = this.responseText;
                    element.setAttribute('data-status', newStatus);
                    element.setAttribute('src', 'img/' + (newStatus === '1' ? 'on' : 'off') + '.png');
                }
            };
            xhr.send('id=' + socioId + '&status=' + currentStatus);
        });
    });
});
