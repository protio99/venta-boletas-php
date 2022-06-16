<?php include("conexion_db.php"); ?>

<?php include("includes/header.php") ?>
<link rel="stylesheet" href="./estilos/registro.css">
<link rel="stylesheet" href="./estilos/login.css">


<title>Registro</title>
</head>

<body onload="document.body.style.opacity='1'">
    <?php if (isset($_SESSION['mensaje'])) { ?>

        <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show alert-custome" role="alert">
            <?= $_SESSION['mensaje'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php session_unset();
    } ?>
    <div class="registro">
        <div class="registro-form">
            <form method="POST" action="crear_usuario.php" class="form-card">
                <h3 class="registro-form-titulo"><strong>Formulario de registro</strong></h3>
                <div>
                    <label for="nombre">Nombre</label><br>
                    <input type="text" name="nombre" placeholder="nombre" class="form-input" value="<?php isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">

                </div>

                <div>
                    <label for="nick_name">Nick name</label><br>
                    <input type="text" name="nick_name" placeholder="nick name" class="form-input" value="<?php isset($_POST['nick_name']) ? echo $nick_name : ''; ?>">

                </div>

                <div>
                    <label for="clave">Clave</label><br>
                    <input type="password" name="clave" class="form-input" value="<?php isset($clave) ?  $clave : ''; ?>">

                </div>

                <div></div>
                <input type="submit" value="Registrarse" name="btn_registro" class="botones">


            </form>
            <hr>
            <a href="login.php">Volver</a>

        </div>
    </div>

    <?php include("includes/footer.php"); ?>