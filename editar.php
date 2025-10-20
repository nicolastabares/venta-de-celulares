<?php
include("includes/db.php");
include("includes/header.php");

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: dashboard.php");
    exit;
}

// Obtener datos actuales
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch();

if (!$producto) {
    echo '<div class="alert alert-danger">Producto no encontrado.</div>';
    include("includes/footer.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $marca = $_POST['marca'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $descripcion = $_POST['descripcion'] ?? '';
    $imagen_url = $_POST['imagen_url'] ?? '';

    if ($nombre && $marca && $precio >= 0 && $stock >= 0) {
        $sql = "UPDATE productos SET nombre = ?, marca = ?, precio = ?, stock = ?, descripcion = ?, imagen_url = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $marca, $precio, $stock, $descripcion, $imagen_url, $id]);
        header("Location: dashboard.php");
        exit;
    } else {
        echo '<div class="alert alert-danger">Por favor completa todos los campos correctamente.</div>';
    }
}
?>

<h2 class="mb-4">✏️ Editar Producto</h2>
<form method="post">
  <div class="row mb-3">
    <div class="col-md-6">
      <label class="form-label">Nombre</label>
      <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Marca</label>
      <input type="text" name="marca" class="form-control" value="<?= htmlspecialchars($producto['marca']) ?>" required>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-4">
      <label class="form-label">Precio</label>
      <input type="number" name="precio" step="0.01" min="0" class="form-control" value="<?= $producto['precio'] ?>" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Stock</label>
      <input type="number" name="stock" min="0" class="form-control" value="<?= $producto['stock'] ?>" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Imagen URL</label>
      <input type="text" name="imagen_url" class="form-control" value="<?= htmlspecialchars($producto['imagen_url']) ?>">
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Descripción</label>
    <textarea name="descripcion" class="form-control" rows="3"><?= htmlspecialchars($producto['descripcion']) ?></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Actualizar</button>
  <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php include("includes/footer.php"); ?>
