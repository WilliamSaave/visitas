<?php
require("../../../Conexion/conexion.php");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si llega el nombre del programa
    if (isset($_POST['nombre_programa']) && !isset($_POST['num_ficha'])) {
        $nombre_programa = $_POST['nombre_programa'];
        $sql = "INSERT INTO programa (nombre_programa) VALUES (?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $nombre_programa);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $stmt->close();
    }

    // Agregar ficha
    if (isset($_POST['num_ficha']) && isset($_POST['nombre_programa'])) {
        $num_ficha = $_POST['num_ficha'];
        $nombre_programa = $_POST['nombre_programa'];

        // Verificar si el programa existe
        $sqlVerificar = "SELECT COUNT(*) FROM programa WHERE nombre_programa = ?";
        $stmtVerificar = $conexion->prepare($sqlVerificar);
        $stmtVerificar->bind_param("s", $nombre_programa);
        $stmtVerificar->execute();
        $stmtVerificar->bind_result($existe);
        $stmtVerificar->fetch();
        $stmtVerificar->close();

        if ($existe == 0) {
            echo json_encode(['success' => false, 'error' => 'El programa no existe.']);
            exit;
        }

        $sql = "INSERT INTO ficha (num_ficha, nombre_programa) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("is", $num_ficha, $nombre_programa);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $stmt->close();
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT nombre_programa FROM programa";
    $resultado = $conexion->query($sql);
    $programas = [];

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $programas[] = $fila;
        }
    }
    echo json_encode($programas);
    $conexion->close();
}
?>
