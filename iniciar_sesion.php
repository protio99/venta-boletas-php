<?php
require('conexion_db.php');
if (isset($_POST['btn_iniciar_sesion'])) {
    $nick_name = $_POST['nick_name'];
    $pass = $_POST['clave'];

    $query = "SELECT * FROM usuario WHERE nick_name = '$nick_name' AND clave = '$pass' ";
    // $query_admin = "SELECT admin FROM usuario WHERE nick_name = '$nick_name";
    // $result_admin = mysqli_query($conexion, $query_admin);
    // $result_admin_array = mysqli_fetch_assoc($result_admin);
    $result = mysqli_query($conexion, $query);
    if ($usuario = mysqli_fetch_assoc($result)) {
        session_start();
        $_SESSION["nick_name"] = $nick_name;
        $_SESSION['id_usuario'] = $usuario["id"];
        if ($usuario['admin'] == 1) {
            header("Location: admin_boletas.php");
        } else {

            header("Location: form_boletas.php");
        }
    } else {
        $_SESSION['mensaje'] = "El usuario y/o clave incorrectos";
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: login.php");
    }
}
