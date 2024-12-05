<?php    
require("../../../Conexion/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST["documento"];
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];
    $confirmar_contraseña = $_POST["confirmar_contraseña"];
    $nombre = $_POST["nombre"];
    $rol = $_POST["rol"];
    $tip_documento = $_POST["tip_documento"];

    // Verificar si las contraseñas coinciden
    if ($contraseña !== $confirmar_contraseña) {
        echo json_encode(["success" => false, "message" => "Las contraseñas no coinciden."]);
        exit;
    }

    // Verificar si el documento ya existe en la base de datos
    $sql_check = "SELECT * FROM Usuarios WHERE documento = ?";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->bind_param("s", $documento);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "El usuario ya existe."]);
        exit;
    }

    // Encriptar la contraseña
    if (!empty($contraseña)) {
        $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);
    } else {
        echo json_encode(["success" => false, "message" => "La contraseña no puede estar vacía."]);
        exit;
    }

    // Preparar la consulta SQL para insertar
    $sql = "INSERT INTO Usuarios (documento, correo, contraseña, nombre, rol, tip_documento, activo) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $activo = 1;
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssss", $documento, $correo, $hashed_password, $nombre, $rol, $tip_documento, $activo);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Usuario creado exitosamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al crear el usuario: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Solicitud no válida."]);
}

$conexion->close();
?>
