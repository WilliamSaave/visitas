<?php
require("../../../Conexion/conexion.php");

// Consulta para obtener aprendices
$aprendicesQuery = "SELECT documento, nombres, apellidos FROM aprendiz";
$aprendicesResult = $conexion->query($aprendicesQuery);

// Consulta para obtener instructores
$instructoresQuery = "SELECT documento, nombres, apellidos FROM instructor";
$instructoresResult = $conexion->query($instructoresQuery);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Visitas</title>
    <link rel="stylesheet" href="styles.css"> <!-- Incluye tu CSS aquí -->
</head>
<body>
    <h1>Gestionar Visitas</h1>

    <form action="guardar_visita.php" method="POST">
        <label for="aprendiz">Seleccionar Aprendiz:</label>
        <select name="aprendiz" id="aprendiz" required>
            <option value="">Seleccione un aprendiz</option>
            <?php while ($aprendiz = $aprendicesResult->fetch_assoc()): ?>
                <option value="<?php echo $aprendiz['documento']; ?>">
                    <?php echo $aprendiz['nombres'] . ' ' . $aprendiz['apellidos']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="instructor">Seleccionar Instructor:</label>
        <select name="instructor" id="instructor" required>
            <option value="">Seleccione un instructor</option>
            <?php while ($instructor = $instructoresResult->fetch_assoc()): ?>
                <option value="<?php echo $instructor['documento']; ?>">
                    <?php echo $instructor['nombres'] . ' ' . $instructor['apellidos']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="fecha_visita">Fecha de Visita:</label>
        <input type="date" name="fecha_visita" id="fecha_visita" required>

        <label for="hora_visita">Hora de Visita:</label>
        <input type="time" name="hora_visita" id="hora_visita" required>

        <label for="observaciones">Observaciones:</label>
        <textarea name="observaciones" id="observaciones" rows="4"></textarea>

        <button type="submit">Programar Visita</button>
    </form>
</body>
</html>
