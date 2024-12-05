<?php
require("../../../Conexion/conexion.php"); // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos del formulario
    $documento = $_POST['documento'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $correo_institucional = $_POST['correo_institucional'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    // Validar que el documento ya exista en la tabla 'instructor'
    $query = "SELECT * FROM instructor WHERE documento = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('s', $documento);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // El instructor ya está registrado en la tabla 'instructor'
        echo json_encode(['success' => false, 'message' => 'El instructor ya está registrado en la tabla instructor']);
    } else {
        // Insertar el nuevo instructor si no está registrado en la tabla 'instructor'
        $query = "INSERT INTO instructor (documento, nombres, apellidos, correo, correo_institucional, direccion, telefono) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param('sssssss', $documento, $nombres, $apellidos, $correo, $correo_institucional, $direccion, $telefono);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Instructor creado con éxito']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al crear el instructor']);
        }
    }

    // Cerrar la conexión
    $stmt->close();
    $conexion->close();
} else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'load_instructors') {
    // Código para cargar los usuarios con rol "Instructor"
    $query = "SELECT documento, nombre FROM usuarios WHERE rol = 'Instructor'";
    $result = $conexion->query($query);

    $usuarios = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = [
                'documento' => $row['documento'],
                'nombre' => $row['nombre']
            ];
        }
    }

    // Devolver los resultados como JSON
    echo json_encode($usuarios);

    // Cerrar la conexión
    $conexion->close();
}
?>
