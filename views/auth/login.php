<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Abaddon Joyería</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container fade-in" style="max-width: 500px; margin-top: 100px;">
        <div class="header">
            <h1>Abaddon Joyería</h1>
            <p>Iniciar Sesión en el Sistema</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST" action="index.php?controller=auth&action=authenticate">
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
                           placeholder="Tu contraseña"
                           required>
                </div>

                <div style="text-align: center; margin-top: 30px;">
                    <button type="submit" class="btn btn-success" style="width: 100%; padding: 15px;">
                        Iniciar Sesión
                    </button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">Usuarios de Demo</div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                <div>
                    <h4 style="color: #FFD700;">Administrador</h4>
                    <p><strong>Email:</strong> admin@abaddon.com</p>
                    <p><strong>Contraseña:</strong> password</p>
                    <small>Acceso completo al sistema</small>
                </div>
                <div>
                    <h4 style="color: #C0C0C0;">Cliente</h4>
                    <p><strong>Email:</strong> cliente@demo.com</p>
                    <p><strong>Contraseña:</strong> password</p>
                    <small>Solo visualización de productos</small>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <p>¿No tienes cuenta? 
                <a href="index.php?controller=auth&action=register" style="color: #FFD700; text-decoration: none; font-weight: 600;">
                    Registrarse aquí
                </a>
            </p>
        </div>
    </div>
</body>
</html>