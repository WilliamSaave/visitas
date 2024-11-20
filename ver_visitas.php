<?php
require("../../../Conexion/conexion.php");

// Consulta para obtener las visitas junto con los detalles del aprendiz y del instructor
$query = "
    SELECT v.Cod_visitas, v.fecha_visita, v.hora_visita, v.Observaciones,
           a.nombres AS aprendiz_nombres, a.apellidos AS aprendiz_apellidos,
           i.nombres AS instructor_nombres, i.apellidos AS instructor_apellidos
    FROM visita v
    JOIN aprendiz_instructor_visita aiv ON v.Cod_visitas = aiv.visita_cod
    JOIN aprendiz a ON a.documento = aiv.aprendiz_documento
    JOIN instructor i ON i.documento = aiv.instructor_documento
    ORDER BY v.fecha_visita, v.hora_visita;
";

$result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Visitas</title>
    <link rel="stylesheet" href="styles.css"> <!-- Incluye tu CSS aquí -->
</head>
<body>
    <h1>Visitas Programadas</h1>

    <table border="1">
        <tr>
            <th>Cod Visita</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Observaciones</th>
            <th>Aprendiz</th>
            <th>Instructor</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['Cod_visitas']; ?></td>
                <td><?php echo $row['fecha_visita']; ?></td>
                <td><?php echo $row['hora_visita']; ?></td>
                <td><?php echo $row['Observaciones']; ?></td>
                <td><?php echo $row['aprendiz_nombres'] . ' ' . $row['aprendiz_apellidos']; ?></td>
                <td><?php echo $row['instructor_nombres'] . ' ' . $row['instructor_apellidos']; ?></td>
                <td>
                    <a href="editar_visita.php?id=<?php echo $row['Cod_visitas']; ?>">Editar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <a href="Gestionar_visita.php">Programar Nueva Visita</a>
</body>
</html>
