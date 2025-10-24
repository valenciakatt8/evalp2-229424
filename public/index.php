<?php
require_once __DIR__ . '/../includes/auth.php';

$error = null;

// Si enviaste el formulario...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';

    [$ok, $error] = doLogin($user, $pass);
    if ($ok) {
        header('Location: /public/dashboard.php'); // ir al panel
        exit;
    }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Login | Eval</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h1 class="h4 text-center mb-4">Iniciar sesión</h1>

          <?php if ($error): ?>
            <div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div>
          <?php endif; ?>

          <form method="post" class="vstack gap-2" novalidate>
            <div>
              <label class="form-label">Usuario</label>
              <input class="form-control" name="user" placeholder="usuario" required>
            </div>
            <div>
              <label class="form-label">Contraseña</label>
              <input class="form-control" type="password" name="pass" placeholder="1234" required>
            </div>
            <button class="btn btn-primary mt-2 w-100">Entrar</button>
          </form>

          <p class="text-muted small mt-3 mb-0">
            * Para probar: <strong>usuario / 1234</strong>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
