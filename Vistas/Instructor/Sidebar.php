<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/sidebar.css">
  
    <title>Sidebar</title>
</head>
<body>
<div class="sidebar-container">
    <div class="sidebar">
        <div class="logo">
            <a href="/Visitas/Vistas\Instructor\index.php">
                <img src="/Visitas/Imagenes/logoSena1.png" alt="Logo">
            </a>
        </div>
        <div class="menu">
            <button class="menu-btn">
                <img src="/Visitas/Imagenes/iconos/icon_usuario.svg" alt="Usuario Icono">
                Perfil
            </button>
            <div class="submenu">
                <a href="/Visitas/Vistas\Instructor\Perfil\perfil.php">Ver</a>
            </div>

            <button class="menu-btn">
                <img src="/Visitas/Imagenes/iconos/icon_aprendiz.svg" alt="Opción 3 Icono">
                Aprendices
            </button>
            <div class="submenu">
                <a href="/Visitas/Vistas\Instructor\Aprendiz\Ver_Aprendiz.php">Ver</a>
                <a href="/Visitas/Vistas\Instructor\Aprendiz\Crear_Aprendiz.php">Crear</a>
            </div>

            <button class="menu-btn">
                <img src="/Visitas/Imagenes/iconos/icon_visitas.svg" alt="Opción 4 Icono">
                Visitas
            </button>
            <div class="submenu">
                <a href="/Visitas/Vistas\Instructor\visitas\ver_visitas.php">Ver</a>
            </div>


            <button class="menu-btn">
                <img src="/Visitas/Imagenes/iconos/icon_pqr.svg" alt="Opción 7 Icono">
                PQR
            </button>
            <div class="submenu">
                <a href="#">Ver</a>
                <a href="#">Crear</a>
            </div>
        </div>
    </div>
</div>

    <script src="../../Js/sidebar.js"></script>
</body>
</html>
