<?php
class Producto {

    private $conn;
    private $table = "productos";

    public $id;
    public $nombre;
    public $precio;
    public $stock;

    public function __construct($db) {
        $this->conn = $db;
    }

    // LISTAR
    public function listar() {
        $sql = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    // CREAR
    public function crear() {
        $sql = "INSERT INTO " . $this->table . " (nombre, precio, stock)
                VALUES (:nombre, :precio, :stock)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":stock", $this->stock);

        return $stmt->execute();
    }

    // ELIMINAR
    public function eliminar() {
        try {
            $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();

            return true;

        } catch (PDOException $e) {

            if ($e->getCode() == 23000) {
                return "No se puede eliminar: el producto tiene ventas registradas";
            }

            return "Error: " . $e->getMessage();
        }
    }
}
?>
