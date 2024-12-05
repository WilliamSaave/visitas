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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../../../css/login.css">
    <link rel="stylesheet" href="../../../css/sidebar.css">

    <script src="../../../Js/sidebar.js" defer></script>
</head>
<body>
<?php include("../sidebar.php"); ?>
<div class="login-box">
        <h1>Gestionar Visitas</h1>
        <br>
        <form action="guardar_visita.php" method="POST">
            <div class="user-box">
                <label for="aprendiz">Seleccionar Aprendiz:</label>
                <br>
                <select name="aprendiz" id="aprendiz" required>
                    <option value="">Seleccione un aprendiz</option>
                    <?php while ($aprendiz = $aprendicesResult->fetch_assoc()): ?>
                        <option value="<?php echo $aprendiz['documento']; ?>">
                            <?php echo $aprendiz['nombres'] . ' ' . $aprendiz['apellidos']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="user-box">
                <label for="instructor">Seleccionar Instructor:</label>
                <br>
                <select name="instructor" id="instructor" required>
                    <option value="">Seleccione un instructor</option>
                    <?php while ($instructor = $instructoresResult->fetch_assoc()): ?>
                        <option value="<?php echo $instructor['documento']; ?>">
                            <?php echo $instructor['nombres'] . ' ' . $instructor['apellidos']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="user-box">
                <label for="fecha_visita">Fecha de Visita:</label>
                <input type="date" name="fecha_visita" id="fecha_visita" required>
            </div>

            <div class="user-box">
                <label for="hora_visita">Hora de Visita:</label>
                <input type="time" name="hora_visita" id="hora_visita" required>
            </div>

            <div class="user-box">
                <label for="observaciones">Observaciones:</label>
                <br>
                <textarea name="observaciones" id="observaciones" rows="4"></textarea>
            </div>

            <button type="submit">Programar Visita</button>
        </form>
    </div>
</body>
</html>
