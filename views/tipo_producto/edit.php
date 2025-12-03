<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tipo de Producto - Abaddon Joyería</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in">
        <div class="header">
            <h1>Editar Tipo de Producto</h1>
            <p>Modificar Categoría de Joyería</p>
        </div>

        <div class="nav-menu">
            <a href="index.php" class="nav-btn">Inicio</a>
            <a href="index.php?controller=tipoproducto&action=index" class="nav-btn">Ver Tipos</a>
            <a href="index.php?controller=tipoproducto&action=show&id=<?php echo $this->tipoProducto->id; ?>" class="nav-btn">Ver Detalles</a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST" action="index.php?controller=tipoproducto&action=update">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($this->tipoProducto->id); ?>">
                
                <div class="form-group">
                    <label for="nombre">Nombre del Tipo *</label>
                    <input type="text" 
                           id="nombre" 
                           name="nombre" 
                           class="form-control" 
                           placeholder="Ej: Anillos, Collares, Pulseras..."
                           required
                           value="<?php echo htmlspecialchars($this->tipoProducto->nombre); ?>">
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" 
                              name="descripcion" 
                              class="form-control" 
                              placeholder="Describe las características de este tipo de producto de joyería..."
                              rows="4"><?php echo htmlspecialchars($this->tipoProducto->descripcion); ?></textarea>
                </div>

                <div class="checkbox-container">
                    <input type="checkbox" 
                           id="activo" 
                           name="activo" 
                           value="1" 
                           <?php echo $this->tipoProducto->activo ? 'checked' : ''; ?>>
                    <label for="activo">Tipo de producto activo</label>
                </div>

                <div style="margin-top: 30px; text-align: center;">
                    <button type="submit" class="btn btn-success">Actualizar Tipo de Producto</button>
                    <a href="index.php?controller=tipoproducto&action=show&id=<?php echo $this->tipoProducto->id; ?>" class="btn btn-primary">Ver Detalles</a>
                    <a href="index.php?controller=tipoproducto&action=index" class="btn btn-warning">Cancelar</a>
                </div>
            </form>
        </div>

        <div class="alert alert-info">
            <strong>Información del Registro:</strong><br>
            Creado: <?php echo date('d/m/Y H:i:s', strtotime($this->tipoProducto->fecha_creacion)); ?><br>
            Última actualización: <?php echo date('d/m/Y H:i:s', strtotime($this->tipoProducto->fecha_actualizacion)); ?>
        </div>
    </div>
</body>
</html>