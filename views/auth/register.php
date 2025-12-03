<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Abaddon Joyería</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in" style="max-width: 600px; margin-top: 80px;">
        <div class="header">
            <h1>Registro de Usuario</h1>
            <p>Crear Nueva Cuenta en Abaddon</p>
        </div>

        <?php
        function isSelected($role) {
            if (!isset($_POST['rol'])) {
            return ($role == 'cliente') ? 'selected' : '';
            }
            return (isset($_POST['rol']) && $_POST['rol'] == $role) ? 'selected' : '';
            }
        ?>

        <div class="form-container">
            <form method="POST" action="index.php?controller=auth&action=store">
                <div class="form-group">
                    <label for="nombre">Nombre Completo *</label>
                    <input type="text" 
                           id="nombre" 
                           name="nombre" 
                           class="form-control" 
                           placeholder="Tu nombre completo"
                           required
                           value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-control" 
                           placeholder="tu@email.com"
                           required
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="password">Contraseña *</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-control" 
                           placeholder="Mínimo 6 caracteres"
                           required
                           minlength="6">
                </div>

                <div class="form-group">
                    <label for="rol">Tipo de Usuario *</label>
                    <select id="rol" name="rol" class="form-control" required>
                        <option value="cliente" <?php echo (!isset($_POST['rol']) || (isset($_POST['rol']) && $_POST['rol'] == 'cliente')) ? 'selected' : ''; ?>>
                            Cliente
                        </option>
                        <option value="administrador" <?php echo (isset($_POST['rol']) && $_POST['rol'] == 'administrador') ? 'selected' : ''; ?>>
                            Administrador
                        </option>
                    </select>
                </div>

                <div style="text-align: center; margin-top: 30px;">
                    <button type="submit" class="btn btn-success" style="width: 100%; padding: 15px;">
                        Registrar Usuario
                    </button>
                </div>
            </form>
        </div>

        <div class="alert alert-info">
            <strong>Información:</strong><br>
            • Los clientes solo pueden ver productos disponibles<br>
            • Los administradores tienen acceso completo al sistema<br>
            • Todos los usuarios requieren aprobación para activarse
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <p>¿Ya tienes cuenta? 
                <a href="index.php?controller=auth&action=login" style="color: #FFD700; text-decoration: none; font-weight: 600;">
                    Iniciar Sesión
                </a>
            </p>
        </div>
    </div>
</body>
</html>
