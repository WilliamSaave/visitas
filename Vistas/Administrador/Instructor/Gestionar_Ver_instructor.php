<?php 
// Incluir el archivo de conexión a la base de datos
require("../../../Conexion/conexion.php");

// Comprobar si se ha recibido una solicitud de actualización de instructor
if (isset($_POST['editar']) && isset($_POST['documento'])) {
    $documento = $conexion->real_escape_string($_POST['documento']);
    $nombres = $conexion->real_escape_string($_POST['nombres']);
    $apellidos = $conexion->real_escape_string($_POST['apellidos']);
    $correo = $conexion->real_escape_string($_POST['correo']);
    $correo_institucional = $conexion->real_escape_string($_POST['correo_institucional']);
    $direccion = $conexion->real_escape_string($_POST['direccion']);
    $telefono = $conexion->real_escape_string($_POST['telefono']);
    $observaciones = $conexion->real_escape_string($_POST['observaciones']);
    
    // Preparamos la consulta de actualización
    $sql = "UPDATE instructor SET 
                nombres = '$nombres', 
                apellidos = '$apellidos', 
                correo = '$correo', 
                correo_institucional = '$correo_institucional', 
                direccion = '$direccion', 
                telefono = '$telefono', 

                observaciones = '$observaciones' 
            WHERE documento = '$documento'";
    
    if ($conexion->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conexion->error]);
    }
    $conexion->close();
    exit();
}

// Consulta SQL para obtener los datos de la tabla 'instructor'
$sql = "SELECT documento, nombres, apellidos, correo, correo_institucional, direccion, telefono, observaciones FROM instructor";
$resultado = $conexion->query($sql);

$instructores = [];

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $instructores[] = [
            'documento' => htmlspecialchars($fila['documento']),
            'nombres' => htmlspecialchars($fila['nombres']),
            'apellidos' => htmlspecialchars($fila['apellidos']),
            'correo' => htmlspecialchars($fila['correo']),
            'correo_institucional' => htmlspecialchars($fila['correo_institucional']),
            'direccion' => htmlspecialchars($fila['direccion']),
            'telefono' => htmlspecialchars($fila['telefono']),

            'observaciones' => htmlspecialchars($fila['observaciones'])
        ];
    }
}

// Manejar la búsqueda si hay un término de búsqueda
$terminoBusqueda = isset($_GET['busqueda']) ? $conexion->real_escape_string($_GET['busqueda']) : '';

$sql = "SELECT * FROM instructor";
if (!empty($terminoBusqueda)) {
    $sql .= " WHERE LOWER(nombres) LIKE LOWER('%$terminoBusqueda%') 
              OR LOWER(apellidos) LIKE LOWER('%$terminoBusqueda%') 
              OR LOWER(documento) LIKE LOWER('%$terminoBusqueda%') 
              OR LOWER(correo) LIKE LOWER('%$terminoBusqueda%') 
              OR LOWER(correo_institucional) LIKE LOWER('%$terminoBusqueda%')";
}

$resultado = $conexion->query($sql);

$instructores = [];
if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        $instructores[] = $fila;
    }
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($instructores);

// Cerrar la conexión
$conexion->close();
?>
