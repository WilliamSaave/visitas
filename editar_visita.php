<?php
require("../../../Conexion/conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener detalles de la visita
    $query = "
        SELECT v.Cod_visitas, v.fecha_visita, v.hora_visita, v.Observaciones,
               aiv.aprendiz_documento, aiv.instructor_documento,
               a.nombres AS aprendiz_nombres, a.apellidos AS aprendiz_apellidos,
               i.nombres AS instructor_nombres, i.apellidos AS instructor_apellidos
        FROM visita v
        JOIN aprendiz_instructor_visita aiv ON v.Cod_visitas = aiv.visita_cod
        JOIN aprendiz a ON a.documento = aiv.aprendiz_documento
        JOIN instructor i ON i.documento = aiv.instructor_documento
        WHERE v.Cod_visitas = $id;
    ";

    $result = $conexion->query($query);
    $visita = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fechaVisita = $_POST['fecha_visita'];
    $horaVisita = $_POST['hora_visita'];
    $observaciones = $_POST['observaciones'];
    $aprendizDocumento = $_POST['aprendiz'];
    $instructorDocumento = $_POST['instructor'];

    // Actualizar la visita
    $updateVisitaQuery = "UPDATE visita SET fecha_visita = '$fechaVisita', hora_visita = '$horaVisita', Observaciones = '$observaciones' WHERE Cod_visitas = $id";
    $conexion->query($updateVisitaQuery);

    // Actualizar la vinculación
    $updateLinkQuery = "UPDATE aprendiz_instructor_visita SET aprendiz_documento = '$aprendizDocumento', instructor_documento = '$instructorDocumento' WHERE visita_cod = $id";
    $conexion->query($updateLinkQuery);

    echo "Visita actualizada exitosamente.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Visita</title>
</head>
<body>
    <h1>Editar Visita</h1>

    <form action="editar_visita.php?id=<?php echo $id; ?>" method="POST">
        <label for="fecha_visita">Fecha de Visita:</label>
        <input type="date" name="fecha_visita" id="fecha_visita" value="<?php echo $visita['fecha_visita']; ?>" required>

        <label for="hora_visita">Hora de Visita:</label>
        <input type="time" name="hora_visita" id="hora_visita" value="<?php echo $visita['hora_visita']; ?>" required>

        <label for="observaciones">Observaciones:</label>
        <textarea name="observaciones" id="observaciones" rows="4"><?php echo $visita['Observaciones']; ?></textarea>

        <label for="aprendiz">Seleccionar Aprendiz:</label>
        <select name="aprendiz" id="aprendiz" required>
            <option value="<?php echo $visita['aprendiz_documento']; ?>">
                <?php echo $visita['aprendiz_nombres'] . ' ' . $visita['aprendiz_apellidos']; ?>
            </option>
            <!-- Aquí puedes agregar más aprendices si es necesario -->
        </select>

        <label for="instructor">Seleccionar Instructor:</label>
        <select name="instructor" id="instructor" required>
            <option value="<?php echo $visita['instructor_documento']; ?>">
                <?php echo $visita['instructor_nombres'] . ' ' . $visita['instructor_apellidos']; ?>
            </option>
            <!-- Aquí puedes agregar más instructores si es necesario -->
        </select>

        <button type="submit">Actualizar Visita</button>
    </form>

    <a href="ver_visitas.php">Volver a la lista de Visitas</a>
</body>
</html>
