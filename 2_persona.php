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
    } else {
        $mensaje = "❌ Error al insertar: " . mysqli_error($conexion);
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conexion);
header('location:index.php');
?>