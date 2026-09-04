<?php
require '3_conexion.php';
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $Nombre  = trim($_POST["N"] ?? "");

    $sql = "INSERT INTO tbl_persona (nombrePersona) VALUES (?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $Nombre);

    mysqli_stmt_close($stmt);
}
header('location:index.php');
mysqli_close($conexion);
?>