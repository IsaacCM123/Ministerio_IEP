<?php
// =========================================================
// conexion.php - Establece la conexión a MinisterioBD (Aiven)
// Solo crea y valida la conexión. No muestra datos aquí.
// Otros archivos (index.php, registro.php) lo incluyen con require.
// =========================================================

$host     = getenv("DB_HOST");
$puerto   = getenv("DB_PORT");
$usuario  = getenv("DB_USER");
$password = getenv("DB_PASSWORD");
$bd       = getenv("DB_NAME");
$rutaCA   = __DIR__ . "/cert/globalsignrootca.pem";

if (!$host || !$usuario || !$password || !$bd) {
    die("Error: faltan variables de entorno en MariaDB.");
}

$conexion = mysqli_init();
mysqli_ssl_set($conexion, NULL, NULL, $rutaCA, NULL, NULL);

$exito = mysqli_real_connect(
    $conexion,
    $host,
    $usuario,
    $password,
    $bd,
    (int)$puerto,
    NULL,
    MYSQLI_CLIENT_SSL
);

if (!$exito) {
    die("Error de conexión: " . mysqli_connect_error());
}
// Nota: no se cierra la conexión aquí ($conexion sigue abierta).
// El archivo que haga "require" de este será responsable de
// usarla y cerrarla con mysqli_close($conexion) al terminar.
?>