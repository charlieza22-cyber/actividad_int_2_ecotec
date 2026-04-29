<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Venta.php';

class VentaService {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function registrarVenta($producto_id, $cantidad) {
        try {
            $this->db->beginTransaction();

            $producto = new Producto($this->db);
            $producto->id = $producto_id;
            $producto->readOne();

            if ($producto->stock < $cantidad) {
                throw new Exception("Stock insuficiente.");
            }

            // 1. Registrar la venta
            $venta = new Venta($this->db);
            $venta->producto_id = $producto_id;
            $venta->cantidad = $cantidad;
            $venta->total = $producto->precio * $cantidad;
            
            if (!$venta->create()) {
                throw new Exception("Error al crear registro de venta.");
            }

            // 2. Actualizar stock del producto
            $nuevo_stock = $producto->stock - $cantidad;
            $query = "UPDATE productos SET stock = :stock WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':stock', $nuevo_stock);
            $stmt->bindParam(':id', $producto_id);
            
            if (!$stmt->execute()) {
                throw new Exception("Error al actualizar el stock.");
            }

            $this->db->commit();
            return "Venta realizada con éxito. Nuevo stock: " . $nuevo_stock;

        } catch (Exception $e) {
            $this->db->rollBack();
            return "Error: " . $e->getMessage();
        }
    }
}
