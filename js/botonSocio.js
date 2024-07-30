// Muestra el cuadro de agregar socio y rota la X a 45°


function toggleCuadro() {
    var cuadro = document.querySelector('.padre');
    var boton = document.querySelector('#botonToggle img');
    
    if (cuadro.style.display === 'none' || cuadro.style.display === '') {
        cuadro.style.display = 'block';
        boton.style.transform = 'rotate(45deg)'; // Rota la imagen 45 grados
    } else {
        cuadro.style.display = 'none';
        boton.style.transform = 'rotate(0deg)'; // Restaura la imagen a su rotación original
    }
}
