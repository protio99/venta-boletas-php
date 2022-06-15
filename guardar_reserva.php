<?php
require('conexion_db.php');

if (isset($_POST['btn_comprar'])) {
    $id_evento = $_POST['id_evento'];
    $id_usuario = $_SESSION['id_usuario'];
    $seReservo = reservarEvento($conexion, intval($id_usuario), intval($id_evento));
    header("Location: form_boletas.php");
}

function reservarEvento($conexion, $id_usuario, $id_evento)
{
    $cupo_maximo = obtenerCupoMaximo($conexion, $id_evento);
    $cupos_usados = obtenerCuposUsados($conexion, $id_evento);
    $cupos_deseados = 1;
    $cupos = $cupo_maximo - $cupos_usados - $cupos_deseados;
    if ($cupos < 0) {
        return false;
    }

    $query = "INSERT INTO venta (id_usuario, id_evento) values ('$id_usuario','$id_evento')";
    if (!$conexion->query($query)) {
        return false;
    }

    if (!actualizarCupos($conexion, $id_evento, $cupos)) {
        eliminarVenta($conexion, $id_usuario, $id_evento);
        return false;
    }
    return true;
}

function eliminarVenta($conexion, $id_usuario, $id_evento)
{
    $query = "DELETE FROM venta WHERE id_evento = $id_evento AND id_usuario = $id_usuario";
    return $conexion->query($query);
}

function obtenerCupoMaximo($conexion, $id_evento)
{
    $query = "SELECT cupo_maximo FROM evento WHERE id = $id_evento;";
    $result = mysqli_query($conexion, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        return intval($row['cupo_maximo']);
    }
    return 0;
}

function obtenerCuposUsados($conexion, $id_evento)
{
    $query = "SELECT COUNT(*) cupo FROM venta WHERE id_evento = $id_evento";
    $result = mysqli_query($conexion, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        return intval($row['cupo']);
    }
    return 0;
}

function actualizarCupos($conexion, $id_evento, $cupos)
{
    $query = "UPDATE evento SET cupo_actual = $cupos WHERE id = $id_evento";
    return $conexion->query($query);
}
