<?php
require_once '../config/database.php';
require_once '../models/Producto.php';

class ProductoController {

    private $producto;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->producto = new Producto($db);
    }

    // LISTAR
    public function listar() {
        return $this->producto->listar();
    }

    // GUARDAR
    public function guardar($nombre, $precio, $stock) {

        if (empty($nombre) || $precio <= 0 || $stock < 0) {
            return "Datos inválidos";
        }

        $this->producto->nombre = $nombre;
        $this->producto->precio = $precio;
        $this->producto->stock  = $stock;

        return $this->producto->crear()
            ? "Producto guardado"
            : "Error al guardar";
    }

    // ELIMINAR
    public function eliminar($id) {

        if ($id <= 0) {
            return "ID inválido";
        }

        $this->producto->id = $id;

        $resultado = $this->producto->eliminar();

        if ($resultado === true) {
            return "Producto eliminado";
        }

        return $resultado;
    }
}
?>
