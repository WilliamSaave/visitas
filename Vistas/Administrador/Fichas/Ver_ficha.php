<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/tablas.css">
    <script src="../../../Js/sidebar.js" defer></script>
    <title>Lista de Fichas</title>

</head>
<body>
<?php include("../sidebar.php"); ?>
<h1>Lista de Fichas</h1>
<input type="text" id="busqueda" placeholder="Buscar Ficha o Programa" onkeyup="filtrarFichas()">
<div class="Buscar-button">
    <button onclick="filtrarFichas()">Buscar</button>
</div>
<table id="tablaFichas">
    <thead>
        <tr>
            <th>Número de Ficha</th>
            <th>Nombre del Programa</th>
        </tr>
    </thead>
    <tbody>
        <!-- Los datos de las fichas se insertarán aquí -->
    </tbody>
</table>

<script>
// Función para cargar los datos de las fichas
function cargarFichas() {
    // Hacer una solicitud AJAX al archivo PHP
    fetch('Gestionar_Ver_Ficha.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaFichas tbody');
            tbody.innerHTML = ''; // Limpiar la tabla

            // Recorrer los datos y agregarlos a la tabla
            data.forEach(ficha => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${ficha.num_ficha}</td>
                    <td>${ficha.nombre_programa}</td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar las fichas:', error));
}

// Llamar a la función para cargar los datos cuando se carga la página
window.onload = cargarFichas;
function filtrarFichas() {
    const terminoBusqueda = document.getElementById('busqueda').value;

    fetch('Gestionar_Ver_Ficha.php?busqueda=' + encodeURIComponent(terminoBusqueda))
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaFichas tbody');
            tbody.innerHTML = ''; // Limpiar la tabla

            // Recorrer los datos y agregarlos a la tabla
            data.forEach(ficha => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${ficha.num_ficha}</td>
                    <td>${ficha.nombre_programa}</td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al filtrar las fichas:', error));
}

// Llamar a la función para cargar los datos cuando se carga la página
window.onload = filtrarFichas;
</script>

</body>
</html>
