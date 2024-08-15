document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const navLinks = document.getElementById('nav-links');

    menuToggle.addEventListener('click', function() {
        navLinks.classList.toggle('active');
    });
});



//overlay agregar ejercicio

document.getElementById("agregarEjercicioBtn").onclick = function() {
    document.getElementById("overlay").style.display = "flex";
}

document.getElementById("closeOverlay").onclick = function() {
    document.getElementById("overlay").style.display = "none";
}

window.onclick = function(event) {
    if (event.target == document.getElementById("overlay")) {
        document.getElementById("overlay").style.display = "none";
    }
}


