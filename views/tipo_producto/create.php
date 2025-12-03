<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tipo de Producto - Abaddon Joyería</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in">
        <div class="header">
            <h1>Crear Tipo de Producto</h1>
            <p>Agregar Nueva Categoría de Joyería</p>
        </div>

        <div class="nav-menu">
            <a href="index.php" class="nav-btn">Inicio</a>
            <a href="index.php?controller=tipoproducto&action=index" class="nav-btn">Ver Tipos</a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST" action="index.php?controller=tipoproducto&action=store">
                <div class="form-group">
                    <label for="nombre">Nombre del Tipo *</label>
                    <input type="text" 
                           id="nombre" 
                           name="nombre" 
                           class="form-control" 
                           placeholder="Ej: Anillos, Collares, Pulseras..."
                           required
                           value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" 
                              name="descripcion" 
                              class="form-control" 
                              placeholder="Describe las características de este tipo de producto de joyería..."
                              rows="4"><?php echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : ''; ?></textarea>
                </div>

                <div class="checkbox-container">
                    <input type="checkbox" 
                           id="activo" 
                           name="activo" 
                           value="1" 
                           <?php echo (!isset($_POST['activo']) || $_POST['activo']) ? 'checked' : ''; ?>>
                    <label for="activo">Tipo de producto activo</label>
                </div>

                <div style="margin-top: 30px; text-align: center;">
                    <button type="submit" class="btn btn-success">Guardar Tipo de Producto</button>
                    <a href="index.php?controller=tipoproducto&action=index" class="btn btn-primary">Cancelar</a>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">Sugerencias para Joyería</div>
            <p><strong>Tipos comunes de productos de joyería:</strong></p>
            <ul style="margin-left: 20px; margin-top: 10px;">
                <li><strong>Anillos:</strong> De compromiso, alianzas, eternidad, cocktail</li>
                <li><strong>Collares:</strong> Cadenas, gargantillas, riviera, perlas</li>
                <li><strong>Aretes:</strong> Studs, colgantes, aros, chandelier</li>
                <li><strong>Pulseras:</strong> Tenis, charm, rígidas, cadena</li>
                <li><strong>Relojes:</strong> Clásicos, deportivos, elegantes</li>
                <li><strong>Broches:</strong> Vintage, modernos, temáticos</li>
            </ul>
        </div>
    </div>
</body>
</html>