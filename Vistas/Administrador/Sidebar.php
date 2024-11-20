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
            <a href="/Visitas/Vistas\Administrador\Sidebar.php">
                <img src="/Visitas/Imagenes/logoSena1.png" alt="Logo">
            </a>
        </div>
        <div class="menu">
            <button class="menu-btn">
                <img src="/Visitas/Imagenes/iconos/icon_usuario.svg" alt="Usuario Icono">
                Usuarios
            </button>
            <div class="submenu">
                <a href="/Visitas/Vistas\Administrador\Usuarios\Ver_usuario.php">Ver</a>
                <a href="/Visitas/Vistas\Administrador\Usuarios\Crear_usuario.php">Crear</a>
            </div>

            <button class="menu-btn">
                <img src="/Visitas/Imagenes/iconos/icon_instructor.svg" alt="Opción 2 Icono">
                Instructores
            </button>
            <div class="submenu">
                <a href="/Visitas/Vistas\Administrador\Instructor\Ver_Instructor.php">Ver</a>
                <a href="/Visitas/Vistas\Administrador\Instructor\Crear_Instructor.php">Crear</a>
            </div>

            <button class="menu-btn">
                <img src="/Visitas/Imagenes/iconos/icon_aprendiz.svg" alt="Opción 3 Icono">
                Aprendices
            </button>
            <div class="submenu">
                <a href="/Visitas/Vistas\Administrador\Aprendiz\Ver_Aprendiz.php">Ver</a>
                <a href="/Visitas/Vistas\Administrador\Aprendiz\Crear_Aprendiz.php">Crear</a>
            </div>

            <button class="menu-btn">
                <img src="/Visitas/Imagenes/iconos/icon_visitas.svg" alt="Opción 4 Icono">
                Visitas
            </button>
            <div class="submenu">
                <a href="/Visitas/Vistas\Administrador\Visitas\Gestionar_visita.php">Crear</a>
                <a href="/Visitas/Vistas\Administrador\Visitas\ver_visitas.php">Ver</a>
           
            </div>

            <button class="menu-btn">
                <img src="/Visitas/Imagenes/iconos/icon_empresas.svg" alt="Opción 5 Icono">
                Empresas
            </button>
            <div class="submenu">
            <a href="/Visitas/Vistas\Administrador\Empresas\Ver_empresa.php">Ver</a>
            <a href="/Visitas/Vistas\Administrador\Empresas\Crear_empresa.php">Crear</a>
            </div>

            <button class="menu-btn">
                <img src="/Visitas/Imagenes/iconos/icon_Fichas.svg" alt="Opción 6 Icono">
                Fichas
            </button>
            <div class="submenu">
                <a href="/Visitas/Vistas\Administrador\Fichas\Ver_ficha.php">Ver</a>
                <a href="/Visitas/Vistas\Administrador\Fichas\Crear_ficha.php">Crear</a>
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
