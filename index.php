<?php include("includes/header.php"); ?>
<div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
  <div class="card shadow" style="width: 22rem;">
    <div class="card-body">
      <h3 class="card-title text-center mb-4">Iniciar sesión</h3>
      <form action="dashboard.php" method="GET"> <!-- Login no funcional -->
        <div class="mb-3">
          <label for="correo" class="form-label">Correo</label>
          <input type="email" class="form-control" id="correo" placeholder="admin@tienda.com" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="password" placeholder="******" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
      </form>
    </div>
  </div>
</div>
<?php include("includes/footer.php"); ?>
