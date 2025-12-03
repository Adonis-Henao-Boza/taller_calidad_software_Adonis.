<?php
require_once 'config/database.php';

class Producto {
    private $conn;
    private $table_name = "productos";

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $stock;
    public $material;
    public $peso;
    public $tipo_producto_id;
    public $imagen;
    public $activo;
    public $fecha_creacion;
    public $fecha_actualizacion;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Crear producto
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET nombre=:nombre, descripcion=:descripcion, precio=:precio, 
                     stock=:stock, material=:material, peso=:peso, 
                     tipo_producto_id=:tipo_producto_id, imagen=:imagen, activo=:activo";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->material = htmlspecialchars(strip_tags($this->material));
        $this->imagen = htmlspecialchars(strip_tags($this->imagen));
        $this->activo = $this->activo ?? 1;
        
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":material", $this->material);
        $stmt->bindParam(":peso", $this->peso);
        $stmt->bindParam(":tipo_producto_id", $this->tipo_producto_id);
        $stmt->bindParam(":imagen", $this->imagen);
        $stmt->bindParam(":activo", $this->activo);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Leer todos los productos con tipo
    public function read() {
        $query = "SELECT p.*, tp.nombre as tipo_nombre 
                 FROM " . $this->table_name . " p 
                 LEFT JOIN tipo_producto tp ON p.tipo_producto_id = tp.id 
                 ORDER BY p.fecha_creacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Leer un producto por ID
    public function readOne() {
        $query = "SELECT p.*, tp.nombre as tipo_nombre 
                 FROM " . $this->table_name . " p 
                 LEFT JOIN tipo_producto tp ON p.tipo_producto_id = tp.id 
                 WHERE p.id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->nombre = $row['nombre'];
            $this->descripcion = $row['descripcion'];
            $this->precio = $row['precio'];
            $this->stock = $row['stock'];
            $this->material = $row['material'];
            $this->peso = $row['peso'];
            $this->tipo_producto_id = $row['tipo_producto_id'];
            $this->imagen = $row['imagen'];
            $this->activo = $row['activo'];
            $this->fecha_creacion = $row['fecha_creacion'];
            $this->fecha_actualizacion = $row['fecha_actualizacion'];
            return true;
        }
        return false;
    }

    // Actualizar producto
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                 SET nombre=:nombre, descripcion=:descripcion, precio=:precio, 
                     stock=:stock, material=:material, peso=:peso, 
                     tipo_producto_id=:tipo_producto_id, imagen=:imagen, activo=:activo 
                 WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->material = htmlspecialchars(strip_tags($this->material));
        $this->imagen = htmlspecialchars(strip_tags($this->imagen));
        $this->activo = $this->activo ?? 1;
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':material', $this->material);
        $stmt->bindParam(':peso', $this->peso);
        $stmt->bindParam(':tipo_producto_id', $this->tipo_producto_id);
        $stmt->bindParam(':imagen', $this->imagen);
        $stmt->bindParam(':activo', $this->activo);
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar producto
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Buscar productos por tipo
    public function readByTipo($tipo_id) {
        $query = "SELECT p.*, tp.nombre as tipo_nombre 
                 FROM " . $this->table_name . " p 
                 LEFT JOIN tipo_producto tp ON p.tipo_producto_id = tp.id 
                 WHERE p.tipo_producto_id = ? AND p.activo = 1 
                 ORDER BY p.nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $tipo_id);
        $stmt->execute();
        return $stmt;
    }
}
?>