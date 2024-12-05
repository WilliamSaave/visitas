<?php
// Conexión a la base de datos
require("../../../Conexion/conexion.php");

// Obtener el término de búsqueda
$terminoBusqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

// Construir la consulta SQL, incluyendo el cod_empresa
$sql = "SELECT nom_empresa, NIT, Direccion, correo, telefono, Encargado1, Correo_Encargado1, Telefono_Encargado1, Encargado2, Correo_Encargado2, Telefono_Encargado2, Cod_empresa 
        FROM empresas";

// Si se ha proporcionado un término de búsqueda, agregar el filtro
if (!empty($terminoBusqueda)) {
    $sql .= " WHERE LOWER(nom_empresa) LIKE LOWER(?) 
              OR LOWER(NIT) LIKE LOWER(?)";
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

$empresas = [];

if ($resultado->num_rows > 0) {
    // Recorrer el resultado y almacenar en un array
    while ($fila = $resultado->fetch_assoc()) {
        $empresas[] = [
            'nom_empresa' => htmlspecialchars($fila['nom_empresa']),
            'NIT' => htmlspecialchars($fila['NIT']),
            'Direccion' => htmlspecialchars($fila['Direccion']),
            'correo' => htmlspecialchars($fila['correo']),
            'telefono' => htmlspecialchars($fila['telefono']),
            'Encargado1' => htmlspecialchars($fila['Encargado1']),
            'Correo_Encargado1' => htmlspecialchars($fila['Correo_Encargado1']),
            'Telefono_Encargado1' => htmlspecialchars($fila['Telefono_Encargado1']),
            'Encargado2' => htmlspecialchars($fila['Encargado2']),
            'Correo_Encargado2' => htmlspecialchars($fila['Correo_Encargado2']),
            'Telefono_Encargado2' => htmlspecialchars($fila['Telefono_Encargado2']),
            'cod_empresa' => htmlspecialchars($fila['Cod_empresa'])  // Asegurarse de incluir cod_empresa
        ];
    }
}

// Comprobar si se ha recibido una solicitud de actualización de empresa
if (isset($_POST['editar']) && isset($_POST['NIT'])) {
    $nom_empresa = $conexion->real_escape_string($_POST['nom_empresa']);
    $NIT = $conexion->real_escape_string($_POST['NIT']);
    $Direccion = $conexion->real_escape_string($_POST['Direccion']);
    $correo = $conexion->real_escape_string($_POST['correo']);
    $telefono = $conexion->real_escape_string($_POST['telefono']);
    $Encargado1 = $conexion->real_escape_string($_POST['Encargado1']);
    $Correo_Encargado1 = $conexion->real_escape_string($_POST['Correo_Encargado1']);
    $Telefono_Encargado1 = $conexion->real_escape_string($_POST['Telefono_Encargado1']);
    $Encargado2 = $conexion->real_escape_string($_POST['Encargado2']);
    $Correo_Encargado2 = $conexion->real_escape_string($_POST['Correo_Encargado2']);
    $Telefono_Encargado2 = $conexion->real_escape_string($_POST['Telefono_Encargado2']);

    // Preparamos la consulta de actualización
    $sql = "UPDATE empresas SET 
        nom_empresa = '$nom_empresa', 
        Direccion = '$Direccion', 
        correo = '$correo', 
        telefono = '$telefono', 
        Encargado1 = '$Encargado1', 
        Correo_Encargado1 = '$Correo_Encargado1', 
        Telefono_Encargado1 = '$Telefono_Encargado1', 
        Encargado2 = '$Encargado2', 
        Correo_Encargado2 = '$Correo_Encargado2', 
        Telefono_Encargado2 = '$Telefono_Encargado2'
        WHERE NIT = '$NIT'";

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
echo json_encode($empresas);

// Cerrar la conexión
$conexion->close();
?>
