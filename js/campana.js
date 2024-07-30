// campana.js
$(document).ready(function() {
    // Función para actualizar el estado de la campana al cargar la página
    function updateBellIcon() {
        $.ajax({
            url: 'fetchNotificationData.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let storedUnpaidMembers = JSON.parse(localStorage.getItem('unpaidMembers')) || [];
                let currentUnpaidMembers = data.unpaidMembers;

                // Verificar si hay nuevos miembros impagos
                let hasNewUnpaidMembers = currentUnpaidMembers.some(member => {
                    return !storedUnpaidMembers.some(storedMember => storedMember.socios_name === member.socios_name && storedMember.socios_surname === member.socios_surname);
                });

                if (hasNewUnpaidMembers) {
                    $('#botonToggle img[src="img/bell.png"]').attr('src', 'img/bell2.png');
                    localStorage.setItem('unpaidMembers', JSON.stringify(currentUnpaidMembers));
                }
            }
        });
    }

    // Llamar a la función al cargar la página
    updateBellIcon();

    $('#botonToggle img[src="img/bell.png"], #botonToggle img[src="img/bell2.png"]').click(function(event) {
        event.stopPropagation();
        
        // Cambiar la imagen de la campana a bell.png cuando se hace clic
        $(this).attr('src', 'img/bell.png');

        // Añadir la clase de animación
        $(this).addClass('shake');
        
        // Eliminar la clase después de la animación
        setTimeout(() => {
            $(this).removeClass('shake');
        }, 600); // La duración de la animación es 0.6s
        
        $.ajax({
            url: 'fetchNotificationData.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let overlayContent = '<div class="combined-overlay-content">';
                overlayContent += '<div class="overlay-section">';
                overlayContent += '<h2>Cuotas cerca de vencer</h2>';
                overlayContent += '<ul>';

                if (data.pendingPayments.length === 0) {
                    overlayContent += '<li>No hay cuotas cerca de vencer</li>';
                } else {
                    data.pendingPayments.forEach(function(member) {
                        overlayContent += '<li>' + member.socios_name + ' ' + member.socios_surname + '</li>';
                    });
                }

                overlayContent += '</ul>';
                overlayContent += '</div>';

                overlayContent += '<div class="overlay-section">';
                overlayContent += '<h2>Cuotas vencidas</h2>';
                overlayContent += '<ul>';

                if (data.unpaidMembers.length === 0) {
                    overlayContent += '<li>No hay cuotas vencidas</li>';
                } else {
                    data.unpaidMembers.forEach(function(member) {
                        overlayContent += '<li>' + member.socios_name + ' ' + member.socios_surname + '</li>';
                    });
                }

                overlayContent += '</ul>';
                overlayContent += '</div>';
                overlayContent += '</div>';

                $('#combined-overlay').html(overlayContent);
                $('#combined-overlay').fadeIn();
            }
        });
    });

    $(document).on('click', '.close-overlay', function() {
        $(this).parent().fadeOut();
    });

    // Close overlay when clicking outside
    $(document).click(function(event) {
        if (!$(event.target).closest('#combined-overlay, #botonToggle img[src="img/bell.png"], #botonToggle img[src="img/bell2.png"]').length) {
            $('#combined-overlay').fadeOut();
        }
    });
});
