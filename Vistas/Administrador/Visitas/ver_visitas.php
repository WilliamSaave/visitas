<?php
require("../../../Conexion/conexion.php");

// Inicializar variables para la búsqueda
$buscarAprendiz = isset($_POST['buscar_aprendiz']) ? $_POST['buscar_aprendiz'] : '';
$buscarInstructor = isset($_POST['buscar_instructor']) ? $_POST['buscar_instructor'] : '';

// Consulta para obtener las visitas con opción de búsqueda
$query = "
    SELECT v.Cod_visitas, v.fecha_visita, v.hora_visita, v.Observaciones,
           a.nombres AS aprendiz_nombres, a.apellidos AS aprendiz_apellidos,
           i.nombres AS instructor_nombres, i.apellidos AS instructor_apellidos
    FROM visita v
    JOIN aprendiz_instructor_visita aiv ON v.Cod_visitas = aiv.visita_cod
    JOIN aprendiz a ON a.documento = aiv.aprendiz_documento
    JOIN instructor i ON i.documento = aiv.instructor_documento
";

// Añadir condiciones de búsqueda
$conditions = [];
if (!empty($buscarAprendiz)) {
    $conditions[] = "(a.nombres LIKE '%$buscarAprendiz%' OR a.apellidos LIKE '%$buscarAprendiz%')";
}
if (!empty($buscarInstructor)) {
    $conditions[] = "(i.nombres LIKE '%$buscarInstructor%' OR i.apellidos LIKE '%$buscarInstructor%')";
}

if (count($conditions) > 0) {
    $query .= ' WHERE ' . implode(' AND ', $conditions);
}

$query .= ' ORDER BY v.fecha_visita, v.hora_visita;';

$result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/tablas.css">
    <script src="../../../Js/sidebar.js" defer></script>
    <title>Ver Visitas</title>

</head>
<body>
<?php include("../sidebar.php"); ?>
<h1>Visitas Programadas</h1>


    <form method="POST" action="ver_visitas.php" class="search-container">
        <div>
            <label for="buscar_aprendiz">Buscar Aprendiz:</label>
            <br>
            <input type="text" name="buscar_aprendiz" id="buscar_aprendiz" class="busqueda" value="<?php echo htmlspecialchars($buscarAprendiz); ?>">
        </div>
        <div>
            <label for="buscar_instructor">Buscar Instructor:</label>
            <br>
            <input type="text" name="buscar_instructor" id="buscar_instructor" class="busqueda" value="<?php echo htmlspecialchars($buscarInstructor); ?>">
        </div>
        <br>


        <button type="submit">Buscar</button><br><br><br>
    </form>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Observaciones</th>
                <th>Aprendiz</th>
                <th>Instructor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                   
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
        </tbody>
    </table>



    <a href="Gestionar_visita.php">Programar Nueva Visita</a>
</body>
</html>


