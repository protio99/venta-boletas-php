<?php
include("conexion_db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = "DELETE FROM evento WHERE id = $id";
    $resultado = mysqli_query($conexion, $consulta);
    if (!$resultado) {
        die("No se pudo eliminar");
    }

    $_SESSION['mensaje'] = "Evento eliminado exitosamente";
    $_SESSION['tipo_mensaje'] = 'success';
    header("Location: admin_boletas.php");
}
