<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/tablas.css">
    <script src="../../../Js/sidebar.js" defer></script>
    <title>Lista de Usuarios</title>
</head>

<body>
<?php include("../sidebar.php"); ?>

<h1>Lista de Usuarios</h1>

<!-- Campo de búsqueda -->
<input type="text" id="busqueda" placeholder="Buscar por correo, documento o rol" onkeyup="filtrarUsuarios()">



   <div class="Buscar-button">
    <button onclick="filtrarUsuarios()">Buscar</button>
</div>
<!-- Tabla donde se mostrarán los usuarios -->
<table id="tablaUsuarios">
    <thead>
        <tr>
            <th>Documento</th>
            <th>Correo</th>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Tipo de Documento</th>
          
            <th>Contraseña</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!-- Los datos de los usuarios se insertarán aquí -->
    </tbody>
</table>

<!-- Formulario de edición de usuario -->
<div id="editarUsuario" class="editar-form">
    <h2>Editar Usuario</h2>
    <form id="formEditar">
        <input type="hidden" name="documento" id="documento">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" required>
        <br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="rol">Rol:</label>
        <select name="rol" id="rol" required>
            <option value="Administrador">Administrador</option>
            <option value="Instructor">Instructor</option>
            <option value="Aprendiz">Aprendiz</option>
        </select>
        <br>
        <label for="tip_documento">Tipo de Documento:</label>
        <select name="tip_documento" id="tip_documento" required>
            <option value="CC">CC</option>

            <option value="NIT">NIT</option>
            <option value="Pasaporte">Pasaporte</option>
        </select>
        <br>
        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" id="contraseña">
        <br>
        <button type="submit">Guardar Cambios</button>
        <button type="button" onclick="cancelarEdicion()">Cancelar</button>
    </form>
</div>

<script>
// Función para cargar los datos de los usuarios
function cargarUsuarios() {
    // Hacer una solicitud AJAX a Gestionar_Ver_usuario.php
    fetch('Gestionar_Ver_usuario.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaUsuarios tbody');
            tbody.innerHTML = ''; // Limpiar la tabla

            // Recorrer los datos y agregarlos a la tabla
            data.forEach(usuario => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${usuario.documento}</td>
                    <td>${usuario.correo}</td>
                    <td>${usuario.nombre}</td>
                    <td>${usuario.rol}</td>
                    <td>${usuario.tip_documento}</td>
              
                    <td class="ver-contraseña" 
                        onmouseover="this.querySelector('.contraseña').type='text';" 
                        onmouseout="this.querySelector('.contraseña').type='password';">
                        <input type="password" class="contraseña" value="${usuario.contraseña}" readonly style="border: none; background: none; width: 100%;"/>
                    </td>
                    <td>
                     <button class="btn-estado ${usuario.activo === 'Sí' ? 'activo' : 'inactivo'}" 
                            onclick="cambiarEstado('${usuario.documento}', this)">
                            ${usuario.activo === 'Sí' ? 'Activo' : 'Inactivo'}
                        </button>
                        <button class="btn-editar" onclick="editarUsuario('${usuario.documento}', '${usuario.correo}', '${usuario.nombre}', '${usuario.rol}', '${usuario.tip_documento}')">Editar</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los usuarios:', error));
}

// Función para filtrar usuarios
function filtrarUsuarios() {
    const terminoBusqueda = document.getElementById('busqueda').value;

    fetch('Gestionar_Ver_usuario.php?busqueda=' + encodeURIComponent(terminoBusqueda))
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#tablaUsuarios tbody');
            tbody.innerHTML = ''; // Limpiar la tabla

            data.forEach(usuario => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${usuario.documento}</td>
                    <td>${usuario.correo}</td>
                    <td>${usuario.nombre}</td>
                    <td>${usuario.rol}</td>
                    <td>${usuario.tip_documento}</td>
                    <td class="ver-contraseña" 
                        onmouseover="this.querySelector('.contraseña').type='text';" 
                        onmouseout="this.querySelector('.contraseña').type='password';">
                        <input type="password" class="contraseña" value="${usuario.contraseña}" readonly style="border: none; background: none; width: 100%;"/>
                    </td>
                    <td>
                        <button class="btn-estado ${usuario.activo === '1' ? 'activo' : 'inactivo'}" 
                            onclick="cambiarEstado('${usuario.documento}', this)">
                            ${usuario.activo === '1' ? 'Activo' : 'Inactivo'}
                        </button>
                        <button class="btn-editar" onclick="editarUsuario('${usuario.documento}', '${usuario.correo}', '${usuario.nombre}', '${usuario.rol}', '${usuario.tip_documento}')">Editar</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al filtrar los usuarios:', error));
}


// Función para cambiar el estado de un usuario
function cambiarEstado(documento, boton) {
    const estadoActual = boton.textContent === 'Activo' ? '1' : '0';

    // Hacer una solicitud POST para actualizar el estado
    fetch('Gestionar_Ver_usuario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `documento=${documento}&estado=${estadoActual}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Cambiar el texto y clase del botón
            boton.textContent = data.nuevoEstado === 1 ? 'Activo' : 'Inactivo';
            boton.classList.toggle('activo', data.nuevoEstado === 1);
            boton.classList.toggle('inactivo', data.nuevoEstado === 0);
        } else {
            console.error('Error al cambiar el estado:', data.error);
        }
    })
    .catch(error => console.error('Error en la solicitud:', error));
}

// Función para editar un usuario
function editarUsuario(documento, correo, nombre, rol, tip_documento) {
    // Mostrar el formulario de edición y llenar los campos
    document.getElementById('documento').value = documento;
    document.getElementById('correo').value = correo;
    document.getElementById('nombre').value = nombre;
    document.getElementById('rol').value = rol;
    document.getElementById('tip_documento').value = tip_documento;
    
    document.getElementById('editarUsuario').style.display = 'block'; // Mostrar formulario
}

// Función para cancelar la edición
function cancelarEdicion() {
    document.getElementById('editarUsuario').style.display = 'none'; // Ocultar formulario
}

// Manejar la sumisión del formulario de edición
document.getElementById('formEditar').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir el comportamiento por defecto

    // Obtener los datos del formulario
    const formData = new FormData(this);
    formData.append('editar', true); // Añadir el indicador de edición

    // Hacer una solicitud POST para editar el usuario
    fetch('Gestionar_Ver_usuario.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Usuario actualizado con éxito.');
            cargarUsuarios(); // Recargar los usuarios para reflejar los cambios
            cancelarEdicion(); // Ocultar el formulario
        } else {
            console.error('Error al actualizar el usuario:', data.error);
            alert('Error al actualizar el usuario. Intente nuevamente.');
        }
    })
    .catch(error => console.error('Error en la solicitud:', error));
});

// Llamar a la función cuando la página se cargue
window.onload = cargarUsuarios;
</script>

</body>
</html>
