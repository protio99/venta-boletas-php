<?php

require('conexion_db.php');

if (isset($_POST['btn_registro'])) {
    $nombre = $_POST['nombre'];
    $nick_name = $_POST['nick_name'];
    $clave = $_POST['clave'];

    $consulta_existencia = $conexion->query("SELECT * FROM usuario WHERE nick_name = '$nick_name'");

    if ($consulta_existencia->num_rows > 0) {

        $_SESSION['mensaje'] = "El usuario ya existe";
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: login.php");
    } else {
        $consulta = "INSERT INTO usuario(nombre, nick_name , clave) 
        VALUES('$nombre', '$nick_name', '$clave')";
        $resultado = mysqli_query($conexion, $consulta);

        if (!$resultado) {
            die("Fallo");
        }

        $_SESSION['mensaje'] = "Usuario creado satisfactoriamente";
        $_SESSION['tipo_mensaje'] = "success";
        header("Location: form_boletas.php");
    }
}
