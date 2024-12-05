<?php    
require("../../../Conexion/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura y limpieza de datos
    $documento = trim($_POST["documento"]);
    $correo = filter_var($_POST["correo"], FILTER_SANITIZE_EMAIL);
    $contraseña = $_POST["contraseña"];
    $confirmar_contraseña = $_POST["confirmar_contraseña"];
    $nombre = trim($_POST["nombre"]);
    $rol = trim($_POST["rol"]);
    $tip_documento = trim($_POST["tip_documento"]);

    // Validaciones básicas
    if (empty($documento) || empty($correo) || empty($contraseña) || empty($nombre) || empty($tip_documento) || empty($rol)) {
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
        exit;
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Correo inválido."]);
        exit;
    }

    if ($contraseña !== $confirmar_contraseña) {
        echo json_encode(["success" => false, "message" => "Las contraseñas no coinciden."]);
        exit;
    }

    if (!in_array($rol, ["Administrador", "Instructor", "Aprendiz"])) {
        echo json_encode(["success" => false, "message" => "El rol seleccionado no es válido."]);
        exit;
    }

    // Verificar si el documento ya existe en la base de datos
    $sql_check = "SELECT 1 FROM Usuarios WHERE documento = ?";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->bind_param("s", $documento);

    if (!$stmt_check->execute()) {
        echo json_encode(["success" => false, "message" => "Error al verificar el documento."]);
        exit;
    }

    $result = $stmt_check->get_result();
    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "El usuario ya existe."]);
        exit;
    }

    $stmt_check->close();

    // Encriptar la contraseña
    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para insertar
    $sql = "INSERT INTO Usuarios (documento, correo, contraseña, nombre, rol, tip_documento, activo) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $activo = 1;
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssi", $documento, $correo, $hashed_password, $nombre, $rol, $tip_documento, $activo);

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
