<?php
require("../Conexion/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["documento"]) && isset($_POST["clave"])) {
        $documento_ingresado = $_POST["documento"];
        $clave_ingresada = $_POST["clave"];

        // Preparar la consulta SQL
        $sql = "SELECT * FROM Usuarios WHERE documento = ? AND contraseña = ?";
        $stmt = $conexion->prepare($sql);

        $stmt->bind_param("ss", $documento_ingresado, $clave_ingresada);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            echo json_encode(["success" => false, "message" => "Error en la consulta: " . $conexion->error]);
        } else {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Verificar si el usuario está activo
                if ($row['activo'] == 1) {
                    session_start();
                    $_SESSION['documento'] = $documento_ingresado;
                    $_SESSION['rol'] = $row['rol'];

                    // Guardar el documento para futuras consultas
                    $_SESSION['usuario'] = $documento_ingresado;

                    // Redirigir según el rol del usuario
                    if ($row['rol'] == 'Administrador') {
                        echo json_encode(["success" => true, "redirect" => "../Vistas/Administrador/Index.php"]);
                    } elseif ($row['rol'] == 'Aprendiz') {
                        echo json_encode(["success" => true, "redirect" => "../Vistas/Aprendiz/Index.php"]);
                    } elseif ($row['rol'] == 'Instructor') {
                        echo json_encode(["success" => true, "redirect" => "../Vistas/Instructor/Index.php"]);
                    } else {
                        echo json_encode(["success" => false, "message" => "Rol no reconocido."]);
                    }
                } else {
                    echo json_encode(["success" => false, "message" => "El usuario está inactivo. Por favor, contacte al administrador."]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Documento o clave incorrectos. Inténtelo de nuevo."]);
            }
        }
    } else {
        echo json_encode(["success" => false, "message" => "Ingrese su documento y clave"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Solicitud no válida"]);
}
?>
