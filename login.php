<?php
session_start();
if ($_POST) {
    include('./db.php');
    $sentencia = $conexion->prepare("SELECT *, count(*) as n_usuarios
     FROM `tbl_usuario` 
     WHERE usuario=:usuario 
     AND password=:password");

    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    if ($registro["n_usuarios"] > 0) {
        $_SESSION['usuario'] = $registro["usuario"];
        $_SESSION['logueado'] = true;
        header("location:index.php");
    } else {
        $mensaje = "El usuario o contraseña son incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MDB -->
    <link rel="stylesheet" href="./css/mdb.min.css" />
    <link rel="stylesheet" href="./css/nav.css" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>Inicio de sesión</title>
</head>

<body class="background-radial-gradient overflow-hidden">
    <!-- Section: Design Block -->
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                    La mejor oferta <br />
                    <span style="color: hsl(323, 56%, 75%)">para tus empleados</span>
                </h1>
                <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                    La Comisión Nacional de Libros de Texto Gratuitos,
                    es el organismo público descentralizado de la Administración Pública Federal
                    que para cada ciclo escolar produce y distribuye de manera gratuita los libros de texto que requieren los estudiantes
                    inscritos en el Sistema Educativo Nacional, así como otros libros y materiales que determine la Secretaría de Educación Pública.
                </p>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
                <div id="radius-shape-3" class="position-absolute shadow-5-strong"></div>

                <div class="card bg-glass">
                    <div class="card-body px-4 py-5 px-md-5">
                        <h3 class="mb-5"><b>Bienvenido</b></h3>
                        <?php if (isset($mensaje)) { ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <strong><?php echo $mensaje; ?></strong>
                            </div>
                        <?php } ?>

                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <!-- Pills navs -->
                        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Registrar</a>
                            </li>
                        </ul>
                        <!-- Pills navs -->

                        <!-- Pills content -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                                <form novalidate method="post" action="" enctype="multipart/form-data">
                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <input type="text" id="usuario" name="usuario" class="form-control" />
                                        <label class="form-label" for="usuario">Usuario</label>
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <input type="password" id="password" name="password" class="form-control" />
                                        <label class="form-label" for="password">Contraseña</label>
                                    </div>

                                    <!-- 2 column grid layout -->
                                    <div class="row mb-4">
                                        <div class="col-md-6 d-flex justify-content-center">
                                            <!-- Checkbox -->
                                            <div class="form-check mb-3 mb-md-0">
                                                <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                                <label style="color:#7e3763;" class="form-check-label" for="loginCheck"> Recuerdame </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 d-flex justify-content-center">
                                            <!-- Simple link -->
                                            <a style="color:#7e3763;" href="#!">Olvidaste tu contraseña?</a>
                                        </div>
                                    </div>

                                    <!-- Submit button -->
                                    <button class="btn btn-primary btn-block mb-4" type="submit" style="background-color: #7e3763;">Iniciar sesión</button>

                                    <!-- Register buttons -->
                                    <div class="text-center">
                                        <p><b>No tienes cuenta? </b><a href="#!" style="color:#7e3763;">Registrate</a></p>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                                <form novalidate method="post" action="" enctype="multipart/form-data">
                                    <!-- Username input -->
                                    <div class="form-outline mb-4">
                                        <input type="text" id="registerUsername" class="form-control" />
                                        <label class="form-label" for="registerUsername">Nombre</label>
                                    </div>

                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <input type="email" id="registerEmail" class="form-control" />
                                        <label class="form-label" for="registerEmail">Correo electronico</label>
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <input type="password" id="registerPassword" class="form-control" />
                                        <label class="form-label" for="registerPassword">Contraseña</label>
                                    </div>
                                    <!-- Submit button -->
                                    <button class="btn btn-primary btn-block mb-4" type="submit" style="background-color: #7e3763;">Registrar</button>
                                    <div class="text-center">
                                        <p><b>Ya tienes cuenta?</b> <a href="#!" style="color:#7e3763;">Inicia sesión</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Pills content -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        overflow: hidden;
    }

    .background-radial-gradient {
        background-color: hsl(323, 56%, 35%);
        background-image: radial-gradient(650px circle at 0% 0%,
                hsl(323, 56%, 35%) 15%,
                hsl(323, 56%, 30%) 35%,
                hsl(323, 56%, 20%) 75%,
                hsl(323, 56%, 19%) 80%,
                hsl(323, 56%, 19%) 80%,
                transparent 100%),
            radial-gradient(1250px circle at 100% 100%,
                hsl(323, 56%, 45%) 15%,
                hsl(323, 56%, 30%) 35%,
                hsl(323, 56%, 20%) 75%,
                hsl(323, 56%, 19%) 80%,
                transparent 100%);
    }

    #radius-shape-1 {
        height: 220px;
        width: 220px;
        top: -60px;
        left: -130px;
        background-image: linear-gradient(180deg, #ff9d7a 0, #ff8f83 10%, #ff8089 20%, #ff718d 30%, #ff628d 40%, #f25389 50%, #d34683 60%, #b63c7d 70%, #9e3678 80%, #883174 90%, #752e71 100%);
        overflow: hidden;
    }


    #radius-shape-2 {
        border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
        bottom: -60px;
        right: -110px;
        width: 300px;
        height: 300px;
        background-image: linear-gradient(180deg, #ff9d7a 0, #ff8f83 10%, #ff8089 20%, #ff718d 30%, #ff628d 40%, #f25389 50%, #d34683 60%, #b63c7d 70%, #9e3678 80%, #883174 90%, #752e71 100%);
        overflow: hidden;
    }

    .bg-glass {
        background-color: hsla(0, 0%, 100%, 0.9) !important;
        backdrop-filter: saturate(200%) blur(25px);
    }

    #radius-shape-3 {
        border-radius: 38% 62% 89% 30% / 70% 33% 67% 70%;
        bottom: -100px;
        right: 1310px;
        width: 300px;
        height: 300px;
        background-image: linear-gradient(180deg, #ff9d7a 0, #ff8f83 10%, #ff8089 20%, #ff718d 30%, #ff628d 40%, #f25389 50%, #d34683 60%, #b63c7d 70%, #9e3678 80%, #883174 90%, #752e71 100%);
        overflow: hidden;
    }

    .form-check-input:checked {
        background-color: #7e3763 !important;
        border: #7e3763 solid !important;
    }

    #tab-login {
        background: #7e3763 !important;
        color: #ffff;
    }

    #tab-register {
        background: #7e3763 !important;
        color: #fff;
    }
</style>
<script type="text/javascript" src="./js/mdb.min.js"></script>