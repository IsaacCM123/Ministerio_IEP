<?php
require '3_conexion.php';
$Seleccionar = "SELECT nombrePersona FROM tbl_persona";

//keyup para buscar nombre desde campo de texto N.............................................
$N_C = isset($_POST['N']) ? $conexion->real_escape_string($_POST['N']) : null;
    if ($N_C != null)
    {
       $Seleccionar = "SELECT nombrePersona FROM tbl_persona WHERE nombrePersona LIKE '%".$N_C."%'";
    }
//............................................................................................


$resultado = mysqli_query($conexion, $Seleccionar);
$HTML = '';
if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $HTML       .= "<tr align='center'>";
        $HTML       .= "<td onclick='obtenerDato(this)'>".$fila['nombrePersona']."</td>";
        $HTML       .= "</tr>";
    }
}
echo json_encode($HTML, JSON_UNESCAPED_UNICODE);
mysqli_close($conexion);
?>