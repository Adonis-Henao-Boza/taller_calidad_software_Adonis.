<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador - Abaddon Joyería</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in">
        <div class="header">
            <h1>Dashboard Administrador</h1>
            <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?> - Panel de Control Completo</p>
        </div>

        <div class="nav-menu">
            <a href="index.php?controller=tipoproducto&action=index" class="nav-btn">Gestionar Tipos</a>
            <a href="index.php?controller=producto&action=index" class="nav-btn">Gestionar Productos</a>
            <a href="index.php?controller=dashboard&action=cliente" class="nav-btn">Vista Cliente</a>
            <a href="index.php?controller=auth&action=logout" class="nav-btn">Cerrar Sesión</a>
        </div>

        <!-- Estadísticas principales -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <div class="card">
                <div class="card-header">Total Productos</div>
                <div style="text-align: center; padding: 20px;">
                    <h2 style="font-size: 3rem; color: #FFD700; margin: 0;"><?php echo $total_productos; ?></h2>
                    <p style="color: #666; margin: 10px 0 0 0;">Productos registrados</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Tipos de Producto</div>
                <div style="text-align: center; padding: 20px;">
                    <h2 style="font-size: 3rem; color: #C0C0C0; margin: 0;"><?php echo $total_tipos; ?></h2>
                    <p style="color: #666; margin: 10px 0 0 0;">Categorías activas</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Total Usuarios</div>
                <div style="text-align: center; padding: 20px;">
                    <h2 style="font-size: 3rem; color: #1a1a1a; margin: 0;"><?php echo $total_usuarios; ?></h2>
                    <p style="color: #666; margin: 10px 0 0 0;">Usuarios registrados</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Valor Inventario</div>
                <div style="text-align: center; padding: 20px;">
                    <h2 style="font-size: 2.5rem; color: #228B22; margin: 0;">$<?php echo number_format($valor_inventario, 2); ?></h2>
                    <p style="color: #666; margin: 10px 0 0 0;">Valor total del stock</p>
                </div>
            </div>
        </div>

        <!-- Alertas de stock bajo -->
        <?php if (!empty($productos_stock_bajo)): ?>
        <div class="alert alert-error">
            <strong>Alerta de Stock Bajo:</strong> Hay <?php echo count($productos_stock_bajo); ?> productos con stock crítico (≤5 unidades)
        </div>
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <!-- Acciones rápidas -->
            <div class="card">
                <div class="card-header">Acciones Rápidas</div>
                <div style="display: grid; gap: 15px; margin-top: 20px;">
                    <a href="index.php?controller=producto&action=create" class="btn btn-success">
                        Agregar Nuevo Producto
                    </a>
                    <a href="index.php?controller=tipoproducto&action=create" class="btn btn-primary">
                        Crear Tipo de Producto
                    </a>
                    <a href="index.php?controller=producto&action=index" class="btn btn-warning">
                        Ver Todo el Inventario
                    </a>
                </div>
            </div>

            <!-- Productos con stock bajo -->
            <div class="card">
                <div class="card-header">Stock Crítico</div>
                <?php if (!empty($productos_stock_bajo)): ?>
                    <div style="max-height: 200px; overflow-y: auto; margin-top: 15px;">
                        <?php foreach ($productos_stock_bajo as $producto): ?>
                        <div style="padding: 10px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <strong><?php echo htmlspecialchars($producto['nombre']); ?></strong>
                                <br><small style="color: #666;"><?php echo htmlspecialchars($producto['tipo_nombre']); ?></small>
                            </div>
                            <span class="stock-bajo"><?php echo $producto['stock']; ?> unidades</span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p style="text-align: center; color: #28a745; margin-top: 20px;">
                        Todos los productos tienen stock adecuado
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Resumen de productos por tipo -->
        <div class="card">
            <div class="card-header">Resumen por Categorías</div>
            <div class="table-container" style="margin-top: 20px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tipo de Producto</th>
                            <th>Cantidad de Productos</th>
                            <th>Stock Total</th>
                            <th>Valor Promedio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tipos as $tipo): ?>
                        <?php 
                        $productos_tipo = array_filter($productos, function($p) use ($tipo) {
                            return $p['tipo_producto_id'] == $tipo['id'];
                        });
                        $cantidad = count($productos_tipo);
                        $stock_total = array_sum(array_column($productos_tipo, 'stock'));
                        $precio_promedio = $cantidad > 0 ? array_sum(array_column($productos_tipo, 'precio')) / $cantidad : 0;
                        ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($tipo['nombre']); ?></strong></td>
                            <td><?php echo $cantidad; ?> productos</td>
                            <td><?php echo $stock_total; ?> unidades</td>
                            <td class="precio">$<?php echo number_format($precio_promedio, 2); ?></td>
                            <td>
                                <a href="index.php?controller=tipoproducto&action=show&id=<?php echo $tipo['id']; ?>" class="btn btn-primary">Ver</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>