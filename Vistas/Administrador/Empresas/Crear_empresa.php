<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/fichas.css">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <script src="../../../Js/sidebar.js" defer></script>
    <title>Gestionar Empresas y Sedes</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="login-page">
<?php include("../sidebar.php"); ?>

<div class="container">
<div class="login-box">
<h2>Agregar Nueva Empresa</h2>
    <form id="crear-empresa" method="post">
    <div class="user-box">
        <input type="text" id="nom_empresa" name="nom_empresa" required>
        <label for="nom_empresa">Nombre de la Empresa:</label>
    </div>
    <div class="user-box">
        <input type="text" id="NIT" name="NIT" required>
        <label for="NIT">NIT:</label>
    </div>
    <div class="user-box">
        <input type="text" id="direccion_empresa" name="direccion_empresa" required>
        <label for="direccion_empresa">Dirección de la Empresa:</label>
    </div>
    <div class="user-box">
        <input type="email" id="correo_empresa" name="correo_empresa" required>
        <label for="correo_empresa">Correo de la Empresa:</label>
    </div>
    <div class="user-box">
        <input type="text" id="telefono_empresa" name="telefono_empresa" required>
        <label for="telefono_empresa">Telefono de la Empresa:</label>
    </div>
    <button type="submit">Crear Empresa</button>    
    </div>
</form>


    <!-- Formulario para agregar nueva sede -->
    <div class="login-box">
        <h2>Agregar Nueva Sede</h2>
        <form id="agregar-sede" method="post">
            <div class="user-box">
                <label for="empresa"></label>
                <select id="empresa" name="empresa" required>
                    <option value="">Cargando empresas...</option>
                    <!-- Opciones llenadas dinámicamente -->
                </select>
            </div>
            <div class="user-box">
                <input type="text" id="nombre_sede" name="nombre_sede" required>
                <label for="nombre_sede">Nombre de la Sede:</label>
            </div>
            <div class="user-box">
                <input type="text" id="direccion_sede" name="direccion_sede" required>
                <label for="direccion_sede">Dirección de la Sede:</label>
            </div>
            <div class="user-box">
                <input type="email" id="correo_sede" name="correo_sede" required>
                <label for="correo_sede">Correo de la Sede:</label>
            </div>
            <div class="user-box">
                <input type="text" id="telefono_sede" name="telefono_sede" required>
                <label for="telefono_se">Telefono de la sede:</label>
            </div>
            <button type="submit">Agregar Sede</button>
        </form>
    </div>
</div>

<script>
// Función para cargar las empresas existentes en el select
function cargarEmpresas() {
    fetch('Gestionar_Crear_empresa.php')
        .then(response => response.json())
        .then(data => {
            const selectEmpresas = document.getElementById('empresa');
            selectEmpresas.innerHTML = '<option value="">Seleccionar empresa</option>'; // Limpiar opciones

            data.forEach(empresa => {
                const option = document.createElement('option');
                option.value = empresa.Cod_empresa;
                option.textContent = empresa.nom_empresa;
                selectEmpresas.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar las empresas:', error));
}

// Llamar a la función al cargar la página
window.onload = cargarEmpresas;

// Manejar la creación de una nueva empresa
$('#crear-empresa').on('submit', function(event) {
    event.preventDefault();
    const datosEmpresa = {
        nom_empresa: $('#nom_empresa').val(),
        NIT: $('#NIT').val(),
        direccion_empresa: $('#direccion_empresa').val(),
        correo_empresa: $('#correo_empresa').val(),
        telefono_empresa: $('#telefono_empresa').val(),
    };

    // Validación de consola para verificar los datos capturados
    console.log(datosEmpresa);

    $.ajax({
        url: 'Gestionar_Crear_empresa.php',
        type: 'POST',
        data: datosEmpresa,
        success: function(response) {
            alert('Empresa creada con éxito');
            cargarEmpresas(); // Recargar las empresas en el select
        },
        error: function() {
            alert('Error al crear la empresa');
        }
    });
});

// Manejar la creación de una nueva sede
$('#agregar-sede').on('submit', function(event) {
    event.preventDefault();

    const datosSede = {
        nombre_sede: $('#nombre_sede').val(),
        direccion_sede: $('#direccion_sede').val(),
        correo_sede: $('#correo_sede').val(),
        telefono_sede: $('#telefono_sede').val(),
        cod_empresa: $('#empresa').val(),

        // Repite para encargado2 si lo deseas
    };

    if (!datosSede.cod_empresa) {
        alert('Por favor, selecciona una empresa.');
        return;
    }

    $.ajax({
        url: 'Gestionar_Crear_empresa.php',
        type: 'POST',
        data: datosSede,
        success: function(response) {
            alert('Sede agregada con éxito');
        },
        error: function() {
            alert('Error al agregar la sede');
        }
    });
});

</script>
</body>
</html>
