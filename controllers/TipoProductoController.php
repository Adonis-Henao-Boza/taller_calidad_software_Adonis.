<?php
require_once 'models/TipoProducto.php';
require_once 'config/database.php';

class TipoProductoController {
    private $db;
    private $tipoProducto;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->tipoProducto = new TipoProducto($this->db);
    }

    // Mostrar lista de tipos de producto
    public function index() {
        $stmt = $this->tipoProducto->read();
        $tipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        include 'views/tipo_producto/index.php';
    }

    // Mostrar formulario de creación
    public function create() {
        include 'views/tipo_producto/create.php';
    }

    // Procesar creación
    public function store() {
        if($_POST) {
            $this->tipoProducto->nombre = $_POST['nombre'];
            $this->tipoProducto->descripcion = $_POST['descripcion'];
            $this->tipoProducto->activo = isset($_POST['activo']) ? 1 : 0;

            if($this->tipoProducto->create()) {
                header("Location: index.php?controller=tipoproducto&action=index&msg=created");
                exit();
            } else {
                $error = "Error al crear el tipo de producto.";
                include 'views/tipo_producto/create.php';
            }
        }
    }

    // Mostrar formulario de edición
    public function edit() {
        if(isset($_GET['id'])) {
            $this->tipoProducto->id = $_GET['id'];
            if($this->tipoProducto->readOne()) {
                include 'views/tipo_producto/edit.php';
            } else {
                header("Location: index.php?controller=tipoproducto&action=index&error=notfound");
                exit();
            }
        }
    }

    // Procesar actualización
    public function update() {
        if($_POST) {
            $this->tipoProducto->id = $_POST['id'];
            $this->tipoProducto->nombre = $_POST['nombre'];
            $this->tipoProducto->descripcion = $_POST['descripcion'];
            $this->tipoProducto->activo = isset($_POST['activo']) ? 1 : 0;

            if($this->tipoProducto->update()) {
                header("Location: index.php?controller=tipoproducto&action=index&msg=updated");
                exit();
            } else {
                $error = "Error al actualizar el tipo de producto.";
                $this->tipoProducto->readOne();
                include 'views/tipo_producto/edit.php';
            }
        }
    }

    // Eliminar tipo de producto
    public function delete() {
        if(isset($_GET['id'])) {
            $this->tipoProducto->id = $_GET['id'];
            if($this->tipoProducto->delete()) {
                header("Location: index.php?controller=tipoproducto&action=index&msg=deleted");
                exit();
            } else {
                header("Location: index.php?controller=tipoproducto&action=index&error=deletefailed");
                exit();
            }
        }
    }

    // Ver detalles
    public function show() {
        if(isset($_GET['id'])) {
            $this->tipoProducto->id = $_GET['id'];
            if($this->tipoProducto->readOne()) {
                include 'views/tipo_producto/show.php';
            } else {
                header("Location: index.php?controller=tipoproducto&action=index&error=notfound");
                exit();
            }
        }
    }
}
?>