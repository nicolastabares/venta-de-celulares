<?php
include("includes/db.php");
include("includes/header.php");

// Consulta productos desde la base de datos
$stmt = $pdo->query("SELECT * FROM productos ORDER BY id DESC");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="mb-4">📊 Dashboard de Productos</h2>

<!-- Botones de acción -->
<div class="d-flex gap-2 mb-3">
  <a href="agregar.php" class="btn btn-success">+ Agregar Producto</a>
  <a href="agregar_categoria.php" class="btn btn-primary">+ Agregar Categoría</a>
</div>

<!-- Tabla de productos -->
<table class="table table-striped table-bordered align-middle">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Marca</th>
      <th>Precio</th>
      <th>Stock</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($productos as $producto): ?>
    <tr>
      <td><?= $producto['id'] ?></td>
      <td><?= htmlspecialchars($producto['nombre']) ?></td>
      <td><?= htmlspecialchars($producto['marca']) ?></td>
      <td>$<?= number_format($producto['precio'], 2) ?></td>
      <td><?= $producto['stock'] ?></td>
      <td>
        <a href="editar.php?id=<?= $producto['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
        <a href="eliminar.php?id=<?= $producto['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include("includes/footer.php"); ?>
