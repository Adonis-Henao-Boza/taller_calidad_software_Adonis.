<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto - Abaddon Joyería</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in">
        <div class="header">
            <h1>Crear Producto</h1>
            <p>Agregar Nueva Joya al Inventario</p>
        </div>

        <div class="nav-menu">
            <a href="index.php" class="nav-btn"> Inicio</a>
            <a href="index.php?controller=producto&action=index" class="nav-btn">Ver Productos</a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST" action="index.php?controller=producto&action=store">
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
                                   value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="tipo_producto_id">Tipo de Producto *</label>
                            <select id="tipo_producto_id" name="tipo_producto_id" class="form-control" required>
                                <option value="">Seleccionar tipo...</option>
                                <?php foreach ($tipos as $tipo): ?>
                                    <option value="<?php echo $tipo['id']; ?>" 
                                            <?php echo (isset($_POST['tipo_producto_id']) && $_POST['tipo_producto_id'] == $tipo['id']) ? 'selected' : ''; ?>>
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
                                   value="<?php echo isset($_POST['precio']) ? htmlspecialchars($_POST['precio']) : ''; ?>">
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
                                   value="<?php echo isset($_POST['stock']) ? htmlspecialchars($_POST['stock']) : ''; ?>">
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
                                   value="<?php echo isset($_POST['material']) ? htmlspecialchars($_POST['material']) : ''; ?>">
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
                                   value="<?php echo isset($_POST['peso']) ? htmlspecialchars($_POST['peso']) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="imagen">Imagen (nombre del archivo)</label>
                            <input type="text" 
                                   id="imagen" 
                                   name="imagen" 
                                   class="form-control" 
                                   placeholder="Ej: /images/ring.jpg"
                                   value="<?php echo isset($_POST['imagen']) ? htmlspecialchars($_POST['imagen']) : ''; ?>">
                        </div>

                        <div class="checkbox-container">
                            <input type="checkbox" 
                                   id="activo" 
                                   name="activo" 
                                   value="1" 
                                   <?php echo (!isset($_POST['activo']) || $_POST['activo']) ? 'checked' : ''; ?>>
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
                              rows="4"><?php echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : ''; ?></textarea>
                </div>

                <div style="margin-top: 30px; text-align: center;">
                    <button type="submit" class="btn btn-success">Guardar Producto</button>
                    <a href="index.php?controller=producto&action=index" class="btn btn-primary">Cancelar</a>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header"> Consejos para Productos de Joyería</div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-top: 15px;">
                <div>
                    <h4>Nombres Descriptivos</h4>
                    <p>Incluye tipo, material y características principales</p>
                </div>
                <div>
                    <h4>Precios Competitivos</h4>
                    <p>Considera el costo del material y la mano de obra</p>
                </div>
                <div>
                    <h4>Control de Stock</h4>
                    <p>Mantén actualizado el inventario para evitar sobreventa</p>
                </div>
                <div>
                    <h4>Peso Exacto</h4>
                    <p>El peso es crucial para el valor de las joyas</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>