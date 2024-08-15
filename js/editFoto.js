// Maneja el cambio de fotos, y cambia el boton de agregado de la foto

function toggleEditForm() {
    var overlay = document.getElementById('edit-form-overlay');

    // Mostrar u ocultar el overlay sin afectar .profile-header
    if (overlay.style.display === 'none' || overlay.style.display === '') {
        overlay.style.display = 'flex';
    } else {
        overlay.style.display = 'none';
        if (cropper) {
            cropper.destroy(); // Destruir la instancia de Cropper si existe
            cropper = null;
        }
    }
}

let cropper;

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('img').addEventListener('change', function(e) {
        const file = e.target.files[0];
        var profileHeader = document.querySelector('.profile-header'); // Seleccionar el contenedor profile-header

        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const image = document.getElementById('image-preview');
                image.src = event.target.result;
                if (cropper) {
                    cropper.destroy(); // Destruir la instancia anterior de Cropper si existe
                }
                cropper = new Cropper(image, {
                    aspectRatio: 1, // Mantén la relación de aspecto cuadrada (1:1)
                    viewMode: 2,    // Asegura que el recorte encaje dentro del contenedor
                });

                // Ocultar profile-header cuando se selecciona una imagen y se inicia el recorte
                profileHeader.style.display = 'none';

                const label = document.querySelector('label[for="img"]');
                label.style.textAlign = "center";
                document.getElementById("green").style.textAlign = "center"; 
                label.style.backgroundColor = 'green';
            };
            reader.readAsDataURL(file);
        } else {
            const label = document.querySelector('label[for="img"]');
            label.innerText = "Selecciona una nueva imagen";
            label.classList.remove('grey-label');
        }
    });
});

// Manejar el botón "Cancelar" para cerrar el overlay y redirigir a cuenta.php
document.querySelector('button[onclick="toggleEditForm()"]').addEventListener('click', function() {
    window.location.href = 'cuenta.php'; // Redirigir a cuenta.php
});




document.getElementById('crop-form').addEventListener('submit', function(e) {
    e.preventDefault();
    if (cropper) {
        // Obtener el canvas con la imagen recortada y redimensionar si es necesario
        const canvas = cropper.getCroppedCanvas({
            maxWidth: 500,  // Tamaño máximo en píxeles de ancho
            maxHeight: 500, // Tamaño máximo en píxeles de alto
        });

        // Convertir el canvas a un blob
        canvas.toBlob(function(blob) {
            if (blob) {
                const formData = new FormData();
                formData.append('cropped_img', blob, 'cropped.jpg');

                // Enviar la imagen recortada al servidor
                fetch('upload.php', {
                    method: 'POST',
                    body: formData,
                }).then((response) => {
                    if (response.ok) {
                        console.log('Imagen recortada enviada correctamente.');
                        toggleEditForm(); // Cierra el overlay
                        // Recargar la página después de una pequeña demora para asegurar que la imagen se haya guardado
                        setTimeout(() => {
                            window.location.reload();
                        }, 500); // Esperar 500ms antes de recargar
                    } else {
                        console.error('Error en la respuesta del servidor.');
                    }
                }).catch((error) => {
                    console.error('Error al enviar la imagen recortada:', error);
                });
            } else {
                console.error('No se pudo generar el blob de la imagen recortada.');
            }
        }, 'image/jpeg');
    }
});


