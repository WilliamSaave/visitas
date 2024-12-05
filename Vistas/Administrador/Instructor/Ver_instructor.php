<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/tablas.css">
    <script src="../../../Js/sidebar.js" defer></script>
    <title>Lista de Instructores</title>
</head>

<body>
<?php include("../sidebar.php"); ?>

<h1>Lista de Instructores</h1>

<!-- Campo de búsqueda -->
<input type="text" id="busqueda" placeholder="Buscar por nombre, apellido, documento o correo" onkeyup="filtrarInstructores()">
<div class="Buscar-button">
    <button onclick="filtrarInstructores()">Buscar</button>
</div>

<!-- Tabla para mostrar los instructores -->
<table id="tablaInstructores">
    <thead>
        <tr>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Correo Institucional</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Observaciones</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!-- Los datos de los instructores se insertarán aquí -->
    </tbody>
</table>

<!-- Formulario de edición de instructor -->
<div id="editarInstructor" class="editar-form">
    <h2>Editar Instructor</h2>
    <form id="formEditar">
        <input type="hidden" name="documento" id="documento">
        <label for="nombres">Nombres:</label>
        <input type="text" name="nombres" id="nombres" required>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" required>
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" required>
        <label for="correo_institucional">Correo Institucional:</label>
        <input type="email" name="correo_institucional" id="correo_institucional" required>
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion">
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono">
        <label for="observaciones">Observaciones:</label>
        <textarea name="observaciones" id="observaciones"></textarea>
        <button type="submit">Guardar Cambios</button>
        <button type="button" onclick="cancelarEdicion()">Cancelar</button>
    </form>
</div>

<script>
function cargarInstructores() {
    fetch('Gestionar_Ver_instructor.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaInstructores tbody');
            tbody.innerHTML = '';
            data.forEach(instructor => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${instructor.documento}</td>
                    <td>${instructor.nombres}</td>
                    <td>${instructor.apellidos}</td>
                    <td>${instructor.correo}</td>
                    <td>${instructor.correo_institucional}</td>
                    <td>${instructor.direccion}</td>
                    <td>${instructor.telefono}</td>
                    <td>${instructor.observaciones}</td>
                    <td>
                        <button onclick="editarInstructor('${instructor.documento}', '${instructor.nombres}', '${instructor.apellidos}', '${instructor.correo}', '${instructor.correo_institucional}', '${instructor.direccion}', '${instructor.telefono}', '${instructor.observaciones}')">Editar</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los instructores:', error));
}

function filtrarInstructores() {
    const terminoBusqueda = document.getElementById('busqueda').value;
    fetch('Gestionar_Ver_instructor.php?busqueda=' + encodeURIComponent(terminoBusqueda))
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaInstructores tbody');
            tbody.innerHTML = '';
            data.forEach(instructor => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${instructor.documento}</td>
                    <td>${instructor.nombres}</td>
                    <td>${instructor.apellidos}</td>
                    <td>${instructor.correo}</td>
                    <td>${instructor.correo_institucional}</td>
                    <td>${instructor.direccion}</td>
                    <td>${instructor.telefono}</td>
                    <td>${instructor.observaciones}</td>
                    <td>
                        <button onclick="editarInstructor('${instructor.documento}', '${instructor.nombres}', '${instructor.apellidos}', '${instructor.correo}', '${instructor.correo_institucional}', '${instructor.direccion}', '${instructor.telefono}', '${instructor.observaciones}')">Editar</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al filtrar los instructores:', error));
}

function editarInstructor(documento, nombres, apellidos, correo, correo_institucional, direccion, telefono, observaciones) {
    document.getElementById('documento').value = documento;
    document.getElementById('nombres').value = nombres;
    document.getElementById('apellidos').value = apellidos;
    document.getElementById('correo').value = correo;
    document.getElementById('correo_institucional').value = correo_institucional;
    document.getElementById('direccion').value = direccion;
    document.getElementById('telefono').value = telefono;
    document.getElementById('observaciones').value = observaciones;
    document.getElementById('editarInstructor').style.display = 'block';
}

function cancelarEdicion() {
    document.getElementById('editarInstructor').style.display = 'none';
}

document.getElementById('formEditar').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    formData.append('editar', true);

    fetch('Gestionar_Ver_instructor.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Instructor actualizado con éxito.');
            cargarInstructores();
            cancelarEdicion();
        } else {
            alert('Error al actualizar el instructor.');
        }
    })
    .catch(error => console.error('Error en la solicitud:', error));
});

window.onload = cargarInstructores;
</script>
</body>
</html>
