<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Abaddon Joyería</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in">
        <div class="header">
            <h1>Catálogo Abaddon</h1>
            <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?> - Descubre Nuestra Joyería Exclusiva</p>
        </div>

        <div class="nav-menu">
            <a href="index.php?controller=dashboard&action=cliente" class="nav-btn">Todos los Productos</a>
            <?php if ($_SESSION['user_rol'] == 'administrador'): ?>
                <a href="index.php?controller=dashboard&action=admin" class="nav-btn">Panel Admin</a>
            <?php endif; ?>
            <a href="index.php?controller=auth&action=logout" class="nav-btn">Cerrar Sesión</a>
        </div>

        <!-- Filtros por tipo -->
        <div class="card">
            <div class="card-header">Filtrar por Categoría</div>
            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 20px;">
                <a href="index.php?controller=dashboard&action=cliente" 
                   class="btn <?php echo !isset($filtro_activo) ? 'btn-success' : 'btn-primary'; ?>">
                    Todos los Productos
                </a>
                <?php foreach ($tipos as $tipo): ?>
                    <a href="index.php?controller=dashboard&action=filtrarPorTipo&tipo_id=<?php echo $tipo['id']; ?>" 
                       class="btn <?php echo (isset($filtro_activo) && $filtro_activo == $tipo['id']) ? 'btn-success' : 'btn-primary'; ?>">
                        <?php echo htmlspecialchars($tipo['nombre']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if (isset($_GET['error']) && $_GET['error'] == 'notfound'): ?>
            <div class="alert alert-error">Producto no encontrado o no disponible.</div>
        <?php endif; ?>

        <!-- Grid de productos -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 25px; margin-top: 30px;">
            <?php if (empty($productos)): ?>
                <div class="card" style="grid-column: 1 / -1; text-align: center; padding: 60px;">
                    <h3 style="color: #666;">No hay productos disponibles en esta categoría</h3>
                    <p>Vuelve pronto para ver nuestras nuevas colecciones</p>
                </div>
            <?php else: ?>
                <?php foreach ($productos as $producto): ?>
                <div class="card" style="transition: all 0.3s ease;">
                    <div style="position: relative;">
                        <?php if ($producto['imagen']): ?>
                            <div style="height: 200px; background: linear-gradient(135deg, #f8f9fa, #e9ecef); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                <span style="color: #666; font-size: 3rem;">📷</span>
                                <small style="position: absolute; bottom: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 5px 10px; border-radius: 15px;">
                                    <?php echo htmlspecialchars($producto['imagen']); ?>
                                </small>
                            </div>
                        <?php endif; ?>
                        
                        <div style="position: absolute; top: 15px; right: 15px;">
                            <span style="background: rgba(255, 215, 0, 0.9); color: #1a1a1a; padding: 5px 12px; border-radius: 15px; font-weight: 600; font-size: 0.9rem;">
                                <?php echo htmlspecialchars($producto['tipo_nombre']); ?>
                            </span>
                        </div>
                    </div>

                    <h3 style="color: #1a1a1a; margin-bottom: 10px; font-size: 1.3rem;">
                        <?php echo htmlspecialchars($producto['nombre']); ?>
                    </h3>
                    
                    <p style="color: #666; margin-bottom: 15px; line-height: 1.5;">
                        <?php echo htmlspecialchars(substr($producto['descripcion'], 0, 120)) . (strlen($producto['descripcion']) > 120 ? '...' : ''); ?>
                    </p>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px; font-size: 0.95rem;">
                        <div>
                            <strong>Material:</strong><br>
                            <span style="color: #666;"><?php echo htmlspecialchars($producto['material'] ?: 'No especificado'); ?></span>
                        </div>
                        <div>
                            <strong>Peso:</strong><br>
                            <span style="color: #666;"><?php echo $producto['peso'] ? htmlspecialchars($producto['peso']) . 'g' : 'No especificado'; ?></span>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div class="precio" style="font-size: 1.5rem;">
                            $<?php echo number_format($producto['precio'], 2); ?>
                        </div>
                        <div>
                            <?php 
                            $stock = $producto['stock'];
                            $class = '';
                            if ($stock > 10) $class = 'stock-alto';
                            elseif ($stock > 5) $class = 'stock-medio';
                            else $class = 'stock-bajo';
                            ?>
                            <span class="<?php echo $class; ?>" style="font-weight: 600;">
                                <?php echo $stock; ?> disponibles
                            </span>
                        </div>
                    </div>

                    <div style="text-align: center;">
                        <a href="index.php?controller=dashboard&action=verProducto&id=<?php echo $producto['id']; ?>" 
                           class="btn btn-success" style="width: 100%; padding: 12px;">
                            Ver Detalles Completos
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if (!empty($productos)): ?>
        <div class="alert alert-info" style="margin-top: 40px;">
            <strong>Información:</strong> Mostrando <?php echo count($productos); ?> productos disponibles. 
            Para realizar compras, contacta con nuestro equipo de ventas.
        </div>
        <?php endif; ?>
    </div>
</body>
</html>