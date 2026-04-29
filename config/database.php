<?php
// Configuración de conexión a la base de datos
class Database {
    private $host = "localhost";
    private $db_name = "inventario_ventas";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password
            );

            // 🔥 CLAVE: activar errores reales
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Opcional pero recomendado
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
            exit();
        }

        return $this->conn;
    }
}
?>
