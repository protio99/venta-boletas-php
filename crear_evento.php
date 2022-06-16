<?php

require('conexion_db.php');

if (isset($_POST['btn_crear_evento'])) {
    $fecha_evento = $_POST['fecha_evento'];
    $franja_horaria = $_SESSION['franja_horaria'];
    $cupo_maximo = $_SESSION['cupo_maximo'];
    $semana_mes = $_SESSION['semana_mes'];

    $consulta = "INSERT INTO evento(fecha, franja_horaria, cupo_actual, cupo_maximo, semana) 
    VALUES('$fecha_evento', '$franja_horaria', '$cupo_maximo', '$cupo_maximo','$semana_mes')";
    $resultado = mysqli_query($conexion, $consulta);

    if (!$resultado) {
        $_SESSION['mensaje'] = "Algo fallo al registrar los eventos";
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: admin_boletas.php");
        die("Fallo");
    }
    $_SESSION['mensaje'] = "Evento creado satisfactoriamente";
    $_SESSION['tipo_mensaje'] = "success";
    header("Location: admin_boletas.php");
}
