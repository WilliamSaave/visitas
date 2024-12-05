<?php
// Conexión a la base de datos
require("../../../Conexion/conexion.php");

// Obtener el cod_empresa de los parámetros GET
$codEmpresa = isset($_GET['cod_empresa']) ? $_GET['cod_empresa'] : ''; 

// Verificar que se haya recibido el cod_empresa
if (empty($codEmpresa)) {
    echo json_encode([]); // Si no hay cod_empresa, devolver un array vacío
    exit;
}

// Construir la consulta SQL para obtener las sedes relacionadas con la empresa
$sql = "SELECT nombre, Nit, direccion, correo, telefono, Encargado1, correo_encargado1, telefono_encargado1, Encargado2, correo_encargado2, telefono_encargado2 
        FROM sede 
        WHERE cod_empresa = ?";

// Preparar la consulta SQL
$stmt = $conexion->prepare($sql);

// Asignar el parámetro cod_empresa
$stmt->bind_param("i", $codEmpresa);

// Ejecutar la consulta
$stmt->execute();
$resultado = $stmt->get_result();

// Crear un array para almacenar los resultados
$sedes = [];

while ($row = $resultado->fetch_assoc()) {
    $sedes[] = $row;  // Agregar cada sede al array
}
if ($resultado->num_rows > 0) {
    // Recorrer el resultado y almacenar en un array
    while ($fila = $resultado->fetch_assoc()) {
        $sedes[] = [
            'nombre' => htmlspecialchars($fila['nombre']),
            'Nit' => htmlspecialchars($fila['Nit']),
            'direccion' => htmlspecialchars($fila['direccion']),
            'correo' => htmlspecialchars($fila['correo']),
            'telefono' => htmlspecialchars($fila['telefono']),
            'Encargado1' => htmlspecialchars($fila['Encargado1']),
            'correo_encargado1' => htmlspecialchars($fila['correo_encargado1']),
            'telefono_encargado1' => htmlspecialchars($fila['telefono_encargado1']),
            'Encargado2' => htmlspecialchars($fila['Encargado2']),
            'correo_encargado2' => htmlspecialchars($fila['correo_encargado2']),
            'telefono_encargado2' => htmlspecialchars($fila['telefono_encargado2']),
        ];
    }
}

// Comprobar si se ha recibido una solicitud de actualización de sede
if (isset($_POST['editar']) && isset($_POST['Nit'])) {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $Nit = $conexion->real_escape_string($_POST['Nit']);
    $direccion = $conexion->real_escape_string($_POST['direccion']);
    $correo = $conexion->real_escape_string($_POST['correo']);
    $telefono = $conexion->real_escape_string($_POST['telefono']);
    $Encargado1 = $conexion->real_escape_string($_POST['Encargado1']);
    $correo_encargado1 = $conexion->real_escape_string($_POST['correo_encargado1']);
    $telefono_encargado1 = $conexion->real_escape_string($_POST['telefono_encargado1']);
    $Encargado2 = $conexion->real_escape_string($_POST['Encargado2']);
    $correo_encargado2 = $conexion->real_escape_string($_POST['correo_encargado2']);
    $telefono_encargado2 = $conexion->real_escape_string($_POST['telefono_encargado2']);

    // Preparamos la consulta de actualización
    $sql = "UPDATE sede SET 
        nombre = '$nombre', 
        direccion = '$direccion', 
        correo = '$correo', 
        telefono = '$telefono', 
        Encargado1 = '$Encargado1', 
        correo_encargado1 = '$correo_encargado1', 
        telefono_encargado1 = '$telefono_encargado1', 
        Encargado2 = '$Encargado2', 
        correo_encargado2 = '$correo_encargado2', 
        telefono_encargado2 = '$telefono_encargado2'
        WHERE Nit = '$Nit'";

    if ($conexion->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conexion->error]);
    }
    $conexion->close();
    exit();
}


 

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($sedes);

// Cerrar la conexión
$conexion->close();
?>
