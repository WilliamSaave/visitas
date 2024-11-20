<?php
// Conexión a la base de datos
require("../../../Conexion/conexion.php");

// Obtener el término de búsqueda
$terminoBusqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

// Construir la consulta SQL
$sql = "SELECT ficha.num_ficha, ficha.nombre_programa 
        FROM ficha 
        INNER JOIN programa ON ficha.nombre_programa = programa.nombre_programa";

// Si se ha proporcionado un término de búsqueda, se agrega el filtro
if (!empty($terminoBusqueda)) {
    $sql .= " WHERE LOWER(ficha.num_ficha) LIKE LOWER(?) 
              OR LOWER(ficha.nombre_programa) LIKE LOWER(?)";
}

// Preparar la consulta SQL
$stmt = $conexion->prepare($sql);

// Si hay término de búsqueda, asignar los parámetros
if (!empty($terminoBusqueda)) {
    $param = "%$terminoBusqueda%";
    $stmt->bind_param("ss", $param, $param);
}

// Ejecutar la consulta
$stmt->execute();
$resultado = $stmt->get_result();

$fichas = [];

if ($resultado->num_rows > 0) {
    // Recorrer el resultado y almacenar en un array
    while ($fila = $resultado->fetch_assoc()) {
        $fichas[] = [
            'num_ficha' => htmlspecialchars($fila['num_ficha']),
            'nombre_programa' => htmlspecialchars($fila['nombre_programa']),
        ];
    }
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($fichas);

// Cerrar la conexión
$conexion->close();
?>
