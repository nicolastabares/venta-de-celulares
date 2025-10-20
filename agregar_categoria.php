<?php
include("includes/db.php");
include("includes/header.php");

// Si el formulario se envía
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST['nombre']);

    if (!empty($nombre)) {
        // Inserta la categoría usando PDO
        $stmt = $pdo->prepare("INSERT INTO categorias (nombre) VALUES (:nombre)");
        $stmt->execute(['nombre' => $nombre]);

        echo "<script>alert('✅ Categoría agregada correctamente'); window.location='listar_categorias.php';</script>";
    } else {
        echo "<script>alert('⚠️ El nombre de la categoría no puede estar vacío');</script>";
    }
}
?>

<div class="container mt-4">
  <h2 class="mb-4">📁 Agregar Nueva Categoría</h2>

  <form method="POST">
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre de la Categoría</label>
      <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-success">Guardar</button>
      <a href="dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
      <a href="listar_categorias.php" class="btn btn-primary">📋 Ver Listado de Categorías</a>
    </div>
  </form>
</div>

<?php include("includes/footer.php"); ?>
