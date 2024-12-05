<?php
require("../../../Conexion/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear empresa
    if (isset($_POST['nom_empresa']) && isset($_POST['NIT']) && !isset($_POST['nombre_sede'])) {
        $nom_empresa = $_POST['nom_empresa'];
        $NIT = $_POST['NIT'];
        $direccion_empresa = $_POST['direccion_empresa'];
        $correo_empresa = $_POST['correo_empresa'];
        $telefono_empresa = $_POST['telefono_empresa'];

        $sql = "INSERT INTO empresas (nom_empresa, NIT, Direccion, correo, telefono) VALUES (?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssss", $nom_empresa, $NIT, $direccion_empresa, $correo_empresa, $telefono_empresa);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $stmt->close();
    }

}


// Agregar sede
if (isset($_POST['nombre_sede']) && isset($_POST['cod_empresa'])) {
    $nombre_sede = $_POST['nombre_sede'];
    $direccion_sede = $_POST['direccion_sede'];
    $correo_sede = $_POST['correo_sede'];
    $telefono_sede = $_POST['telefono_sede'];
    $cod_empresa = $_POST['cod_empresa'];

    // SQL corregido para insertar los datos correctos
    $sql = "INSERT INTO sede (nombre, direccion, correo, telefono, cod_empresa) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssi", $nombre_sede, $direccion_sede, $correo_sede, $telefono_sede, $cod_empresa);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    $stmt->close();
}

// Manejar la solicitud GET para cargar empresas
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT Cod_empresa, nom_empresa FROM empresas";
    $resultado = $conexion->query($sql);
    $empresas = [];

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $empresas[] = $fila;
        }
    }
    echo json_encode($empresas);
    $conexion->close();
}
?>