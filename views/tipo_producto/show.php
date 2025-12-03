<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Tipo de Producto - Abaddon Joyería</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in">
        <div class="header">
            <h1>Detalles del Tipo de Producto</h1>
            <p>Información Completa de la Categoría</p>
        </div>

        <div class="nav-menu">
            <a href="index.php" class="nav-btn">Inicio</a>
            <a href="index.php?controller=tipoproducto&action=index" class="nav-btn">Ver Tipos</a>
            <a href="index.php?controller=tipoproducto&action=edit&id=<?php echo $this->tipoProducto->id; ?>" class="nav-btn">Editar</a>
        </div>

        <div class="card">
            <div class="card-header">
                Información del Tipo de Producto #<?php echo htmlspecialchars($this->tipoProducto->id); ?>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <div>
                    <h3 style="color: #667eea; margin-bottom: 15px;">Datos Básicos</h3>
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($this->tipoProducto->nombre); ?></p>
                    <p><strong>Estado:</strong> 
                        <?php if ($this->tipoProducto->activo): ?>
                            <span class="badge badge-activo">Activo</span>
                        <?php else: ?>
                            <span class="badge badge-inactivo">Inactivo</span>
                        <?php endif; ?>
                    </p>
                </div>
                
                <div>
                    <h3 style="color: #667eea; margin-bottom: 15px;">Fechas</h3>
                    <p><strong>Creado:</strong> <?php echo date('d/m/Y H:i:s', strtotime($this->tipoProducto->fecha_creacion)); ?></p>
                    <p><strong>Actualizado:</strong> <?php echo date('d/m/Y H:i:s', strtotime($this->tipoProducto->fecha_actualizacion)); ?></p>
                </div>
            </div>

            <?php if ($this->tipoProducto->descripcion): ?>
            <div style="margin-top: 20px;">
                <h3 style="color: #667eea; margin-bottom: 15px;">Descripción</h3>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 10px; border-left: 4px solid #667eea;">
                    <?php echo nl2br(htmlspecialchars($this->tipoProducto->descripcion)); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="index.php?controller=tipoproducto&action=edit&id=<?php echo $this->tipoProducto->id; ?>" class="btn btn-warning">
                Editar Tipo de Producto
            </a>
            <a href="index.php?controller=tipoproducto&action=index" class="btn btn-primary">
                Volver a la Lista
            </a>
            <a href="index.php?controller=tipoproducto&action=delete&id=<?php echo $this->tipoProducto->id; ?>" 
               class="btn btn-danger"
               onclick="return confirm('¿Estás seguro de eliminar este tipo de producto? Esta acción no se puede deshacer.')">
                Eliminar
            </a>
        </div>
    </div>
</body>
</html>