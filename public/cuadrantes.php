<?php
require_once __DIR__ . '/../includes/auth.php';
requireLogin();

$msg = null; $error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $x = $_POST['x'] ?? '';
  $y = $_POST['y'] ?? '';

  if ($x === '' || $y === '') {
    $error = 'Debes ingresar ambos valores (X y Y).';
  } elseif (!is_numeric($x) || !is_numeric($y)) {
    $error = 'X y Y deben ser números (pueden ser positivos o negativos).';
  } else {
    $x = (float)$x; $y = (float)$y;

    if ($x == 0 && $y == 0)        $msg = 'El punto está en el origen (0,0).';
    elseif ($x == 0)               $msg = 'El punto está sobre el eje Y.';
    elseif ($y == 0)               $msg = 'El punto está sobre el eje X.';
    elseif ($x > 0 && $y > 0)      $msg = 'I Cuadrante';
    elseif ($x < 0 && $y > 0)      $msg = 'II Cuadrante';
    elseif ($x < 0 && $y < 0)      $msg = 'III Cuadrante';
    else                           $msg = 'IV Cuadrante';
  }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Cuadrantes | Eval</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <a class="btn btn-link" href="/public/dashboard.php">&larr; Volver</a>
  <h1 class="h4 mb-3">Identificación de Cuadrantes</h1>
  <p class="text-muted">Ingresa las coordenadas del punto (X, Y).</p>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <?php if ($msg && !$error): ?>
    <div class="alert alert-info"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>

  <form method="post" class="row g-3">
    <div class="col-sm-6">
      <label class="form-label">X (horizontal)</label>
      <input class="form-control" name="x" inputmode="decimal" placeholder="-3, 0, 5">
    </div>
    <div class="col-sm-6">
      <label class="form-label">Y (vertical)</label>
      <input class="form-control" name="y" inputmode="decimal" placeholder="-2, 0, 4">
    </div>
    <div class="col-12">
      <button class="btn btn-primary">Evaluar</button>
    </div>
  </form>

  <div class="mt-4">
    <!-- Si tienes una imagen del plano, guárdala en /public/img/plano.png y descomenta: -->
    <!-- <img class="img-fluid rounded border" src="/public/img/plano.png" alt="Plano cartesiano"> -->
  </div>
</div>
</body>
</html>
