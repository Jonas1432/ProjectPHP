<?php
session_start();
$url_base = "http://localhost/ProjectApp/";
if (!isset($_SESSION['usuario'])) {
  header("location:" . $url_base . "/login.php");
} else {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Portal del trabajo</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mexico.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
  <link rel="stylesheet" href="css/nav.css">
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <header>

  </header>
  <!-- Start your project here-->
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="<?php echo $url_base ?>">
          <img src="https://www.michoacan.gob.mx/wp-content/uploads/2021/09/cropped-LogoGobMich-Escudo-Guinda-600-600.png" height="45" alt="MDB Logo" loading="lazy" />
        </a>
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" id="nav" href="<?php echo $url_base ?>secciones/empleados/">Empleados</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="nav" href="<?php echo $url_base ?>secciones/puestos/">Puestos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="nav" href="<?php echo $url_base ?>secciones/usuarios/">Usuarios</a>
          </li>
        </ul>
        <!-- Left links -->
      </div>
      <!-- Collapsible wrapper -->

      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <a class="nav-link disabled"><b style="color:#7e3763;"><?php echo $_SESSION['usuario']; ?></b></a>
        <div class="dropdown">
          <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img src="https://departamento.us.es/deconapli1/wp-content/uploads/2022/01/user_rojo.png" style="background: #7e3763;" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy" />
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
            <li>
              <a class="dropdown-item" id="nav" href="<?php echo $url_base ?>">Inicio</a>
            </li>
            <li>
              <a class="dropdown-item" id="nav" href="<?php echo $url_base ?>cerrar.php"> Cerrar Sesión</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
  </nav>

  <br>
  <main class="container">
    <?php if(isset($_GET['mensaje'])){ ?>
      <script>
        Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje']; ?>"});
      </script>
   <?php  } ?>