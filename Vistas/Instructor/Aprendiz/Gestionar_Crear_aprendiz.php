<?php
require("../../../Conexion/conexion.php");

$documento = $_POST['documento'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$correo_institucional = $_POST['correo_institucional'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$ficha_id = $_POST['ficha_id'];

// Aquí realizas la inserción en la base de datos
$query = "INSERT INTO aprendiz (documento, nombres, apellidos, correo, correo_institucional, direccion, telefono, ficha_id) 
          VALUES ('$documento', '$nombres', '$apellidos', '$correo', '$correo_institucional', '$direccion', '$telefono', '$ficha_id')";

if ($conexion->query($query) === TRUE) {
    echo json_encode(["success" => true, "message" => "Aprendiz creado con éxito"]);
} else {
    echo json_encode(["success" => false, "message" => "No se ha podido crear el aprendiz"]);
}



    $fichaQuery = "SELECT num_ficha FROM ficha WHERE num_ficha = ?";
    $fichaStmt = $conexion->prepare($fichaQuery);
    $fichaStmt->bind_param("i", $ficha_id);
    $fichaStmt->execute();
    $fichaStmt->store_result();

    $fichaStmt->close();
    $conexion->close();

?>
