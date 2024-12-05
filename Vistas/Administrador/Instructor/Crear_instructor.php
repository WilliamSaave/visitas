<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/login.css">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <script src="../../../Js/sidebar.js" defer></script>
    <title>Crear Instructor</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>   <!--Esto es una bibilioteca que actuliza y usa la version de java para poder usar los jax -->
</head>
<body>
<?php include("../sidebar.php"); ?>
    <div class="login-box">
        <h2>Crear Instructor</h2>
        <form id="crear-instructor" method="post">
        <div class="user-box">
    <label for="search">Buscar Instructor:</label>
    <input type="text" id="search" placeholder="Escribe el nombre o documento..." onkeyup="filterInstructors()">


    <select id="documento" name="documento" required>
        <option value="">Cargando documentos...</option>
        <!-- Aquí se llenarán las opciones desde el servidor -->
    </select>
</div>

            <div class="user-box">
                <input type="text" id="nombres" name="nombres" required>
                <label for="nombres">Nombres:</label>
            </div>

            <div class="user-box">
                <input type="text" id="apellidos" name="apellidos" required>
                <label for="apellidos">Apellidos:</label>
            </div>

            <div class="user-box">
                <input type="email" id="correo" name="correo" required>
                <label for="correo">Correo:</label>
            </div>

            <div class="user-box">
                <input type="email" id="correo_institucional" name="correo_institucional">
                <label for="correo_institucional">Correo Institucional:</label>
            </div>

            <div class="user-box">
                <input type="text" id="direccion" name="direccion">
                <label for="direccion">Dirección:</label>
            </div>

            <div class="user-box">
                <input type="text" id="telefono" name="telefono">
                <label for="telefono">Teléfono:</label>
            </div>

            <button type="submit">
                Crear Instructor
                <span></span><span></span><span></span><span></span>
            </button>
        </form>
    </div>


    <script>
        // Cargar los documentos al cargar la página
        $(document).ready(function() {
            $.ajax({
                url: 'Gestionar_Crear_instructor.php?action=load_instructors',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var documentoSelect = $('#documento');
                    documentoSelect.empty(); // Limpiar opciones anteriores

                    if (data.length > 0) {
                        documentoSelect.append('<option value="">Seleccione un documento</option>');
                        $.each(data, function(index, usuario) {
                            documentoSelect.append('<option value="' + usuario.documento + '">' + usuario.documento + ' - ' + usuario.nombre + '</option>');
                        });
                    } else {
                        documentoSelect.append('<option value="">No hay instructores registrados</option>');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error al cargar los documentos: ' + error);
                }
            });
        });
        function filterInstructors() {
        const input = document.getElementById('search');
        const filter = input.value.toLowerCase();
        const select = document.getElementById('documento');
        const options = select.getElementsByTagName('option');

        // Iterar sobre las opciones del select
        for (let i = 1; i < options.length; i++) { // Comenzar en 1 para omitir el primer option
            const optionText = options[i].textContent.toLowerCase();
            const optionValue = options[i].value.toLowerCase();

            // Mostrar u ocultar opciones según la búsqueda
            if (optionText.includes(filter) || optionValue.includes(filter)) {
                options[i].style.display = ""; // Mostrar la opción
            } else {
                options[i].style.display = "none"; // Ocultar la opción
            }
        }
    }

        // Enviar formulario para crear un instructor
$('#crear-instructor').on('submit', function(e) {
    e.preventDefault(); // Evitar la recarga de la página

    $.ajax({
        url: 'Gestionar_Crear_instructor.php',
        method: 'POST',
        data: $(this).serialize(), // Serializar datos del formulario
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message);
           
            } else {
                alert(response.message); // Mensaje de error o instructor ya registrado
            }
        },
        error: function(xhr, status, error) {
            alert('Error en la solicitud: ' + error);
        }
    });
});

    </script>
</body>
</html>
