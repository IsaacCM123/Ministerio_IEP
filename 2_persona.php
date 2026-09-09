<?php
require '3_conexion.php';
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $Nombre  = trim($_POST["N"] ?? "");

    $sql = "INSERT INTO tbl_persona (nombrePersona) VALUES (?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $Nombre);

    if (mysqli_stmt_execute($stmt)) {
        $mensaje = "✅ Registro insertado correctamente.";
        // ============ AQUÍ SE AGREGA EL AVISO EN TIEMPO REAL ============INICIO
        $urlSocket = "https://socket-production-95b7.up.railway.app";
        if ($urlSocket) {
            $ch = curl_init($urlSocket . "/notificar");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["nombre" => $Nombre]));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3); // no bloquear si el socket falla
            curl_exec($ch);
            curl_close($ch);
        }
        // ================================================================FINAL
    } else {
        $mensaje = "❌ Error al insertar: " . mysqli_error($conexion);
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conexion);
header('location:index.php');
?>