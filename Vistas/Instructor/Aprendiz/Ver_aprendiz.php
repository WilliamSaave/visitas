<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/tablas.css">
    <script src="../../../Js/sidebar.js" defer></script>
    <title>Lista de Aprendices</title>
</head>

<body>
<?php include("../sidebar.php"); ?>

<h1>Lista de Aprendices</h1>

<!-- Campo de búsqueda -->
<input type="text" id="busqueda" placeholder="Buscar por documento, nombre, o tipo de contrato" onkeyup="filtrarAprendices()">
<div class="Buscar-button">
    <button onclick="filtrarAprendices()">Buscar</button>
</div>

<!-- Tabla donde se mostrarán los aprendices -->
<table id="tablaAprendices">
    <thead>
        <tr>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Correo Institucional</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Tipo de Contrato</th>
            <th>Ficha</th>
        </tr>
    </thead>
    <tbody>
        <!-- Los datos de los aprendices se insertarán aquí -->
    </tbody>
</table>

<script>
// Función para cargar los datos de los aprendices
function cargarAprendices() {
    fetch('Gestionar_Ver_aprendiz.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaAprendices tbody');
            tbody.innerHTML = ''; // Limpiar la tabla

            data.forEach(aprendiz => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${aprendiz.documento}</td>
                    <td>${aprendiz.nombres}</td>
                    <td>${aprendiz.apellidos}</td>
                    <td>${aprendiz.correo}</td>
                    <td>${aprendiz.correo_institucional}</td>
                    <td>${aprendiz.direccion}</td>
                    <td>${aprendiz.telefono}</td>
                    <td>${aprendiz.tipo_contrato}</td>
                     <td>${aprendiz.ficha_id}</td>
                   
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los aprendices:', error));
}

// Función para filtrar aprendices
function filtrarAprendices() {
    const terminoBusqueda = document.getElementById('busqueda').value;

    fetch('Gestionar_Ver_aprendiz.php?busqueda=' + encodeURIComponent(terminoBusqueda))
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaAprendices tbody');
            tbody.innerHTML = ''; // Limpiar la tabla

            data.forEach(aprendiz => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${aprendiz.documento}</td>
                    <td>${aprendiz.nombres}</td>
                    <td>${aprendiz.apellidos}</td>
                    <td>${aprendiz.correo}</td>
                    <td>${aprendiz.correo_institucional}</td>
                    <td>${aprendiz.direccion}</td>
                    <td>${aprendiz.telefono}</td>
                    <td>${aprendiz.tipo_contrato}</td>
                    <td>${aprendiz.ficha_id}</td>
                   
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al filtrar los aprendices:', error));
}


window.onload = cargarAprendices;
</script>

</body>
</html>
