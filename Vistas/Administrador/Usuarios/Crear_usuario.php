<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../../../css/login.css">
    <link rel="stylesheet" href="../../../css/sidebar.css">

    <script src="../../../Js/sidebar.js" defer></script>
</head>

<body>
<?php include("../sidebar.php"); ?>
    <div class="login-box">
        <img src="../../../Imagenes/logoSena1.png" alt="Logo" class="logoSena">
        <h2>Registro de Usuario</h2>
        <form id="form-registro">
            <div class="user-box">
                <input type="text" id="documento" name="documento" required>
                <label for="documento">Documento:</label>
            </div>
            <div class="user-box">
                <select id="tip_documento" name="tip_documento" required>
                    <option value="CC">CC</option>
                    <option value="NIT">TI</option>
                    <option value="Pasaporte">Pasaporte</option>
                </select>
                <label for="tip_documento">Tipo de Documento:</label>
            </div>
            <div class="user-box">
                <input type="email" id="correo" name="correo" required>
                <label for="correo">Correo:</label>
            </div>
            <div class="user-box">
                <input type="text" id="nombre" name="nombre" required>
                <label for="nombre">Nombre:</label>
            </div>
            <div class="user-box">
                <input type="password" id="contraseña" name="contraseña" required>
                <label for="contraseña">Contraseña:</label>
            </div>
            <div class="user-box">
                <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" required>
                <label for="confirmar_contraseña">Confirmar Contraseña:</label>
            </div>
            <div class="user-box">
                <select id="rol" name="rol" required>
                    <option value="Administrador">Administrador</option>
                    <option value="Instructor">Instructor</option>
                    <option value="Aprendiz">Aprendiz</option>
                </select>
                <label for="rol">Rol:</label>
            </div>
            <button type="submit" class="submit-btn">Registrar nuevo usuario
                <span></span><span></span><span></span><span></span> 
            </button>
        </form>
        <div class="message" id="message"></div>
    </div>

    <script>
        document.getElementById("form-registro").addEventListener("submit", function(event) {
            event.preventDefault();

            var form = document.getElementById("form-registro");
            var formData = new FormData(form);

            fetch("Gestionar_Crear_usuario.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                var messageDiv = document.getElementById("message");
                messageDiv.textContent = data.message;
                messageDiv.style.color = data.success ? "green" : "red";    
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
    </script>
</body>
</html>
