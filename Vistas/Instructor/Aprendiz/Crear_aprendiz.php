<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/login.css">
    <script src="../../../Js/sidebar.js" defer></script>
    <title>Crear Aprendiz</title>
    <script>
        function filtrarDocumentos() {
            let input = document.getElementById("buscarDocumento").value.toLowerCase();
            let options = document.getElementById("documento").options;
            for (let i = 0; i < options.length; i++) {
                let texto = options[i].text.toLowerCase();
                options[i].style.display = texto.includes(input) ? "" : "none";
            }
        }

        function filtrarFichas() {
            let input = document.getElementById("buscarFicha").value.toLowerCase();
            let options = document.getElementById("ficha_id").options;
            for (let i = 0; i < options.length; i++) {
                let texto = options[i].text.toLowerCase();
                options[i].style.display = texto.includes(input) ? "" : "none";
            }
        }

        function crearAprendiz(event) {
            event.preventDefault(); // Evita que el formulario recargue la página

            const formData = new FormData(document.getElementById("formAprendiz"));

            fetch("Gestionar_Crear_aprendiz.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message); // Muestra el mensaje de éxito
                    document.getElementById("formAprendiz").reset(); // Limpia el formulario
                } else {
                    alert(data.message); // Muestra el mensaje de error
                }
            })
            .catch(error => {
                alert("El aprendiz ya se encuentra registrado");
                console.error("Error:", error);
            });
        }
    </script>
</head>
<body>
    <?php include("../sidebar.php"); ?>
    
    <div class="login-box">
        <h2>Crear Aprendiz</h2>

        <form id="formAprendiz" onsubmit="crearAprendiz(event)">
            <div class="user-box">
                
                <input type="text" id="buscarDocumento" onkeyup="filtrarDocumentos()" placeholder="Buscar..." required>
                <label for="buscarDocumento">Buscar Documento o Nombre:</label>
            </div>

            <div class="user-box">
                <select name="documento" id="documento" required>
                <option value="">Cargando documentos...</option>
                    <?php
                    require("../../../Conexion/conexion.php");
                    $queryUsuarios = "SELECT documento, nombre FROM usuarios WHERE rol = 'Aprendiz'";
                    $resultUsuarios = $conexion->query($queryUsuarios);
                    while ($row = $resultUsuarios->fetch_assoc()) {
                        echo "<option value='" . $row['documento'] . "'>" . $row['documento'] . " - " . $row['nombre'] . "</option>";
                    }
                    ?>
                </select>
                <label for="documento"></label>
            </div>

            <div class="user-box">
                <input type="text" id="buscarFicha" onkeyup="filtrarFichas()" placeholder="Buscar..." required>
                <label for="buscarFicha">Buscar Ficha o Programa:</label>
            </div>

            <div class="user-box">
                <select name="ficha_id" id="ficha_id" required>
                <option value="">Cargando Fichas...</option>
                    <?php
                    $queryFichas = "SELECT num_ficha, nombre_programa FROM ficha";
                    $resultFichas = $conexion->query($queryFichas);
                    while ($ficha = $resultFichas->fetch_assoc()) {
                        echo "<option value='" . $ficha['num_ficha'] . "'>" . $ficha['num_ficha'] . " - " . $ficha['nombre_programa'] . "</option>";
                    }
                    ?>
                </select>
                <label for="ficha_id"></label>
            </div>

            <div class="user-box">
                <input type="text" name="nombres" id="nombres" required>
                <label for="nombres">Nombres:</label>
            </div>

            <div class="user-box">
                <input type="text" name="apellidos" id="apellidos" required>
                <label for="apellidos">Apellidos:</label>
            </div>

            <div class="user-box">
                <input type="email" name="correo" id="correo" required>
                <label for="correo">Correo:</label>
            </div>

            <div class="user-box">
                <input type="email" name="correo_institucional" id="correo_institucional" required>
                <label for="correo_institucional">Correo Institucional:</label>
            </div>

            <div class="user-box">
                <input type="text" name="direccion" id="direccion" required>
                <label for="direccion">Dirección:</label>
            </div>

            <div class="user-box">
                <input type="text" name="telefono" id="telefono" required>
                <label for="telefono">Teléfono:</label>
            </div>

            <button type="submit">
                Crear Aprendiz
                <span></span><span></span><span></span><span></span>
            </button>
        </form>
    </div>
</body>

</html>
