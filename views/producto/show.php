<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Producto - Abaddon Joyería</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in">
        <div class="header">
            <h1>Detalles del Producto</h1>
            <p>Información Completa de la Joya</p>
        </div>

        <div class="nav-menu">
            <a href="index.php" class="nav-btn">Inicio</a>
            <a href="index.php?controller=producto&action=index" class="nav-btn">Ver Productos</a>
            <a href="index.php?controller=producto&action=edit&id=<?php echo $this->producto->id; ?>" class="nav-btn">Editar</a>
        </div>

        <div class="card">
            <div class="card-header">
                <?php echo htmlspecialchars($this->producto->nombre); ?> - ID #<?php echo htmlspecialchars($this->producto->id); ?>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <div>
                    <h3 style="color: #667eea; margin-bottom: 15px;">Información Básica</h3>
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($this->producto->nombre); ?></p>
                    <p><strong>Precio:</strong> <span class="precio">$<?php echo number_format($this->producto->precio, 2); ?></span></p>
                    <p><strong>Stock:</strong> 
                        <?php 
                        $stock = $this->producto->stock;
                        $class = '';
                        if ($stock > 10) $class = 'stock-alto';
                        elseif ($stock > 5) $class = 'stock-medio';
                        else $class = 'stock-bajo';
                        ?>
                        <span class="<?php echo $class; ?>"><?php echo $stock; ?> unidades</span>
                    </p>
                    <p><strong>Estado:</strong> 
                        <?php if ($this->producto->activo): ?>
                            <span class="badge badge-activo">Activo</span>
                        <?php else: ?>
                            <span class="badge badge-inactivo">Inactivo</span>
                        <?php endif; ?>
                    </p>
                </div>
                
                <div>
                    <h3 style="color: #667eea; margin-bottom: 15px;">Especificaciones</h3>
                    <p><strong>Material:</strong> <?php echo htmlspecialchars($this->producto->material ?: 'No especificado'); ?></p>
                    <p><strong>Peso:</strong> <?php echo $this->producto->peso ? htmlspecialchars($this->producto->peso) . ' gramos' : 'No especificado'; ?></p>
                    <p><strong>Imagen:</strong> <?php echo htmlspecialchars($this->producto->imagen ?: 'Sin imagen'); ?></p>
                </div>
            </div>

            <?php if ($this->producto->descripcion): ?>
            <div style="margin-top: 20px;">
                <h3 style="color: #667eea; margin-bottom: 15px;">Descripción</h3>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 4px solid #667eea;">
                    <?php echo nl2br(htmlspecialchars($this->producto->descripcion)); ?>
                </div>
            </div>
            <?php endif; ?>

            <div style="margin-top: 20px;">
                <h3 style="color: #667eea; margin-bottom: 15px;">Información de Registro</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                    <div>
                        <p><strong>Fecha de creación:</strong><br>
                        <?php echo date('d/m/Y H:i:s', strtotime($this->producto->fecha_creacion)); ?></p>
                    </div>
                    <div>
                        <p><strong>Última actualización:</strong><br>
                        <?php echo date('d/m/Y H:i:s', strtotime($this->producto->fecha_actualizacion)); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="index.php?controller=producto&action=edit&id=<?php echo $this->producto->id; ?>" class="btn btn-warning">
                Editar Producto
            </a>
            <a href="index.php?controller=producto&action=index" class="btn btn-primary">
                Volver a Productos
            </a>
            <a href="index.php?controller=producto&action=delete&id=<?php echo $this->producto->id; ?>" 
               class="btn btn-danger"
               onclick="return confirm('¿Estás seguro de eliminar este producto? Esta acción no se puede deshacer.')">
                Eliminar
            </a>
        </div>
    </div>
</body>
</html>