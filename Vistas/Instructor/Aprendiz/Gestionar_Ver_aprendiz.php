<?php
// Incluir el archivo de conexión a la base de datos
require("../../../Conexion/conexion.php");


// Consulta SQL para obtener los datos de la tabla `aprendiz`
$sql = "SELECT 
            documento, 
            nombres, 
            apellidos, 
            correo, 
            correo_institucional, 
            direccion, 
            telefono, 
            tipo_contrato, 
            Observaciones,
            ficha_id 
        FROM aprendiz";
$resultado = $conexion->query($sql);

$aprendices = [];

if ($resultado->num_rows > 0) {
    // Recorrer el resultado y almacenar en un array
    while ($fila = $resultado->fetch_assoc()) {
        $aprendices[] = [
            'documento' => htmlspecialchars($fila['documento']),
            'nombres' => htmlspecialchars($fila['nombres']),
            'apellidos' => htmlspecialchars($fila['apellidos']),
            'correo' => htmlspecialchars($fila['correo']),
            'correo_institucional' => htmlspecialchars($fila['correo_institucional']),
            'direccion' => htmlspecialchars($fila['direccion']),
            'telefono' => htmlspecialchars($fila['telefono']),
            'tipo_contrato' => htmlspecialchars($fila['tipo_contrato']),
            'Observaciones' => htmlspecialchars($fila['Observaciones']),
            'ficha_id' => htmlspecialchars($fila['ficha_id'])
            
        ];
    }
}

// Comprobar si hay un término de búsqueda
$terminoBusqueda = isset($_GET['busqueda']) ? $conexion->real_escape_string($_GET['busqueda']) : '';

// Consulta SQL para buscar en múltiples campos (insensible a mayúsculas/minúsculas)
$sql = "SELECT * FROM aprendiz";
if (!empty($terminoBusqueda)) {
    $sql .= " WHERE LOWER(nombres) LIKE LOWER('%$terminoBusqueda%') 
              OR LOWER(apellidos) LIKE LOWER('%$terminoBusqueda%') 
              OR LOWER(documento) LIKE LOWER('%$terminoBusqueda%') 
               OR LOWER(ficha_id) LIKE LOWER('%$terminoBusqueda%') 
              
              OR LOWER(correo) LIKE LOWER('%$terminoBusqueda%')";
}

$resultado = $conexion->query($sql);

$aprendices = [];
if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        $aprendices[] = $fila;
    }
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($aprendices);

// Cerrar la conexión
$conexion->close();
?>
