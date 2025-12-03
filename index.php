<?php
// Configuración de errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión
session_start();

// Autoload de clases
spl_autoload_register(function ($class_name) {
    $directories = ['controllers/', 'models/', 'config/'];
    foreach ($directories as $directory) {
        $file = $directory . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            break;
        }
    }
});

// Obtener controlador y acción de la URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Si no hay sesión activa, redirigir al login (excepto para registro y autenticación)
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    if ($controller != 'auth') {
        header("Location: index.php?controller=auth&action=login");
        exit();
    }
}

// Enrutamiento
switch ($controller) {
    case 'auth':
        $controllerObj = new AuthController();
        break;
    case 'dashboard':
        $controllerObj = new DashboardController();
        break;
    case 'tipoproducto':
        AuthController::requireAdmin(); // Solo admin puede gestionar tipos
        $controllerObj = new TipoProductoController();
        break;
    case 'producto':
        AuthController::requireAdmin(); // Solo admin puede gestionar productos
        $controllerObj = new ProductoController();
        break;
    default:
        // Redirigir según rol del usuario
        if (isset($_SESSION['user_rol'])) {
            if ($_SESSION['user_rol'] == 'administrador') {
                header("Location: index.php?controller=dashboard&action=admin");
            } else {
                header("Location: index.php?controller=dashboard&action=cliente");
            }
        } else {
            header("Location: index.php?controller=auth&action=login");
        }
        exit();
}

// Ejecutar acción
if (method_exists($controllerObj, $action)) {
    $controllerObj->$action();
} else {
    echo "Acción no encontrada.";
}
?>