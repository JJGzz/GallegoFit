// togglePago.js
$(document).ready(function() {
    $('.toggle-pago').on('click', function() {
        var img = $(this);
        var id = img.data('id');
        var currentStatus = img.data('status');

        $.ajax({
            url: 'update_pago.php',
            type: 'POST',
            data: {
                id: id,
                currentStatus: currentStatus
            },
            success: function(response) {
                var result = JSON.parse(response);
                var newStatus = result.newStatus;

                // Actualizar el src y alt de la imagen
                img.attr('src', 'img/' + (newStatus ? 'on' : 'off') + '.png');
                img.attr('alt', newStatus ? 'On' : 'Off');
                img.data('status', newStatus);
            },
            error: function() {
                alert('Error al actualizar el estado de pago.');
            }
        });
    });
});
