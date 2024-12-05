<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Citas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="calendario">
        <div id="mes-año">
            <button onclick="cambiarMes(-1)">Anterior</button>
            <h2 id="nombre-mes"></h2>
            <button onclick="cambiarMes(1)">Siguiente</button>
        </div>
        <div id="dias"></div>
        <div id="citas"></div>
    </div>
    <script src="script.js"></script>
</body>
</html>
