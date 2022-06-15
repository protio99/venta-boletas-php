<?php
session_start();
$conexion = mysqli_connect(
    'localhost', //host
    'root', //usuario de la bd
    '', //clave de la bd
    'evento_boletas' //nombre de la bd
);
