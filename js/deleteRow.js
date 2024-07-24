document.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', function() {
        var row = this.closest('tr');
        var id = row.querySelector('.edit_id').value;

        // Mostrar el mensaje de confirmación
        document.getElementById('overlay').style.display = 'block';
        document.getElementById('confirm-delete').style.display = 'block';

        // Configurar el botón "Sí"
        document.getElementById('confirm-yes').onclick = function() {
            // Crear una solicitud XMLHttpRequest
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "deleteSocio.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Manejar la respuesta de la solicitud
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    if (xhr.responseText.trim() == "success") {
                        row.remove();
                    } else {
                        alert("Error al eliminar el socio.");
                    }
                    document.getElementById('overlay').style.display = 'none';
                    document.getElementById('confirm-delete').style.display = 'none';
                }
            };

            // Enviar la solicitud con el id del socio a eliminar
            xhr.send("id=" + id);
        };

        // Configurar el botón "No"
        document.getElementById('confirm-no').onclick = function() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('confirm-delete').style.display = 'none';
        };
    });
});
