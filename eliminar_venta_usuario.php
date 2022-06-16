<?php
include("conexion_db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = "DELETE FROM venta WHERE id = $id";
    $resultado = mysqli_query($conexion, $consulta);
    if (!$resultado) {
        die("No se pudo eliminar");
    }

    $_SESSION['mensaje'] = "Venta eliminado exitosamente";
    $_SESSION['tipo_mensaje'] = 'success';
    header("Location: form_boletas.php");
}
