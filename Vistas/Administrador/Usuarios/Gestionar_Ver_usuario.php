<?php
// Incluir el archivo de conexión a la base de datos
require("../../../Conexion/conexion.php");

// Comprobar si se ha recibido una solicitud de actualización de estado
if (isset($_POST['documento']) && isset($_POST['estado'])) {
    $documento = $conexion->real_escape_string($_POST['documento']);
    $nuevoEstado = $_POST['estado'] === '1' ? 0 : 1; // Cambiar el estado

    // Actualizar el estado en la base de datos
    $sql = "UPDATE usuarios SET activo = $nuevoEstado WHERE documento = '$documento'";
    
    if ($conexion->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'nuevoEstado' => $nuevoEstado]);
    } else {
        echo json_encode(['success' => false, 'error' => $conexion->error]);
    }
    $conexion->close();
    exit(); // Finalizar la ejecución del script aquí
}

// Comprobar si se ha recibido una solicitud de actualización de usuario
if (isset($_POST['editar']) && isset($_POST['documento'])) {
    $documento = $conexion->real_escape_string($_POST['documento']);
    $correo = $conexion->real_escape_string($_POST['correo']);
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $rol = $conexion->real_escape_string($_POST['rol']);
    $tip_documento = $conexion->real_escape_string($_POST['tip_documento']);
    $contraseña = $conexion->real_escape_string($_POST['contraseña']);
    
    // Preparamos la consulta de actualización
    $sql = "UPDATE usuarios SET correo = '$correo', nombre = '$nombre', rol = '$rol', tip_documento = '$tip_documento'";
    
    // Si se proporciona una nueva contraseña, la actualizamos
    if (!empty($contraseña)) {
        // Asegúrate de que estás utilizando un método seguro para almacenar contraseñas
        $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);
        $sql .= ", contraseña = '$hashed_password'"; // Actualiza la contraseña con el hash
    }

    $sql .= " WHERE documento = '$documento'";
    
    if ($conexion->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conexion->error]);
    }
    $conexion->close();
    exit(); // Finalizar la ejecución del script aquí
}

// Consulta SQL para obtener los datos de la tabla 'usuarios'
$sql = "SELECT documento, correo, nombre, rol, tip_documento, activo, contraseña FROM usuarios";
$resultado = $conexion->query($sql);

$usuarios = [];

if ($resultado->num_rows > 0) {
    // Recorrer el resultado y almacenar en un array
    while ($fila = $resultado->fetch_assoc()) {
        $usuarios[] = [
            'documento' => htmlspecialchars($fila['documento']),
            'correo' => htmlspecialchars($fila['correo']),
            'nombre' => htmlspecialchars($fila['nombre']),
            'rol' => htmlspecialchars($fila['rol']),
            'tip_documento' => htmlspecialchars($fila['tip_documento']),
            'activo' => $fila['activo'] ? 'Sí' : 'No',
            'contraseña' => htmlspecialchars($fila['contraseña']) // Asegúrate de escapar la contraseña
        ];
    }
}


$terminoBusqueda = isset($_GET['busqueda']) ? $conexion->real_escape_string($_GET['busqueda']) : '';

// Consulta SQL para buscar en múltiples campos (insensible a mayúsculas/minúsculas)
$sql = "SELECT * FROM usuarios";
if (!empty($terminoBusqueda)) {
    $sql .= " WHERE LOWER(nombre) LIKE LOWER('%$terminoBusqueda%') 
              OR LOWER(correo) LIKE LOWER('%$terminoBusqueda%') 
              OR LOWER(documento) LIKE LOWER('%$terminoBusqueda%') 
              OR LOWER(rol) LIKE LOWER('%$terminoBusqueda%')";
}

$resultado = $conexion->query($sql);

$usuarios = [];
if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
    }
}
// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($usuarios);

// Cerrar la conexión
$conexion->close();
?>
