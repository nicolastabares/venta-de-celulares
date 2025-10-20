<?php
include("includes/db.php");
include("includes/header.php");

// Verificar si se recibió el ID
if (!isset($_GET['id'])) {
    echo "<script>alert('⚠️ No se especificó una categoría válida.'); window.location='listar_categorias.php';</script>";
    exit;
}

$id = $_GET['id'];

// Consultar los datos actuales de la categoría
$stmt = $pdo->prepare("SELECT * FROM categorias WHERE id = :id");
$stmt->execute(['id' => $id]);
$categoria = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$categoria) {
    echo "<script>alert('❌ Categoría no encontrada.'); window.location='listar_categorias.php';</script>";
    exit;
}

// Si el formulario se envía
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST['nombre']);

    if (!empty($nombre)) {
        $stmt = $pdo->prepare("UPDATE categorias SET nombre = :nombre WHERE id = :id");
        $stmt->execute(['nombre' => $nombre, 'id' => $id]);

        echo "<script>alert('✅ Categoría actualizada correctamente.'); window.location='listar_categorias.php';</script>";
    } else {
        echo "<script>alert('⚠️ El nombre no puede estar vacío.');</script>";
    }
}
?>

<div class="container mt-4">
  <h2 class="mb-4">✏️ Editar Categoría</h2>

  <form method="POST">
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre de la Categoría</label>
      <input type="text" name="nombre" id="nombre" class="form-control" value="<?= htmlspecialchars($categoria['nombre']) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="listar_categorias.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<?php include("includes/footer.php"); ?>
