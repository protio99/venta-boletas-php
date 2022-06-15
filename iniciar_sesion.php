<?php
require('conexion_db.php');
if (isset($_POST['btn_iniciar_sesion'])) {
    $nick_name = $_POST['nick_name'];
    $pass = $_POST['clave'];

    $query = "SELECT * FROM usuario WHERE nick_name = '$nick_name' AND clave = '$pass' ";
    $result = mysqli_query($conexion, $query);
    if ($usuario = mysqli_fetch_assoc($result)) {
        session_start();
        $_SESSION["nick_name"] = $nick_name;
        $_SESSION['id_usuario'] = $usuario["id"];
        header("Location: form_boletas.php");
    } else {
        $_SESSION['mensaje'] = "El usuario y/o clave incorrectos";
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: login.php");
    }
}
