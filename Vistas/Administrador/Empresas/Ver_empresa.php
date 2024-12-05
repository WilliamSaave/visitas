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
    <h1>Lista de Empresas</h1>
    <input type="text" id="busqueda" placeholder="Buscar por Empresa o NIT" onkeyup="filtrarDatos()">
    <div class="Buscar-button">
        <button onclick="filtrarDatos()">Buscar</button>
    </div>

    <table id="tablaEmpresas">
        <thead>
            <tr>
                <th>Nombre de la Empresa</th>
                <th>NIT</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Teléfono </th>
                <th>Acciones</th> 
                <th>Sedes</th> 
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
            <p><strong>Nombre:</strong> <span id="modalNomEmpresa"></span></p>
            <p><strong>NIT:</strong> <span id="modalNIT"></span></p>
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
    <form id="formEditarEmpresa">
        <label for="nom_empresa">Nombre de la Empresa:</label>
        <input type="text" id="nom_empresa" name="nom_empresa" required>

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



    <script>
    // Función para cargar los datos de las empresas
    function cargarEmpresas() {
        fetch('Gestionar_Ver_empresa.php')
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector('#tablaEmpresas tbody');
                tbody.innerHTML = ''; // Limpiar la tabla

                // Recorrer los datos y agregarlos a la tabla
                data.forEach(empresa => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${empresa.nom_empresa}</td>
                        <td>${empresa.NIT}</td>
                        <td>${empresa.Direccion}</td>
                        <td>${empresa.correo}</td>
                        <td>${empresa.telefono}</td>
                        <td><button onclick="verMas('${empresa.nom_empresa}', '${empresa.NIT}', '${empresa.Direccion}', '${empresa.correo}', '${empresa.telefono}', '${empresa.Encargado1}', '${empresa.Correo_Encargado1}', '${empresa.Telefono_Encargado1}', '${empresa.Encargado2}', '${empresa.Correo_Encargado2}', '${empresa.Telefono_Encargado2}')">Detalles</button>
                    <button onclick="editarEmpresa('${empresa.nom_empresa}', '${empresa.NIT}', '${empresa.Direccion}', '${empresa.correo}', '${empresa.telefono}', '${empresa.Encargado1}', '${empresa.Correo_Encargado1}', '${empresa.Telefono_Encargado1}', '${empresa.Encargado2}', '${empresa.Correo_Encargado2}', '${empresa.Telefono_Encargado2}')">Editar</button></td>
              <td><button onclick="verSedes(${empresa.cod_empresa})">Sedes</button></td>`;
                    tbody.appendChild(row);
                });
            })
            .catch(error => console.error('Error al cargar las empresas:', error));
    }
    function verSedes(codEmpresa) {
    console.log('codEmpresa:', codEmpresa);  // Agregar un log para depurar
    window.location.href = `Ver_sede.php?cod_empresa=${codEmpresa}`;
}



    // Función para mostrar más detalles en el modal
    function verMas(nom_empresa, NIT, Direccion, correo, telefono, Encargado1, Correo_Encargado1, Telefono_Encargado1, Encargado2, Correo_Encargado2, Telefono_Encargado2) {
        document.getElementById('modalNomEmpresa').innerText = nom_empresa;
        document.getElementById('modalNIT').innerText = NIT;
        document.getElementById('modalDireccion').innerText = Direccion;
        document.getElementById('modalCorreo').innerText = correo;
        document.getElementById('modalTelefono').innerText = telefono;
        document.getElementById('modalEncargado1').innerText = Encargado1;
        document.getElementById('modalCorreoEncargado1').innerText = Correo_Encargado1;
        document.getElementById('modalTelefonoEncargado1').innerText = Telefono_Encargado1;
        document.getElementById('modalEncargado2').innerText = Encargado2;
        document.getElementById('modalCorreoEncargado2').innerText = Correo_Encargado2;
        document.getElementById('modalTelefonoEncargado2').innerText = Telefono_Encargado2;

        document.getElementById('modalEmpresa').style.display = 'flex'; // Mostrar modal
    }

    // Función para cerrar el modal
    function cerrarModal() {
        document.getElementById('modalEmpresa').style.display = 'none';
    }

    // Función para filtrar los datos de las empresas
    function filtrarDatos() {
        const terminoBusqueda = document.getElementById('busqueda').value;

        fetch('Gestionar_Ver_empresa.php?busqueda=' + encodeURIComponent(terminoBusqueda))
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector('#tablaEmpresas tbody');
                tbody.innerHTML = ''; // Limpiar la tabla

                // Recorrer los datos filtrados y agregarlos a la tabla
                data.forEach(empresa => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                       <td>${empresa.nom_empresa}</td>
                        <td>${empresa.NIT}</td>
                        <td>${empresa.Direccion}</td>
                        <td>${empresa.correo}</td>
                        <td>${empresa.telefono}</td>
                        <td><button onclick="verMas('${empresa.nom_empresa}', '${empresa.NIT}', '${empresa.Direccion}', '${empresa.correo}', '${empresa.telefono}', '${empresa.Encargado1}', '${empresa.Correo_Encargado1}', '${empresa.Telefono_Encargado1}', '${empresa.Encargado2}', '${empresa.Correo_Encargado2}', '${empresa.Telefono_Encargado2}')">Detalles</button>
                    <button onclick="editarEmpresa('${empresa.nom_empresa}', '${empresa.NIT}', '${empresa.Direccion}', '${empresa.correo}', '${empresa.telefono}', '${empresa.Encargado1}', '${empresa.Correo_Encargado1}', '${empresa.Telefono_Encargado1}', '${empresa.Encargado2}', '${empresa.Correo_Encargado2}', '${empresa.Telefono_Encargado2}')">Editar</button></td>
             <td><button onclick="verSedes(${empresa.cod_empresa})">Sedes</button></td>`;
                    tbody.appendChild(row);
                });
            })
            .catch(error => console.error('Error al filtrar los datos de empresas:', error));
    }
    function editarEmpresa(nom_empresa, NIT, Direccion, correo, telefono, Encargado1, Correo_Encargado1, Telefono_Encargado1, Encargado2, Correo_Encargado2, Telefono_Encargado2) {
    // Mostrar el formulario de edición y llenar los campos con los datos de la empresa
    document.getElementById('nom_empresa').value = nom_empresa;
    document.getElementById('NIT').value = NIT;
    document.getElementById('Direccion').value = Direccion;
    document.getElementById('correo').value = correo;
    document.getElementById('telefono').value = telefono;
    document.getElementById('Encargado1').value = Encargado1;
    document.getElementById('Correo_Encargado1').value = Correo_Encargado1;
    document.getElementById('Telefono_Encargado1').value = Telefono_Encargado1;
    document.getElementById('Encargado2').value = Encargado2;
    document.getElementById('Correo_Encargado2').value = Correo_Encargado2;
    document.getElementById('Telefono_Encargado2').value = Telefono_Encargado2;

    document.getElementById('editarEmpresa').style.display = 'block'; // Mostrar el formulario
}

// Función para cancelar la edición
function cancelarEdicion() {
    document.getElementById('editarEmpresa').style.display = 'none'; // Ocultar el formulario
}

// Manejar la sumisión del formulario de edición
document.getElementById('formEditarEmpresa').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir el comportamiento por defecto

    // Obtener los datos del formulario
    const formData = new FormData(this);
    formData.append('editar', true); // Añadir el indicador de edición

    // Hacer una solicitud POST para editar la empresa
    fetch('Gestionar_Ver_empresa.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Empresa actualizada con éxito.');
            cargarEmpresas(); // Recargar las empresas para reflejar los cambios
            cancelarEdicion(); // Ocultar el formulario
        } else {
            console.error('Error al actualizar la empresa:', data.error);
            alert('Error al actualizar la empresa. Intente nuevamente.');
        }
    })
    .catch(error => console.error('Error en la solicitud:', error));
});
    // Llamar a la función para cargar los datos cuando se carga la página
    window.onload = cargarEmpresas;
    </script>


</body>
</html>
