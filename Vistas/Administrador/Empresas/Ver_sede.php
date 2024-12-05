<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/tablas.css">

    <script src="../../../Js/sidebar.js" defer></script>
    <title>Lista de Empresas</title>
</head>
<body>
    <?php include("../sidebar.php"); ?>
    <h1>Lista de Sedes</h1>

    <table id="tablaSedes">
        <thead>
            <tr>
                <th>Nombre de la Sede</th>
                <th>NIT</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Teléfono </th>
                <th>Acciones</th> 
            </tr>
        </thead>
        <tbody>
            <!-- Los datos de las empresas se insertarán aquí -->
        </tbody>
    </table>

  <!-- Modal para mostrar los detalles completos de la empresa -->
  <div id="modalEmpresa" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h2>Detalles de la Empresa</h2>
            <p><strong>Nombre:</strong> <span id="modalNombre"></span></p>
            <p><strong>NIT:</strong> <span id="modalNit"></span></p>
            <p><strong>Dirección:</strong> <span id="modalDireccion"></span></p>
            <p><strong>Correo:</strong> <span id="modalCorreo"></span></p>
            <p><strong>Teléfono:</strong> <span id="modalTelefono"></span></p>
            <p><strong>Encargado 1:</strong> <span id="modalEncargado1"></span></p>
            <p><strong>Correo Encargado 1:</strong> <span id="modalCorreoEncargado1"></span></p>
            <p><strong>Teléfono Encargado 1:</strong> <span id="modalTelefonoEncargado1"></span></p>
            <p><strong>Encargado 2:</strong> <span id="modalEncargado2"></span></p>
            <p><strong>Correo Encargado 2:</strong> <span id="modalCorreoEncargado2"></span></p>
            <p><strong>Teléfono Encargado 2:</strong> <span id="modalTelefonoEncargado2"></span></p>
        </div>
    </div>

    <div id="editarEmpresa" style="display: none;">
    <form id="formEditarSede">
        <label for="nombre">Nombre de la Empresa:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="NIT">NIT:</label>
        <input type="text" id="NIT" name="NIT" required>

        <label for="Direccion">Dirección:</label>
        <input type="text" id="Direccion" name="Direccion" required>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required>

        <label for="Encargado1">Encargado 1:</label>
        <input type="text" id="Encargado1" name="Encargado1" required>

        <label for="Correo_Encargado1">Correo Encargado 1:</label>
        <input type="email" id="Correo_Encargado1" name="Correo_Encargado1" required>

        <label for="Telefono_Encargado1">Teléfono Encargado 1:</label>
        <input type="text" id="Telefono_Encargado1" name="Telefono_Encargado1" required>

        <label for="Encargado2">Encargado 2:</label>
        <input type="text" id="Encargado2" name="Encargado2">

        <label for="Correo_Encargado2">Correo Encargado 2:</label>
        <input type="email" id="Correo_Encargado2" name="Correo_Encargado2">

        <label for="Telefono_Encargado2">Teléfono Encargado 2:</label>
        <input type="text" id="Telefono_Encargado2" name="Telefono_Encargado2">

        <button type="submit">Guardar cambios</button>
        <button type="button" onclick="cancelarEdicion()">Cancelar</button>
    </form>
</div>
<div class="Buscar-button">
    <button onclick="location.href='Ver_empresa.php'">volver</button>
