<?php include("conexion_db.php"); ?>

<?php include("includes/header.php") ?>
<link rel="stylesheet" href="./estilos/login.css">

<title>Login</title>
</head>

<body onload="document.body.style.opacity='1'">
    <?php if (isset($_SESSION['mensaje'])) { ?>

        <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show alert-custome" role="alert">
            <?= $_SESSION['mensaje'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php session_unset();
    } ?>
    <div class="login">
        <img src="login2.svg" class="login-img">
        <div class="form-login">
            <form method="POST" action="iniciar_sesion.php" class="form-login-form">
                <h3><strong>Log in</strong></h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iure modi qu.</p>

                <div>
                    <label for="nick_name">Nick name</label><br>
                    <input type="text" name="nick_name" placeholder="nick name" class="form-login-input" required>

                </div>

                <div>
                    <label for="clave">Clave</label><br>
                    <input type="password" name="clave" required class="form-login-input">

                </div>

                <div></div>



                <input type="submit" value="Iniciar sesion" name="btn_iniciar_sesion" class="botones">
            </form>
            <p>¿No tienes una cuenta? <a href="registro.php">Registrate</a></p>
        </div>
    </div>



    <?php include("includes/footer.php"); ?>