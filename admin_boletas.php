<?php include("conexion_db.php"); ?>

<?php include("includes/header.php") ?>
<!-- <link rel="stylesheet" href="./estilos/registro.css">
 -->
<link rel="stylesheet" href="./estilos/admin.css">



<title>Panel de administracion evento</title>
</head>

<body onload="document.body.style.opacity='1'">
    <?php
    // session_start();
    if (empty($_SESSION["id_usuario"])) {
        header("Location: login.php");
        exit();
    }
    ?>

    <?php if (isset($_SESSION['mensaje'])) { ?>

        <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show alert-custome" role="alert">
            <?= $_SESSION['mensaje'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php session_unset();
    } ?>

    <div class="admin-header">
        <h5 class="admin-header-tittle">Bienvenido al panel de administracion</h5>
        <a href="cerrar_sesion.php">
            <span class="material-symbols-outlined">
                Logout
            </span>
        </a>
    </div>
    <div class="admin">
        <div class="admin-venta">
            <?php
            $consulta = "SELECT v.id,v.id_evento, e.fecha, e.franja_horaria, u.nick_name FROM venta v
                        INNER JOIN evento e ON (e.id = v.id_evento) INNER JOIN usuario u ON (u.id = v.id_usuario)
                ;";
            $ventas = mysqli_query($conexion, $consulta);
            ?>
            <div class="admin-venta-boletas">
                <h6 class="admin-table-tittles">Boletas vendidas</h6>
                <div class="horizontal">
                    <p>Generar reporte de excel</p>
                    <a href="reporte_excel.php"><span class="material-symbols-outlined">
                            download
                        </span></a>

                </div>
                <div class="table-center">
                    <table class="form-card-boletas">
                        <tr>
                            <th>Id evento</th>
                            <th>Fecha</th>
                            <th>Franja horaria</th>
                            <th>Usuario</th>
                            <th>Acciones</th>


                        </tr>

                        <?php
                        while ($ventas_usuario = mysqli_fetch_array($ventas)) { ?>
                            <tr>

                                <td><?php echo $ventas_usuario['id_evento']; ?></td>
                                <td><?php echo $ventas_usuario['fecha']; ?></td>
                                <td><?php echo $ventas_usuario['franja_horaria']; ?></td>
                                <td><?php echo $ventas_usuario['nick_name']; ?></td>
                                <td><a href="eliminar_venta.php?id=<?php echo $ventas_usuario['id'] ?>"><span class="material-symbols-outlined">
                                            delete
                                        </span></a></td>
                            </tr>


                        <?php } ?>




                    </table>

                </div>
            </div>
            <form method="POST" action="crear_evento.php" class="crear-evento">
                <h5 class="admin-table-tittles">Crear evento</h5>

                <div class="crear-evento-form">
                    <label for="fecha_evento">Fecha evento</label><br>
                    <input type="date" id="fecha_evento" name="fecha_evento" min="2022-06-01" max="2022-06-30">
                    <label for="franja_horaria">Franja horaria</label><br>
                    <select name="franja_horaria" required>
                        <option value="" selected disabled hidden>Seleccione</option>
                        <option value="8:00">8:00 am - 12:00 pm</option>
                        <option value="12:00">12:00 pm - 6:00 pm</option>
                    </select>
                    <label for="cupo_maximo">Cupo maximo</label><br>
                    <input type="number" id="cupo_maximo" name="cupo_maximo" min="1" max="100">
                    <label for="semana_mes">Semana del mes</label><br>
                    <input type="number" id="semana_mes" name="semana_mes" min="1" max="5">
                </div>
                <input type="submit" value="Crear" name="btn_crear_evento" class="botones">
            </form>



        </div>
        <div class="admin-eventos-creado">

            <?php

            $consulta = "SELECT * FROM evento       
                    ;";
            $eventos_creados = mysqli_query($conexion, $consulta);
            ?>
            <h6 class="admin-table-tittles">Eventos creados</h6>

            <div class="table-center">

                <table class="form-card-boletas">
                    <tr>
                        <th>Id evento</th>
                        <th>Fecha</th>
                        <th>Franja horaria</th>
                        <th>Cupo actual</th>
                        <th>Cupo maximo</th>
                        <th>Semana</th>
                        <th>Acciones</th>

                    </tr>

                    <?php
                    while ($eventos = mysqli_fetch_array($eventos_creados)) { ?>
                        <tr>

                            <td><?php echo $eventos['id']; ?></td>
                            <td><?php echo $eventos['fecha']; ?></td>
                            <td><?php echo $eventos['franja_horaria']; ?></td>
                            <td><?php echo $eventos['cupo_actual']; ?></td>
                            <td><?php echo $eventos['cupo_maximo']; ?></td>
                            <td><?php echo $eventos['semana']; ?></td>
                            <td><a href="eliminar_evento.php?id=<?php echo $eventos['id'] ?>"><span class="material-symbols-outlined">
                                        delete
                                    </span></a></td>
                        </tr>


                    <?php } ?>

                </table>
            </div>
        </div>

    </div>

    <?php include("includes/footer.php"); ?>