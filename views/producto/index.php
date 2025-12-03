<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Abaddon Joyería</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in">
        <div class="header">
            <h1>Productos de Joyería</h1>
            <p>Gestión Completa del Inventario</p>
        </div>

        <div class="nav-menu">
            <a href="index.php" class="nav-btn">Inicio</a>
            <a href="index.php?controller=producto&action=create" class="nav-btn">Nuevo Producto</a>
            <a href="index.php?controller=tipoproducto&action=index" class="nav-btn">Tipos de Producto</a>
        </div>

        <?php
        // Mostrar mensajes
        if (isset($_GET['msg'])) {
            switch ($_GET['msg']) {
                case 'created':
                    echo '<div class="alert alert-success">Producto creado exitosamente.</div>';
                    break;
                case 'updated':
                    echo '<div class="alert alert-success"></div> Producto actualizado exitosamente.</div>';
                    break;
                case 'deleted':
                    echo '<div class="alert alert-success">Producto eliminado exitosamente.</div>';
                    break;
            }
        }
        
        if (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case 'notfound':
                    echo '<div class="alert alert-error">Producto no encontrado.</div>';
                    break;
                case 'deletefailed':
                    echo '<div class="alert alert-error">No se pudo eliminar el producto.</div>';
                    break;
            }
        }
        ?>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Material</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($productos)): ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 30px;">
                                No hay productos registrados.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['id']); ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($producto['nombre']); ?></strong>
                                <?php if ($producto['imagen']): ?>
                                    <br><small>Con imagen</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span style="background: #e9ecef; padding: 3px 8px; border-radius: 10px; font-size: 0.9rem;">
                                    <?php echo htmlspecialchars($producto['tipo_nombre']); ?>
                                </span>
                            </td>
                            <td><span class="precio">$<?php echo number_format($producto['precio'], 2); ?></span></td>
                            <td>
                                <?php 
                                $stock = $producto['stock'];
                                $class = '';
                                if ($stock > 10) $class = 'stock-alto';
                                elseif ($stock > 5) $class = 'stock-medio';
                                else $class = 'stock-bajo';
                                ?>
                                <span class="<?php echo $class; ?>"><?php echo $stock; ?> unidades</span>
                            </td>
                            <td><?php echo htmlspecialchars($producto['material']); ?></td>
                            <td>
                                <?php if ($producto['activo']): ?>
                                    <span class="badge badge-activo">Activo</span>
                                <?php else: ?>
                                    <span class="badge badge-inactivo">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="index.php?controller=producto&action=show&id=<?php echo $producto['id']; ?>" 
                                   class="btn btn-primary" title="Ver detalles"></a>
                                <a href="index.php?controller=producto&action=edit&id=<?php echo $producto['id']; ?>" 
                                   class="btn btn-warning" title="Editar"></a>
                                <a href="index.php?controller=producto&action=delete&id=<?php echo $producto['id']; ?>" 
                                   class="btn btn-danger" title="Eliminar"
                                   onclick="return confirm('¿Estás seguro de eliminar este producto?')"></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="index.php?controller=producto&action=create" class="btn btn-success">
                Agregar Nuevo Producto
            </a>
        </div>
    </div>
</body>
</html>