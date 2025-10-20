<?php
include("includes/db.php");

// Verificar si se recibió el ID
if (!isset($_GET['id'])) {
    echo "<script>alert('⚠️ No se especificó una categoría válida.'); window.location='listar_categorias.php';</script>";
    exit;
}

$id = $_GET['id'];

// Eliminar la categoría
$stmt = $pdo->prepare("DELETE FROM categorias WHERE id = :id");
$stmt->execute(['id' => $id]);

echo "<script>alert('🗑️ Categoría eliminada correctamente.'); window.location='listar_categorias.php';</script>";
exit;
