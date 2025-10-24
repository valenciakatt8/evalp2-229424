<?php
require_once __DIR__ . '/../includes/auth.php';
requireLogin();

$errors = ['cilindro'=>[], 'rect'=>[]];
$result = ['cilindro'=>null, 'rect'=>null];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (($_POST['calc'] ?? '') === 'cilindro') {
    $r = $_POST['radio'] ?? '';
    $h = $_POST['altura'] ?? '';
    if ($r === '' || $h === '') $errors['cilindro'][] = 'Todos los campos son obligatorios.';
    if (!is_numeric($r) || !is_numeric($h)) $errors['cilindro'][] = 'Debes ingresar números.';
    if (empty($errors['cilindro'])) {
      $r = (float)$r; $h = (float)$h;
      if ($r <= 0 || $h <= 0) $errors['cilindro'][] = 'Los valores deben ser positivos.';
      if (empty($errors['cilindro'])) {
        $area = 2 * M_PI * $r * ($r + $h);   // 2πr(r+h)
        $vol  = M_PI * $r * $r * $h;         // πr^2h
        $result['cilindro'] = ['area'=>$area, 'volumen'=>$vol];
      }
    }
  }

  if (($_POST['calc'] ?? '') === 'rect') {
    $b = $_POST['base'] ?? '';
    $h = $_POST['alto'] ?? '';
    if ($b === '' || $h === '') $errors['rect'][] = 'Todos los campos son obligatorios.';
    if (!is_numeric($b) || !is_numeric($h)) $errors['rect'][] = 'Debes ingresar números.';
    if (empty($errors['rect'])) {
      $b = (float)$b; $h = (float)$h;
      if ($b <= 0 || $h <= 0) $errors['rect'][] = 'Los valores deben ser positivos.';
      if (empty($errors['rect'])) {
        $area = $b * $h;
        $per  = 2 * ($b + $h);
        $result['rect'] = ['area'=>$area, 'perimetro'=>$per];
      }
    }
  }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Figuras | Eval</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <a href="/public/dashboard.php" class="btn btn-link">&larr; Volver</a>
  <h1 class="h4 mb-4">Cálculo de Figuras</h1>

  <div class="row g-4">
    <div class="col-md-6">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="mb-3">Cilindro (área y volumen)</h5>
          <?php foreach ($errors['cilindro'] as $e): ?>
            <div class="alert alert-danger py-2"><?= htmlspecialchars($e) ?></div>
          <?php endforeach; ?>
          <form method="post" class="vstack gap-2">
            <input type="hidden" name="calc" value="cilindro">
            <div>
              <label class="form-label">Radio (r)</label>
              <input class="form-control" name="radio" inputmode="decimal" placeholder="ej. 5">
            </div>
            <div>
              <label class="form-label">Altura (h)</label>
              <input class="form-control" name="altura" inputmode="decimal" placeholder="ej. 10">
            </div>
            <button class="btn btn-primary mt-2">Calcular</button>
          </form>
          <?php if ($result['cilindro']): ?>
            <div class="alert alert-success mt-3 mb-0">
              Área total = <?= number_format($result['cilindro']['area'], 2) ?><br>
              Volumen = <?= number_format($result['cilindro']['volumen'], 2) ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="mb-3">Rectángulo (área y perímetro)</h5>
          <?php foreach ($errors['rect'] as $e): ?>
            <div class="alert alert-danger py-2"><?= htmlspecialchars($e) ?></div>
          <?php endforeach; ?>
          <form method="post" class="vstack gap-2">
            <input type="hidden" name="calc" value="rect">
            <div>
              <label class="form-label">Base (b)</label>
              <input class="form-control" name="base" inputmode="decimal" placeholder="ej. 8">
            </div>
            <div>
              <label class="form-label">Altura (h)</label>
              <input class="form-control" name="alto" inputmode="decimal" placeholder="ej. 3">
            </div>
            <button class="btn btn-primary mt-2">Calcular</button>
          </form>
          <?php if ($result['rect']): ?>
            <div class="alert alert-success mt-3 mb-0">
              Área = <?= number_format($result['rect']['area'], 2) ?><br>
              Perímetro = <?= number_format($result['rect']['perimetro'], 2) ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
