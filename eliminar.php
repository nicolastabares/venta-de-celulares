<?php
include("includes/db.php");
include("includes/header.php");

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: dashboard.php");
    exit;
}

// Primero buscamos el producto para mostrar nombre
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch();

if (!$producto) {
    echo '<div class="alert alert-danger">Producto no encontrado.</div>';
    include("includes/footer.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Confirmación para eliminar
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: dashboard.php");
    exit;
}
?>

<div class="text-center mt-5">
  <h3>¿Estás seguro de eliminar este producto?</h3>
  <p><strong><?= htmlspecialchars($producto['nombre']) ?></strong></p>
  <form method="post" class="d-inline">
    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
  </form>
  <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
</div>

<?php include("includes/footer.php"); ?>
