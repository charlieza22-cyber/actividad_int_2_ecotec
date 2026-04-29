<?php
class Venta {
    private $conn;
    private $table_name = "ventas";

    public $id;
    public $producto_id;
    public $cantidad;
    public $total;
    public $fecha;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (producto_id, cantidad, total, fecha) VALUES (:producto_id, :cantidad, :total, :fecha)";
        $stmt = $this->conn->prepare($query);
        $this->fecha = date('Y-m-d H:i:s');
        $stmt->bindParam(":producto_id", $this->producto_id);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":fecha", $this->fecha);
        return $stmt->execute();
    }
}
?>
