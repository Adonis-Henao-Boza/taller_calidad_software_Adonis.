<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abaddon Joyería - Sistema de Gestión</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in">
        <div class="header">
            <h1>Abaddon Joyería</h1>
            <p>Sistema de Gestión de Productos de Joyería Fina</p>
        </div>

        <div class="nav-menu">
            <a href="index.php?controller=tipoproducto&action=index" class="nav-btn">
                Gestionar Tipos de Producto
            </a>
            <a href="index.php?controller=producto&action=index" class="nav-btn">
                Gestionar Productos
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                Bienvenido al Sistema de Gestión Abaddon
            </div>
            <p style="margin-bottom: 20px;">
                Este sistema te permite gestionar de manera completa tu inventario de joyería fina. 
                Puedes administrar tipos de productos y productos individuales con todas las funcionalidades CRUD.
            </p>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 30px;">
                <div class="card">
                    <h3 style="color: #667eea; margin-bottom: 15px;">Tipos de Producto</h3>
                    <p style="margin-bottom: 15px;">Gestiona las categorías de joyería como anillos, collares, pulseras, etc.</p>
                    <div>
                        <a href="index.php?controller=tipoproducto&action=index" class="btn btn-primary">Ver Tipos</a>
                        <a href="index.php?controller=tipoproducto&action=create" class="btn btn-success">Crear Nuevo</a>
                    </div>
                </div>

                <div class="card">
                    <h3 style="color: #667eea; margin-bottom: 15px;">💍 Productos</h3>
                    <p style="margin-bottom: 15px;">Administra tu inventario completo de joyas con precios, stock y especificaciones.</p>
                    <div>
                        <a href="index.php?controller=producto&action=index" class="btn btn-primary">Ver Productos</a>
                        <a href="index.php?controller=producto&action=create" class="btn btn-success">Agregar Producto</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Características del Sistema
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
                <div>
                    <h4 style="color: #28a745;">CRUD Completo</h4>
                    <p>Crear, leer, actualizar y eliminar registros de manera segura.</p>
                </div>
                <div>
                    <h4 style="color: #28a745;">Relaciones</h4>
                    <p>Productos vinculados a sus tipos correspondientes.</p>
                </div>
                <div>
                    <h4 style="color: #28a745;">Base de Datos MySQL</h4>
                    <p>Almacenamiento seguro en base de datos Abaddon.</p>
                </div>
                <div>
                    <h4 style="color: #28a745;">Diseño Elegante</h4>
                    <p>Interfaz moderna y fácil de usar para joyería fina.</p>
                </div>
            </div>
        </div>

        <div class="alert alert-info">
            <strong>Instrucciones de Instalación:</strong><br>
            1. Importa el archivo <code>sql/create_database.sql</code> en tu MySQL<br>
            2. Configura la conexión en <code>config/database.php</code><br>
            3. ¡Listo! El sistema ya incluye datos de ejemplo de joyería
        </div>
    </div>
</body>
</html>