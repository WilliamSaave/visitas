
<?php
session_start();
require("../../../Conexion/conexion.php");

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['documento'])) { // Cambia a 'documento'
    $documento = $_SESSION['documento'];

    // Consulta para obtener datos del instructor
    $sql = "SELECT * FROM instructor WHERE documento = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $documento);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $instructor_data = $result->fetch_assoc();
    } else {
        $instructor_data = null;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/login.css">
    <script src="../../../Js/sidebar.js" defer></script>
    <title>Perfil del Instructor</title>

</head>
<body>
<?php include("../sidebar.php"); ?>
<div class="login-box">
    <h2>Perfil del Instructor</h2>

    <?php if ($instructor_data): ?>
        <p><strong>Documento:</strong> <?php echo htmlspecialchars($instructor_data['documento']); ?></p>
        <p><strong>Nombres:</strong> <?php echo htmlspecialchars($instructor_data['nombres']); ?></p>
        <p><strong>Apellidos:</strong> <?php echo htmlspecialchars($instructor_data['apellidos']); ?></p>
        <p><strong>Correo:</strong> <?php echo htmlspecialchars($instructor_data['correo']); ?></p>
        <p><strong>Correo Institucional:</strong> <?php echo htmlspecialchars($instructor_data['correo_institucional']); ?></p>
        <p><strong>Dirección:</strong> <?php echo htmlspecialchars($instructor_data['direccion']); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($instructor_data['telefono']); ?></p>
        <p><strong>Visita:</strong> <?php echo htmlspecialchars($instructor_data['visita']); ?></p>
        <p><strong>Fecha de Visita:</strong> <?php echo htmlspecialchars($instructor_data['fecha_visita']); ?></p>
        <p><strong>Observaciones:</strong> <?php echo htmlspecialchars($instructor_data['observaciones']); ?></p>
    <?php else: ?>
        <p>No se encontraron datos del instructor.</p>
    <?php endif; ?>

    <a href="../logout.php" class="olvido">Cerrar sesión</a>
</div>

</body>
</html>
