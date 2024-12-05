<?php

$conexion = new mysqli("localhost", "root", "", "visitas");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Establecer el conjunto de caracteres a utf8mb4
if (!$conexion->set_charset("utf8mb4")) {
    die("Error al configurar el conjunto de caracteres: " . $conexion->error);
}

// También puedes ejecutar esta línea para asegurarte de que la conexión está en UTF-8
$conexion->query("SET NAMES 'utf8mb4'");

?>
