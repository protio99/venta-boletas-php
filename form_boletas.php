<?php include("conexion_db.php"); ?>

<?php include("includes/header.php") ?>
<!-- <link rel="stylesheet" href="./estilos/registro.css">
<link rel="stylesheet" href="./estilos/login.css"> -->
<link rel="stylesheet" href="./estilos/form_boletas.css">



<title>Formulario</title>
</head>

<body class="linea-vertical" onload="document.body.style.opacity='1'">
    <?php
    // session_start();
    if (empty($_SESSION["id_usuario"])) {
        header("Location: login.php");
        exit();
    }
    ?>


    <a href="cerrar_sesion.php">
        <span class="material-symbols-outlined">
            Logout
        </span>
    </a>
    <div class="main-boletas">
        <form method="POST" action="guardar_reserva.php" class="form-card">

            <div class="main-boletas-select">
                <label for="fecha_evento">Fecha evento</label><br>
                <?php
                $id_usuario = $_SESSION['id_usuario'];
                $consulta = "SELECT * FROM evento 
                WHERE semana NOT IN (
                    SELECT e.semana FROM evento e 
                    INNER JOIN venta v ON e.id = v.id_evento
                    WHERE v.id_usuario = $id_usuario
                );";
                $eventos = mysqli_query($conexion, $consulta);
                ?>
                <select name="id_evento" required>
                    <option value="" selected disabled hidden>Seleccione</option>
                    <?php
                    while ($evento = mysqli_fetch_array($eventos)) { ?>
                        <option value="<?php echo $evento['id']; ?>"><?php echo ($evento['fecha'] . " Horario " . $evento['franja_horaria'] . " Cupos disponibles " . $evento['cupo_actual']); ?></option>
                    <?php } ?>
                </select>
            </div>
            <input type="submit" value="Comprar" name="btn_comprar" class="botones">
        </form>

        <div class="boletas-card">
            <?php
            $nick_name = $_SESSION["nick_name"];
            $id_usuario = $_SESSION['id_usuario'];
            $consulta = "SELECT v.id, v.id_evento, e.fecha, e.franja_horaria FROM venta v
                        INNER JOIN evento e ON (e.id = v.id_evento)
                        WHERE v.id_usuario = $id_usuario
               
                ;";
            $compras = mysqli_query($conexion, $consulta);
            ?>
            <div class="boletas-card-main">
                <h6><?php echo "Tus boletas adquiridas " . $nick_name; ?></h6>
                <table class="form-card-boletas">
                    <tr>
                        <th>Id evento</th>
                        <th>Fecha</th>
                        <th>Franja horaria</th>
                        <th>Acciones</th>


                    </tr>

                    <?php
                    while ($compras_usuario = mysqli_fetch_array($compras)) { ?>
                        <tr>

                            <td><?php echo $compras_usuario['id_evento']; ?></td>
                            <td><?php echo $compras_usuario['fecha']; ?></td>
                            <td><?php echo $compras_usuario['franja_horaria']; ?></td>
                            <td><a href="eliminar_venta_usuario.php?id=<?php echo $compras_usuario['id'] ?>"><span class="material-symbols-outlined">
                                        delete
                                    </span></a></td>
                        </tr>


                    <?php } ?>




                </table>
            </div>

        </div>

    </div>

    <?php include("includes/footer.php"); ?>