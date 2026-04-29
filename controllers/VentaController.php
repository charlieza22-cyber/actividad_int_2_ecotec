<?php
require_once __DIR__ . '/../services/VentaService.php';
require_once __DIR__ . '/../controllers/ProductoController.php';

class VentaController {
    private $service;
    private $prodController;

    public function __construct() {
        $this->service = new VentaService();
        $this->prodController = new ProductoController();
    }

    public function registrarVenta($id, $cant) {
        return $this->service->registrarVenta($id, $cant);
    }

    public function listarProductos() {
        return $this->prodController->listar();
    }
}
?>
