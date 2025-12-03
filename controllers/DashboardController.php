<?php
require_once 'models/Producto.php';
require_once 'models/TipoProducto.php';
require_once 'models/Usuario.php';
require_once 'controllers/AuthController.php';
require_once 'config/database.php';

class DashboardController {
    private $db;
    private $producto;
    private $tipoProducto;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->producto = new Producto($this->db);
        $this->tipoProducto = new TipoProducto($this->db);
        $this->usuario = new Usuario($this->db);
    }

    // Dashboard del administrador
    public function admin() {
        AuthController::requireAdmin();
        
        // Obtener estadísticas
        $stmt = $this->producto->read();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total_productos = count($productos);
        
        $stmt = $this->tipoProducto->read();
        $tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total_tipos = count($tipos);
        
        $stmt = $this->usuario->read();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total_usuarios = count($usuarios);
        
        // Productos con stock bajo
        $productos_stock_bajo = array_filter($productos, function($p) {
            return $p['stock'] <= 5;
        });
        
        // Valor total del inventario
        $valor_inventario = array_sum(array_map(function($p) {
            return $p['precio'] * $p['stock'];
        }, $productos));

        include 'views/dashboard/admin.php';
    }

    // Dashboard del cliente
    public function cliente() {
        AuthController::requireAuth();
        
        // Solo productos activos para clientes
        $query = "SELECT p.*, tp.nombre as tipo_nombre 
                 FROM productos p 
                 LEFT JOIN tipo_producto tp ON p.tipo_producto_id = tp.id 
                 WHERE p.activo = 1 AND p.stock > 0
                 ORDER BY p.fecha_creacion DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Obtener tipos activos para filtros
        $stmt = $this->tipoProducto->getActivos();
        $tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include 'views/dashboard/cliente.php';
    }

    // Ver producto (cliente)
    public function verProducto() {
        AuthController::requireAuth();
        
        if(isset($_GET['id'])) {
            $this->producto->id = $_GET['id'];
            if($this->producto->readOne() && $this->producto->activo && $this->producto->stock > 0) {
                include 'views/dashboard/producto_detalle.php';
            } else {
                header("Location: index.php?controller=dashboard&action=cliente&error=notfound");
                exit();
            }
        }
    }

    // Filtrar productos por tipo (cliente)
    public function filtrarPorTipo() {
        AuthController::requireAuth();
        
        if(isset($_GET['tipo_id'])) {
            $stmt = $this->producto->readByTipo($_GET['tipo_id']);
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $stmt = $this->tipoProducto->getActivos();
            $tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $filtro_activo = $_GET['tipo_id'];
            include 'views/dashboard/cliente.php';
        }
    }
}
?>