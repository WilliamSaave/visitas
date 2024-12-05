<?php
require("../Conexion/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["documento"]) && isset($_POST["clave"])) {
        $documento_ingresado = $_POST["documento"];
        $clave_ingresada = $_POST["clave"];

        // Preparar la consulta SQL
        $sql = "SELECT * FROM Usuarios WHERE documento = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $documento_ingresado);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            echo json_encode(["success" => false, "message" => "Error en la consulta: " . $conexion->error]);
        } else {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                // Verificar si el usuario está activo
                if ($row['activo'] == 1) {
                    // Verificar la contraseña usando password_verify
                    if (password_verify($clave_ingresada, $row['contraseña'])) {
                        session_start();
                        $_SESSION['documento'] = $documento_ingresado;
                        $_SESSION['rol'] = $row['rol'];

                        // Redirigir según el rol del usuario
                        if ($row['rol'] == 'Administrador') {
                            echo json_encode(["success" => true, "redirect" => "../Vistas/Administrador/Sidebar.php"]);
                        } elseif ($row['rol'] == 'Aprendiz') {
                            echo json_encode(["success" => true, "redirect" => "../Vistas/Aprendiz/Index.php"]);
                        } elseif ($row['rol'] == 'Instructor') {
                            echo json_encode(["success" => true, "redirect" => "../Vistas/Instructor/Sidebar.php"]);
                        }
                    } else {
                        echo json_encode(["success" => false, "message" => "Documento o clave incorrectos. Inténtelo de nuevo."]);
                    }
                } else {
                    echo json_encode(["success" => false, "message" => "Su cuenta está inactiva. Por favor, contacte al administrador."]);
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