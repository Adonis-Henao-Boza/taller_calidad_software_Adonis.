<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos de Producto - Abaddon Joyería</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in">
        <div class="header">
            <h1>Tipos de Producto</h1>
            <p>Gestión de Categorías de Joyería</p>
        </div>

        <div class="nav-menu">
            <a href="index.php" class="nav-btn">Inicio</a>
            <a href="index.php?controller=tipoproducto&action=create" class="nav-btn">Nuevo Tipo</a>
            <a href="index.php?controller=producto&action=index" class="nav-btn">Ver Productos</a>
        </div>

        <?php
        // Mostrar mensajes
        if (isset($_GET['msg'])) {
            switch ($_GET['msg']) {
                case 'created':
                    echo '<div class="alert alert-success">Tipo de producto creado exitosamente.</div>';
                    break;
                case 'updated':
                    echo '<div class="alert alert-success">Tipo de producto actualizado exitosamente.</div>';
                    break;
                case 'deleted':
                    echo '<div class="alert alert-success">Tipo de producto eliminado exitosamente.</div>';
                    break;
            }
        }
        
        if (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case 'notfound':
                    echo '<div class="alert alert-error">Tipo de producto no encontrado.</div>';
                    break;
                case 'deletefailed':
                    echo '<div class="alert alert-error">No se pudo eliminar el tipo de producto.</div>';
                    break;
            }
        }
        ?>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($tipos)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px;">
                                No hay tipos de producto registrados.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($tipos as $tipo): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($tipo['id']); ?></td>
                            <td><strong><?php echo htmlspecialchars($tipo['nombre']); ?></strong></td>
                            <td><?php echo htmlspecialchars(substr($tipo['descripcion'], 0, 100)) . (strlen($tipo['descripcion']) > 100 ? '...' : ''); ?></td>
                            <td>
                                <?php if ($tipo['activo']): ?>
                                    <span class="badge badge-activo">Activo</span>
                                <?php else: ?>
                                    <span class="badge badge-inactivo">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('d/m/Y H:i', strtotime($tipo['fecha_creacion'])); ?></td>
                            <td>
                                <a href="index.php?controller=tipoproducto&action=show&id=<?php echo $tipo['id']; ?>" 
                                   class="btn btn-primary" title="Ver detalles"></a>
                                <a href="index.php?controller=tipoproducto&action=edit&id=<?php echo $tipo['id']; ?>" 
                                   class="btn btn-warning" title="Editar"></a>
                                <a href="index.php?controller=tipoproducto&action=delete&id=<?php echo $tipo['id']; ?>" 
                                   class="btn btn-danger" title="Eliminar"
                                   onclick="return confirm('¿Estás seguro de eliminar este tipo de producto?')"></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="index.php?controller=tipoproducto&action=create" class="btn btn-success">
                Agregar Nuevo Tipo de Producto
            </a>
        </div>
    </div>
</body>
</html>