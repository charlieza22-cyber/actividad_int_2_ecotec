<?php
require_once '../controllers/VentaController.php';
require_once '../controllers/ProductoController.php';
$ventaController = new VentaController();
$productoController = new ProductoController();
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['producto_id'])) {
    $mensaje = $ventaController->registrarVenta($_POST['producto_id'], $_POST['cantidad']);
}
$productos = $productoController->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas - Actividad Integradora 2</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7f6; padding: 40px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); text-align: center; }
        h1 { color: #2c3e50; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; text-align: left; }
        label { display: block; font-weight: bold; margin-bottom: 10px; color: #495057; }
        select, input { width: 100%; padding: 12px; border: 1px solid #ced4da; border-radius: 6px; box-sizing: border-box; }
        .btn-submit { background: #007bff; color: white; border: none; padding: 15px; width: 100%; border-radius: 8px; cursor: pointer; font-size: 18px; font-weight: bold; margin-top: 20px; }
        .btn-back { display: inline-block; margin-top: 25px; color: #6c757d; text-decoration: none; }
        .alert { padding: 15px; background: #d4edda; color: #155724; border-radius: 6px; margin-bottom: 20px; border-left: 5px solid #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar Venta</h1>
        <?php if($mensaje) echo "<div class='alert'>".htmlspecialchars($mensaje)."</div>"; ?>
        <form method="POST">
            <div class="form-group">
                <label>Seleccionar Producto:</label>
                <select name="producto_id" required>
                    <option value="">-- Seleccione un producto --</option>
                    <?php while ($row = $productos->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?> (Stock: <?php echo $row['stock']; ?>)</option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Cantidad a Vender:</label>
                <input type="number" name="cantidad" placeholder="Ej: 5" min="1" required>
            </div>
            <button type="submit" class="btn-submit">Finalizar Transacción</button>
        </form>
        <a href="productos.php" class="btn-back">← Volver al Inventario</a>
    </div>
</body>
</html>
