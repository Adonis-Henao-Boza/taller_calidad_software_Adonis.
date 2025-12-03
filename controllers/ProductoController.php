<?php
require_once 'models/Producto.php';
require_once 'models/TipoProducto.php';
require_once 'config/database.php';

class ProductoController {
    private $db;
    private $producto;
    private $tipoProducto;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->producto = new Producto($this->db);
        $this->tipoProducto = new TipoProducto($this->db);
    }

    // Mostrar lista de productos
    public function index() {
        $stmt = $this->producto->read();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include 'views/producto/index.php';
    }

    // Mostrar formulario de creación
    public function create() {
        $stmt = $this->tipoProducto->getActivos();
        $tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include 'views/producto/create.php';
    }

    // Procesar creación
    public function store() {
        if($_POST) {
            $this->producto->nombre = $_POST['nombre'];
            $this->producto->descripcion = $_POST['descripcion'];
            $this->producto->precio = $_POST['precio'];
            $this->producto->stock = $_POST['stock'];
            $this->producto->material = $_POST['material'];
            $this->producto->peso = $_POST['peso'];
            $this->producto->tipo_producto_id = $_POST['tipo_producto_id'];
            $this->producto->imagen = $_POST['imagen'];
            $this->producto->activo = isset($_POST['activo']) ? 1 : 0;

            if($this->producto->create()) {
                header("Location: index.php?controller=producto&action=index&msg=created");
                exit();
            } else {
                $error = "Error al crear el producto.";
                $stmt = $this->tipoProducto->getActivos();
                $tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                include 'views/producto/create.php';
            }
        }
    }

    // Mostrar formulario de edición
    public function edit() {
        if(isset($_GET['id'])) {
            $this->producto->id = $_GET['id'];
            if($this->producto->readOne()) {
                $stmt = $this->tipoProducto->getActivos();
                $tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                include 'views/producto/edit.php';
            } else {
                header("Location: index.php?controller=producto&action=index&error=notfound");
                exit();
            }
        }
    }

    // Procesar actualización
    public function update() {
        if($_POST) {
            $this->producto->id = $_POST['id'];
            $this->producto->nombre = $_POST['nombre'];
            $this->producto->descripcion = $_POST['descripcion'];
            $this->producto->precio = $_POST['precio'];
            $this->producto->stock = $_POST['stock'];
            $this->producto->material = $_POST['material'];
            $this->producto->peso = $_POST['peso'];
            $this->producto->tipo_producto_id = $_POST['tipo_producto_id'];
            $this->producto->imagen = $_POST['imagen'];
            $this->producto->activo = isset($_POST['activo']) ? 1 : 0;

            if($this->producto->update()) {
                header("Location: index.php?controller=producto&action=index&msg=updated");
                exit();
            } else {
                $error = "Error al actualizar el producto.";
                $this->producto->readOne();
                $stmt = $this->tipoProducto->getActivos();
                $tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                include 'views/producto/edit.php';
            }
        }
    }

    // Eliminar producto
    public function delete() {
        if(isset($_GET['id'])) {
            $this->producto->id = $_GET['id'];
            if($this->producto->delete()) {
                header("Location: index.php?controller=producto&action=index&msg=deleted");
                exit();
            } else {
                header("Location: index.php?controller=producto&action=index&error=deletefailed");
                exit();
            }
        }
    }

    // Ver detalles
    public function show() {
        if(isset($_GET['id'])) {
            $this->producto->id = $_GET['id'];
            if($this->producto->readOne()) {
                include 'views/producto/show.php';
            } else {
                header("Location: index.php?controller=producto&action=index&error=notfound");
                exit();
            }
        }
    }
}
?>