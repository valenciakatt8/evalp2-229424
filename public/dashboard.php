<?php
require_once __DIR__ . '/../includes/auth.php';
requireLogin(); // si no has iniciado, te regresa al login
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Panel | Eval</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <span class="navbar-brand">Panel</span>
    <div class="d-flex">
      <span class="navbar-text me-3">Hola, <?= htmlspecialchars($_SESSION['username'] ?? '') ?></span>
      <a class="btn btn-outline-light btn-sm" href="/public/logout.php">Salir</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  <h1 class="h4 mb-3">Bienvenida/o al panel</h1>
  <p class="text-muted">Desde aquí irás a los ejercicios del examen.</p>

  <div class="row g-3">
    <div class="col-md-6">
      <a class="text-decoration-none" href="/public/figuras.php">
        <div class="card h-100">
          <div class="card-body">
            <h5>Cálculo de Figuras</h5>
            <p class="mb-0">Cilindro y rectángulo.</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-6">
      <a class="text-decoration-none" href="/public/cuadrantes.php">
        <div class="card h-100">
          <div class="card-body">
            <h5>Cuadrantes</h5>
            <p class="mb-0">Identifica I, II, III, IV y ejes/origen.</p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
</body>
</html>
