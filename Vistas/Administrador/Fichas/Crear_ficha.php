<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/fichas.css">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <script src="../../../Js/sidebar.js" defer></script>
    <title>Gestionar Programas y Fichas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="login-page">
<?php include("../sidebar.php"); ?>

<div class="container">
<div class="login-box">
    <h2>Crear Nuevo Programa</h2>
    <form id="crear-programa" method="post">
        <div class="user-box">
            <input type="text" id="nombre_programa" name="nombre_programa" required>
            <label for="nombre_programa">Nombre del Programa:</label>
        </div>

        <button type="submit">
            Crear Programa
            <span></span><span></span><span></span><span></span>
        </button>
    </form>
</div>


<!-- Sección para agregar una ficha -->
<div class="login-box">
    <h2>Agregar Nueva Ficha</h2>
    <form id="agregar-ficha" method="post">
        <div class="user-box">
            <label for="programa"></label>
            <select id="programa" name="programa" required>
                <option value="">Cargando programas...</option>
                <!-- Aquí se llenarán las opciones con los programas existentes -->
            </select>
        </div>

        <div class="user-box">
            <input type="number" id="num_ficha" name="num_ficha" required>
            <label for="num_ficha">Número de Ficha:</label>
        </div>

        <button type="submit">
            Agregar Ficha
            <span></span><span></span><span></span><span></span>
        </button>
    </form>
</div>

</div>
<script>
// Función para cargar los programas existentes en el select
function cargarProgramas() {
    fetch('Gestionar_Crear_ficha.php')
        .then(response => response.json())
        .then(data => {
            const selectProgramas = document.getElementById('programa');
            selectProgramas.innerHTML = '<option value="">Seleccionar programa</option>'; // Limpiar las opciones

            data.forEach(programa => {
                const option = document.createElement('option');
                option.value = programa.nombre_programa;
                option.textContent = programa.nombre_programa;
                selectProgramas.appendChild(option);
            });
        })
        .catch(error => console.error('Error al cargar los programas:', error));
}

// Llamar a la función cuando se cargue la página
window.onload = cargarProgramas;
// Manejar la creación de un nuevo programa
$('#crear-programa').on('submit', function(event) {
    event.preventDefault();
    const nombrePrograma = $('#nombre_programa').val();

    console.log("Enviando nombre del programa: ", nombrePrograma); // Verificación de datos

    $.ajax({
        url: 'Gestionar_Crear_ficha.php',
        type: 'POST',
        data: { nombre_programa: nombrePrograma },
        success: function(response) {
            console.log("Respuesta del servidor (programa):", response); // Ver el resultado de la solicitud
            alert('Programa creado con éxito');
            cargarProgramas(); // Recargar la lista de programas
        },
        error: function() {
            alert('Error al crear el programa');
        }
    });
});

// Manejar la creación de una nueva ficha
$('#agregar-ficha').on('submit', function(event) {
    event.preventDefault();

    const numFicha = $('#num_ficha').val();
    const nombrePrograma = $('#programa').val();

    console.log("Datos enviados a la API:", { num_ficha: numFicha, nombre_programa: nombrePrograma });

    if (!numFicha || !nombrePrograma) {
        alert('Por favor completa todos los campos.');
        return;
    }

    $.ajax({
        url: 'Gestionar_Crear_ficha.php',
        type: 'POST',
        data: { num_ficha: numFicha, nombre_programa: nombrePrograma },
        success: function(response) {
            console.log("Respuesta del servidor (ficha):", response); // Ver respuesta

            let result;
            try {
                result = JSON.parse(response);
            } catch (error) {
                console.error("Error al parsear la respuesta:", error);
                alert('Error inesperado en el servidor.');
                return;
            }

            if (result.success) {
                alert('Ficha agregada con éxito');
            } else {
                alert('Error al agregar la ficha: ' + (result.error || 'Error desconocido'));
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
            alert('Error en la solicitud AJAX');
        }
    });
});



</script>
</body>
</html>
