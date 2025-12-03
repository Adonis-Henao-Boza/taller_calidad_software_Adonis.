<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Abaddon Joyería</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in">
        <div class="header">
            <h1>Editar Producto</h1>
            <p>Modificar Información de la Joya</p>
        </div>

        <div class="nav-menu">
            <a href="index.php" class="nav-btn">Inicio</a>
            <a href="index.php?controller=producto&action=index" class="nav-btn">Ver Productos</a>
            <a href="index.php?controller=producto&action=show&id=<?php echo $this->producto->id; ?>" class="nav-btn">Ver Detalles</a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST" action="index.php?controller=producto&action=update">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($this->producto->id); ?>">
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                    <div>
                        <div class="form-group">
                            <label for="nombre">Nombre del Producto *</label>
                            <input type="text" 
                                   id="nombre" 
                                   name="nombre" 
                                   class="form-control" 
                                   placeholder="Ej: Anillo de Compromiso Solitario"
                                   required
                                   value="<?php echo htmlspecialchars($this->producto->nombre); ?>">
                        </div>

                        <div class="form-group">
                            <label for="tipo_producto_id">Tipo de Producto *</label>
                            <select id="tipo_producto_id" name="tipo_producto_id" class="form-control" required>
                                <option value="">Seleccionar tipo...</option>
                                <?php foreach ($tipos as $tipo): ?>
                                    <option value="<?php echo $tipo['id']; ?>" 
                                            <?php echo ($this->producto->tipo_producto_id == $tipo['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($tipo['nombre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio *</label>
                            <input type="number" 
                                   id="precio" 
                                   name="precio" 
                                   class="form-control" 
                                   step="0.01" 
                                   min="0"
                                   placeholder="0.00"
                                   required
                                   value="<?php echo htmlspecialchars($this->producto->precio); ?>">
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock *</label>
                            <input type="number" 
                                   id="stock" 
                                   name="stock" 
                                   class="form-control" 
                                   min="0"
                                   placeholder="0"
                                   required
                                   value="<?php echo htmlspecialchars($this->producto->stock); ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="material">Material</label>
                            <input type="text" 
                                   id="material" 
                                   name="material" 
                                   class="form-control" 
                                   placeholder="Ej: Oro blanco 18k, Plata 925..."
                                   value="<?php echo htmlspecialchars($this->producto->material); ?>">
                        </div>

                        <div class="form-group">
                            <label for="peso">Peso (gramos)</label>
                            <input type="number" 
                                   id="peso" 
                                   name="peso" 
                                   class="form-control" 
                                   step="0.01" 
                                   min="0"
                                   placeholder="0.00"
                                   value="<?php echo htmlspecialchars($this->producto->peso); ?>">
                        </div>

                        <div class="form-group">
                            <label for="imagen">Imagen (nombre del archivo)</label>
                            <input type="text" 
                                   id="imagen" 
                                   name="imagen" 
                                   class="form-control" 
                                   placeholder="Ej: /images/photo1764685731.jpg"
                                   value="<?php echo htmlspecialchars($this->producto->imagen); ?>">
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" 
                                   id="activo" 
                                   name="activo" 
                                   value="1" 
                                   <?php echo $this->producto->activo ? 'checked' : ''; ?>>
                            <label for="activo">Producto activo</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" 
                              name="descripcion" 
                              class="form-control" 
                              placeholder="Describe las características, materiales, y detalles especiales de la joya..."
                              rows="4"><?php echo htmlspecialchars($this->producto->descripcion); ?></textarea>
                </div>

                <div style="margin-top: 30px; text-align: center;">
                    <button type="submit" class="btn btn-success">Actualizar Producto</button>
                    <a href="index.php?controller=producto&action=show&id=<?php echo $this->producto->id; ?>" class="btn btn-primary">Ver Detalles</a>
                    <a href="index.php?controller=producto&action=index" class="btn btn-warning">Cancelar</a>
                </div>
            </form>
        </div>

        <div class="alert alert-info">
            <strong>Información del Registro:</strong><br>
            Creado: <?php echo date('d/m/Y H:i:s', strtotime($this->producto->fecha_creacion)); ?><br>
            Última actualización: <?php echo date('d/m/Y H:i:s', strtotime($this->producto->fecha_actualizacion)); ?>
        </div>
    </div>
</body>
</html>