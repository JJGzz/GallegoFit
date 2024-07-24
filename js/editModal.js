
// Obtiene el modal
var modal = document.getElementById("editModal");

// Obtiene el botón que cierra el modal
var span = document.getElementsByClassName("close")[0];

// Cuando el usuario haga clic en el botón de editar
document.querySelectorAll('.edit-button').forEach(button => {
    button.addEventListener('click', function() {
        var row = this.closest('tr');
        var id = row.querySelector('.edit_id').value;
        var name = row.querySelector('.edit_socios_name').textContent;
        var surname = row.querySelector('.edit_socios_surname').textContent;
        var email = row.querySelector('.edit_email').textContent;

        document.getElementById('edit_id').value = id;
        document.getElementById('edit_socios_name').value = name;
        document.getElementById('edit_socios_surname').value = surname;
        document.getElementById('edit_email').value = email;

        modal.style.display = "block";
    });
});

// Cuando el usuario haga clic en <span> (x), cierra el modal
span.onclick = function() {
    modal.style.display = "none";
}

// Cuando el usuario haga clic fuera del modal, cierra el modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