</div>
<script>
    // Función para cargar los datos de las sedes
    function cargarSedes() {
    const urlParams = new URLSearchParams(window.location.search);
    const codEmpresa = urlParams.get('cod_empresa');  // Obtener cod_empresa de la URL

    fetch(`Gestionar_Ver_sede.php?cod_empresa=${codEmpresa}`)
        .then(response => {
            console.log('Respuesta completa:', response);
            return response.json();
        })
        .then(data => {
            console.log('Datos recibidos:', data);
            const tbody = document.querySelector('#tablaSedes tbody');
            tbody.innerHTML = ''; // Limpiar la tabla

            // Verificar si hay datos
            if (data.length === 0) {
                console.log('No se encontraron sedes.');
                return;
            }

            // Recorrer los datos y agregarlos a la tabla
            data.forEach(sede => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${sede.nombre}</td>
                    <td>${sede.Nit}</td>
                    <td>${sede.direccion}</td>
                    <td>${sede.correo}</td>
                    <td>${sede.telefono}</td>
                    <td>
                        <button onclick="verMas('${sede.nombre}', '${sede.Nit}', '${sede.direccion}', '${sede.correo}', '${sede.telefono}', '${sede.Encargado1}', '${sede.correo_encargado1}', '${sede.telefono_encargado1}', '${sede.Encargado2}', '${sede.correo_encargado2}', '${sede.telefono_encargado2}')">Detalles</button>
                        <button onclick="editarSede('${sede.nombre}', '${sede.Nit}', '${sede.direccion}', '${sede.correo}', '${sede.telefono}', '${sede.Encargado1}', '${sede.correo_encargado1}', '${sede.telefono_encargado1}', '${sede.Encargado2}', '${sede.correo_encargado2}', '${sede.telefono_encargado2}')">Editar</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar las sedes:', error));
}

    // Función para mostrar más detalles en el modal
    function verMas(nombre, Nit, direccion, correo, telefono, Encargado1, correo_encargado1, telefono_encargado1, Encargado2, correo_encargado2, telefono_encargado2) {
        document.getElementById('modalNombre').innerText = nombre;
        document.getElementById('modalNit').innerText = Nit;
        document.getElementById('modalDireccion').innerText = direccion;
        document.getElementById('modalCorreo').innerText = correo;
        document.getElementById('modalTelefono').innerText = telefono;
        document.getElementById('modalEncargado1').innerText = Encargado1;
        document.getElementById('modalCorreoEncargado1').innerText = correo_encargado1;
        document.getElementById('modalTelefonoEncargado1').innerText = telefono_encargado1;
        document.getElementById('modalEncargado2').innerText = Encargado2;
        document.getElementById('modalCorreoEncargado2').innerText = correo_encargado2;
        document.getElementById('modalTelefonoEncargado2').innerText = telefono_encargado2;

        document.getElementById('modalSede').style.display = 'flex'; // Mostrar modal
    }

    // Función para cerrar el modal
    function cerrarModal() {
        document.getElementById('modalSede').style.display = 'none';
    }

  

    function editarSede(nombre, Nit, direccion, correo, telefono, Encargado1, correo_encargado1, telefono_encargado1, Encargado2, correo_encargado2, telefono_encargado2) {
        // Mostrar el formulario de edición y llenar los campos con los datos de la sede
        document.getElementById('nombre').value = nombre;
        document.getElementById('Nit').value = Nit;
        document.getElementById('direccion').value = direccion;
        document.getElementById('correo').value = correo;
        document.getElementById('telefono').value = telefono;
        document.getElementById('Encargado1').value = Encargado1;
        document.getElementById('correo_encargado1').value = correo_encargado1;
        document.getElementById('telefono_encargado1').value = telefono_encargado1;
        document.getElementById('Encargado2').value = Encargado2;
        document.getElementById('correo_encargado2').value = correo_encargado2;
        document.getElementById('telefono_encargado2').value = telefono_encargado2;

        document.getElementById('editarSede').style.display = 'block'; // Mostrar el formulario
    }

    // Función para cancelar la edición
    function cancelarEdicion() {
        document.getElementById('editarSede').style.display = 'none'; // Ocultar el formulario
    }

    // Manejar la sumisión del formulario de edición
    document.getElementById('formEditarSede').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el comportamiento por defecto

        // Obtener los datos del formulario
        const formData = new FormData(this);
        formData.append('editar', true); // Añadir el indicador de edición

        // Hacer una solicitud POST para editar la sede
        fetch('Gestionar_Ver_sede.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Sede actualizada con éxito.');
                cargarSedes(); // Recargar las sedes para reflejar los cambios
                cancelarEdicion(); // Ocultar el formulario
            } else {
                console.error('Error al actualizar la sede:', data.error);
                alert('Error al actualizar la sede. Intente nuevamente.');
            }
        })
        .catch(error => console.error('Error en la solicitud:', error));
    });

    window.onload = cargarSedes;
</script>


</body>
</html>
