<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($this->producto->nombre); ?> - Abaddon Joyería</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in">
        <div class="header">
            <h1><?php echo htmlspecialchars($this->producto->nombre); ?></h1>
            <p>Detalles Completos de la Joya</p>
        </div>

        <div class="nav-menu">
            <a href="index.php?controller=dashboard&action=cliente" class="nav-btn">Volver al Catálogo</a>
            <?php if ($_SESSION['user_rol'] == 'administrador'): ?>
                <a href="index.php?controller=producto&action=edit&id=<?php echo $this->producto->id; ?>" class="nav-btn">✏️ Editar (Admin)</a>
            <?php endif; ?>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-top: 30px;">
            <!-- Imagen del producto -->
            <div class="card">
                <div style="height: 400px; background: linear-gradient(135deg, #f8f9fa, #e9ecef); border-radius: 15px; display: flex; align-items: center; justify-content: center; position: relative;">
                    <span style="color: #666; font-size: 6rem;">📷</span>
                    <?php if ($this->producto->imagen): ?>
                        <div style="position: absolute; bottom: 20px; left: 20px; right: 20px; background: rgba(0,0,0,0.8); color: white; padding: 10px 15px; border-radius: 10px; text-align: center;">
                            <strong>Imagen:</strong> <?php echo htmlspecialchars($this->producto->imagen); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Información del producto -->
            <div class="card">
                <div class="card-header">Información del Producto</div>
                
                <div style="margin-top: 25px;">
                    <div style="margin-bottom: 20px;">
                        <h3 style="color: #1a1a1a; margin-bottom: 5px;">Precio</h3>
                        <div class="precio" style="font-size: 2.5rem; margin-bottom: 10px;">
                            $<?php echo number_format($this->producto->precio, 2); ?>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                        <div>
                            <h4 style="color: #1a1a1a; margin-bottom: 8px;">Material</h4>
                            <p style="color: #666; font-size: 1.1rem;"><?php echo htmlspecialchars($this->producto->material ?: 'No especificado'); ?></p>
                        </div>
                        <div>
                            <h4 style="color: #1a1a1a; margin-bottom: 8px;">Peso</h4>
                            <p style="color: #666; font-size: 1.1rem;"><?php echo $this->producto->peso ? htmlspecialchars($this->producto->peso) . ' gramos' : 'No especificado'; ?></p>
                        </div>
                    </div>

                    <div style="margin-bottom: 25px;">
                        <h4 style="color: #1a1a1a; margin-bottom: 8px;">Disponibilidad</h4>
                        <?php 
                        $stock = $this->producto->stock;
                        $class = '';
                        $mensaje = '';
                        if ($stock > 10) {
                            $class = 'stock-alto';
                            $mensaje = 'En stock';
                        } elseif ($stock > 5) {
                            $class = 'stock-medio';
                            $mensaje = 'Pocas unidades';
                        } else {
                            $class = 'stock-bajo';
                            $mensaje = 'Stock limitado';
                        }
                        ?>
                        <p class="<?php echo $class; ?>" style="font-size: 1.2rem; font-weight: 600;">
                            <?php echo $stock; ?> unidades disponibles - <?php echo $mensaje; ?>
                        </p>
                    </div>

                    <div style="padding: 20px; background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 215, 0, 0.05)); border-radius: 12px; border: 2px solid rgba(255, 215, 0, 0.3);">
                        <h4 style="color: #1a1a1a; margin-bottom: 10px;">Contactar para Compra</h4>
                        <p style="color: #666; margin-bottom: 15px;">Para adquirir esta joya, contacta con nuestro equipo especializado:</p>
                        <div style="display: grid; gap: 10px;">
                            <p><strong>Teléfono:</strong> 3213939814</p>
                            <p><strong>Email:</strong> abaddon@gmail.com</p>
                            <p><strong>WhatsApp:</strong> 3213939814</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Descripción completa -->
        <?php if ($this->producto->descripcion): ?>
        <div class="card">
            <div class="card-header">Descripción Detallada</div>
            <div style="margin-top: 20px; line-height: 1.8; font-size: 1.1rem; color: #444;">
                <?php echo nl2br(htmlspecialchars($this->producto->descripcion)); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Información adicional -->
        <div class="card">
            <div class="card-header">ℹInformación Adicional</div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
                <div>
                    <h4 style="color: #1a1a1a;">Categoría</h4>
                    <p style="color: #666;">Tipo de producto especializado en joyería fina</p>
                </div>
                <div>
                    <h4 style="color: #1a1a1a;">Garantía</h4>
                    <p style="color: #666;">Garantía de calidad y autenticidad Abaddon</p>
                </div>
                <div>
                    <h4 style="color: #1a1a1a;">Entrega</h4>
                    <p style="color: #666;">Entrega segura y asegurada a domicilio</p>
                </div>
                <div>
                    <h4 style="color: #1a1a1a;">Certificación</h4>
                    <p style="color: #666;">Certificado de autenticidad incluido</p>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <a href="index.php?controller=dashboard&action=cliente" class="btn btn-primary" style="padding: 15px 30px;">
                Volver al Catálogo
            </a>
        </div>
    </div>
</body>
</html>