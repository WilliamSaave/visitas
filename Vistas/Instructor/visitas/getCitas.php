<?php
session_start();
require("../../../Conexion/conexion.php");

if (isset($_SESSION['documento'])) {
    $documento = $_SESSION['documento'];
    $fechaSeleccionada = $_POST['fecha']; // recibir la fecha seleccionada

    $sql = "SELECT * FROM visita WHERE fecha_visita = ? AND Cod_visitas IN (SELECT visita FROM instructor WHERE documento = ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $fechaSeleccionada, $documento);
    $stmt->execute();
    $result = $stmt->get_result();

    $citas = [];
    while ($row = $result->fetch_assoc()) {
        $citas[] = $row;
    }

    echo json_encode($citas);
}
?>