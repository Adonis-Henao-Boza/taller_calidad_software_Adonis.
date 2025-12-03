<?php
require_once 'models/Usuario.php';
require_once 'config/database.php';

class AuthController {
    private $db;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new Usuario($this->db);
    }

    // Mostrar formulario de login
    public function login() {
        include 'views/auth/login.php';
    }

    // Procesar login
    public function authenticate() {
        if($_POST) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if($this->usuario->login($email, $password)) {
                // Iniciar sesión
                session_start();
                $_SESSION['user_id'] = $this->usuario->id;
                $_SESSION['user_name'] = $this->usuario->nombre;
                $_SESSION['user_email'] = $this->usuario->email;
                $_SESSION['user_rol'] = $this->usuario->rol;
                $_SESSION['logged_in'] = true;

                // Redirigir según rol
                if($this->usuario->rol == 'administrador') {
                    header("Location: index.php?controller=dashboard&action=admin");
                } else {
                    header("Location: index.php?controller=dashboard&action=cliente");
                }
                exit();
            } else {
                $error = "Email o contraseña incorrectos.";
                include 'views/auth/login.php';
            }
        }
    }

    // Mostrar formulario de registro
    public function register() {
        include 'views/auth/register.php';
    }

    // Procesar registro
    public function store() {
        if($_POST) {
            $this->usuario->nombre = $_POST['nombre'];
            $this->usuario->email = $_POST['email'];
            $this->usuario->password = $_POST['password'];
            $this->usuario->rol = $_POST['rol'] ?? 'cliente';

            // Verificar si el email ya existe
            if($this->usuario->emailExists()) {
                $error = "Este email ya está registrado.";
                include 'views/auth/register.php';
                return;
            }

            if($this->usuario->create()) {
                $success = "Usuario registrado exitosamente. Puedes iniciar sesión.";
                include 'views/auth/login.php';
            } else {
                $error = "Error al registrar usuario.";
                include 'views/auth/register.php';
            }
        }
    }

    // Cerrar sesión
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit();
    }

    // Verificar autenticación
    public static function requireAuth() {
        session_start();
        if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
    }

    // Verificar rol de administrador
    public static function requireAdmin() {
        self::requireAuth();
        if($_SESSION['user_rol'] != 'administrador') {
            header("Location: index.php?controller=dashboard&action=cliente");
            exit();
        }
    }
}
?>
