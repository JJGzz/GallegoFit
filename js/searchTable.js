document.getElementById('searchButton').addEventListener('click', function() {
    searchTable();
});

document.getElementById('searchInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Prevenir el comportamiento predeterminado del Enter
        document.getElementById('searchButton').click(); // Simular clic en el botón Buscar
    }
});

function searchTable() {
    var input = document.getElementById("searchInput");
    var filter = input.value.toLowerCase();
    var table = document.getElementById("sociosTable");
    var tr = table.getElementsByTagName("tr");

    for (var i = 1; i < tr.length; i++) {
        var tdName = tr[i].getElementsByTagName("td")[0];
        var tdSurname = tr[i].getElementsByTagName("td")[1];
        if (tdName || tdSurname) {
            var nameValue = tdName.textContent || tdName.innerText;
            var surnameValue = tdSurname.textContent || tdSurname.innerText;
            if (nameValue.toLowerCase().indexOf(filter) > -1 || surnameValue.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
