<?php
require("../../../Conexion/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aprendizDocumento = $_POST['aprendiz'];
    $instructorDocumento = $_POST['instructor'];
    $fechaVisita = $_POST['fecha_visita'];
    $horaVisita = $_POST['hora_visita'];
    $observaciones = $_POST['observaciones'];

    // Primero, insertar la visita en la tabla 'visita'
    $insertVisitaQuery = "INSERT INTO visita (fecha_visita, hora_visita, num_visita, Observaciones) VALUES ('$fechaVisita', '$horaVisita', 1, '$observaciones')";

    if ($conexion->query($insertVisitaQuery) === TRUE) {
        // Obtener el último ID insertado para vincularlo
        $codVisita = $conexion->insert_id;

        // Aquí puedes realizar la lógica de vinculación si existe una tabla que lo permita
        // Por ejemplo, crear una tabla intermedia 'aprendiz_instructor_visita' (si no existe)
        $insertLinkQuery = "INSERT INTO aprendiz_instructor_visita (aprendiz_documento, instructor_documento, visita_cod) VALUES ('$aprendizDocumento', '$instructorDocumento', '$codVisita')";

        if ($conexion->query($insertLinkQuery) === TRUE) {
            echo "Visita programada exitosamente.";
        } else {
            echo "Error al vincular la visita: " . $conexion->error;
        }
    } else {
        echo "Error al registrar la visita: " . $conexion->error;
    }
}

$conexion->close();
?>
