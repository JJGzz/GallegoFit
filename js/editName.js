//Maneja la edicion del nombre de usuario

function enableNameEdit() {
    const nameInput = document.getElementById('name-input');
    document.getElementById('profile-name').style.display = 'none';
    nameInput.style.display = 'inline-block';
    document.getElementById('save-name-button').style.display = 'inline-block';
    
    nameInput.focus();
    nameInput.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            saveName();
        }
    });
}

function saveName() {
    const newName = document.getElementById('name-input').value;
    
    fetch('update_name.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ user_name: newName })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            document.getElementById('profile-name').innerText = newName;
            document.getElementById('profile-name').style.display = 'block';
            document.getElementById('name-input').style.display = 'none';
            document.getElementById('save-name-button').style.display = 'none';
        } else {
            alert('Error al actualizar el nombre');
        }
    })
    .catch(error => console.error('Error:', error));
}






// Muestra/oculta el overlay para cambiar la contraseña
function toggleChangePasswordForm() {
    const overlay = document.getElementById('change-password-overlay');
    overlay.style.display = (overlay.style.display === 'flex') ? 'none' : 'flex';
}

// Agregar evento al hacer clic en "Cambiar contraseña"
document.querySelector('.change-password').addEventListener('click', toggleChangePasswordForm);
