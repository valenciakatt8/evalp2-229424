<?php
// Iniciar la sesión si aún no existe (para recordar si ya iniciamos)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Usuario y contraseña "de práctica"
const APP_USER = 'usuario';
const APP_PASS = '1234';

/**
 * ¿Ya está logueado?
 */
function isLogged(): bool {
    return !empty($_SESSION['logged']) && $_SESSION['logged'] === true;
}

/**
 * Si no está logueado, lo mando al login
 */
function requireLogin(): void {
    if (!isLogged()) {
        header('Location: /public/index.php');
        exit;
    }
}

/**
 * Intenta iniciar sesión
 * @return array [ok(bool), error(string|null)]
 */
function doLogin(string $user, string $pass): array {
    if (trim($user) === '' || trim($pass) === '') {
        return [false, 'Debes llenar usuario y contraseña.'];
    }
    if ($user === APP_USER && $pass === APP_PASS) {
        $_SESSION['logged']   = true;
        $_SESSION['username'] = $user;
        return [true, null];
    }
    return [false, 'Credenciales incorrectas.'];
}

/**
 * Cerrar sesión
 */
function doLogout(): void {
    session_destroy(); // borra los datos de sesión
    header('Location: /public/index.php');
    exit;
}
