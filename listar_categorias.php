<?php
include("includes/db.php");
include("includes/header.php");

// Consultar las categorías desde la base de datos usando PDO
$stmt = $pdo->query("SELECT * FROM categorias ORDER BY id DESC");
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
  <h2 class="mb-4">📋 Lista de Categorías</h2>

  <!-- Botón para agregar una nueva categoría -->
  <a href="agregar_categoria.php" class="btn btn-primary mb-3">+ Agregar Categoría</a>

  <table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($categorias) > 0): ?>
        <?php foreach ($categorias as $categoria): ?>
          <tr>
            <td><?= $categoria['id'] ?></td>
            <td><?= htmlspecialchars($categoria['nombre']) ?></td>
            <td>
              <a href="editar_categoria.php?id=<?= $categoria['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
              <a href="eliminar_categoria.php?id=<?= $categoria['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?');">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="3" class="text-center">No hay categorías registradas.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <a href="dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
</div>

<?php include("includes/footer.php"); ?>
