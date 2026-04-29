<?php
require_once '../controllers/ProductoController.php';

$controller = new ProductoController();
$mensaje = "";

/* =========================
   ELIMINAR
========================= */
if (isset($_GET['eliminar'])) {
    $mensaje = $controller->eliminar((int)$_GET['eliminar']);
}

/* =========================
   GUARDAR
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensaje = $controller->guardar(
        $_POST['nombre'],
        $_POST['precio'],
        $_POST['stock']
    );
}

/* =========================
   LISTAR
========================= */
$productos = $controller->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Inventario</title>

<style>
body { font-family: Arial; padding: 40px; background: #f4f4f4; }
.container { background: #fff; padding: 20px; border-radius: 10px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { padding: 10px; border: 1px solid #ddd; }
th { background: #eee; }
.btn { padding: 8px 12px; text-decoration: none; border-radius: 5px; }
.btn-delete { color: white; background: red; }
.btn-save { background: green; color: white; border: none; }
.alert { padding: 10px; background: #d4edda; margin-bottom: 15px; }
</style>

</head>
<body>

<div class="container">

<h2>Inventario</h2>

<?php if($mensaje): ?>
    <div class="alert"><?= htmlspecialchars($mensaje) ?></div>
<?php endif; ?>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="number" step="0.01" name="precio" placeholder="Precio" required>
    <input type="number" name="stock" placeholder="Stock" required>
    <button class="btn-save">Guardar</button>
</form>

<table>
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Precio</th>
    <th>Stock</th>
    <th>Acción</th>
</tr>

<?php while($row = $productos->fetch(PDO::FETCH_ASSOC)): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['nombre']) ?></td>
    <td><?= $row['precio'] ?></td>
    <td><?= $row['stock'] ?></td>
    <td>
        <a class="btn btn-delete"
           href="?eliminar=<?= $row['id'] ?>"
           onclick="return confirm('¿Eliminar producto?')">
           Eliminar
        </a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</div>

</body>
</html>
