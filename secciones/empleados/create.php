<?php include('../../db.php');
if ($_POST) {

  print_r($_POST);
  print_r($_FILES);
  //Recolectamos los datos del metodo post
  //https://gruporeforma.elnorte.com/interactivo/nacional/primer_informe_4t/images/ph_fondoplumaje2_2x_2x.png?crc=15792866
  //   <img src="https://ancris.net/imagenes/index/piePaginaFondo.png" style="width:100%; height:8%;"/>
  $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
  $apellido = (isset($_POST["apellido"]) ? $_POST["apellido"] : "");
  $foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] : "");
  $cv = (isset($_FILES["cv"]['name']) ? $_FILES["cv"]['name'] : "");
  $idpuesto = (isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "");
  $fechadeingreso = (isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] : "");

  //Preparar la insercion de los datos

  $sentencia = $conexion->prepare("INSERT INTO tbl_empleados(id, nombre, apellido, foto, cv,idpuesto,fechadeingreso) 
    VALUES (null, :nombre, :apellido, :foto, :cv, :idpuesto, :fechadeingreso)");

  //Asignando los valoes que vienen del metodo post del formulario
  $sentencia->bindParam(":nombre", $nombre);
  $sentencia->bindParam(":apellido", $apellido);
  $fecha_ = new DateTime();
  $add_foto = ($foto != '') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]['name'] : "";
  $tmp_foto = $_FILES["foto"]['tmp_name'];
  if ($tmp_foto != '') {
    move_uploaded_file($tmp_foto, "./" . $add_foto);
  }
  $add_cv = ($cv != '') ? $fecha_->getTimestamp() . "_" . $_FILES["cv"]['name'] : "";
  $tmp_cv = $_FILES["cv"]['tmp_name'];
  if ($tmp_cv != '') {
    move_uploaded_file($tmp_cv, "./" . $add_cv);
  }
  $sentencia->bindParam(":foto", $add_foto);
  $sentencia->bindParam(":cv", $add_cv);
  $sentencia->bindParam(":idpuesto", $idpuesto);
  $sentencia->bindParam(":fechadeingreso", $fechadeingreso);
  $sentencia->execute();
  $mensaje="Registro agregado";
  header("Location:index.php?mensaje=".$mensaje);
}
$sentencia = $conexion->prepare("SELECT * FROM tbl_puesto");
$sentencia->execute();
$list_tbl_puesto = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("../../templates/header.php"); ?>
<br>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../../css/mdb.min.css" />
<link rel="stylesheet" href="../../css/nav.css">
<!-- Latest compiled and minified CSS -->
<div class="card">
  <div class="card-header text-center" style="background: #7e3763; color: #fff;">
    <h4>Datos del empleado</h4>
  </div>
  <div class="card-body">
    <form class="row g-3 needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
      <!-- 2 column grid layout with text inputs for the first and last names -->
      <div class="row mb-4">
        <div class="col-6">
          <label for="select2" style="color: #7e3763 !important;">Nombre:</label>
          <div class="form-outline">
            <input type="text" id="nombre" name="nombre" class="form-control" required />
            <label class="form-label" for="lastname">Ingresa tu nombre</label>
          </div>
        </div>
        <div class="col-6">
          <label for="select2" style="color: #7e3763 !important;">Apellidos:</label>
          <div class="form-outline">
            <input type="text" id="apellido" name="apellido" class="form-control" />
            <label class="form-label" for="surname">Ingrese tus apellidos</label>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-6">
          <label style="color: #7e3763 !important;" class="form-label" for="customFile">Fotografia</label>
          <input type="file" name="foto" class="form-control" id="foto" />
        </div>
        <div class="col-6">
          <label style="color: #7e3763 !important;" class="form-label" for="customFile">CV en PDF</label>
          <input type="file" name="cv" class="form-control" id="cv" />
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-6">
          <label for="select2" style="color: #7e3763 !important;">Fecha de ingreso:</label>
          <div class="form-outline datepicker">
            <input type="date" name="fechadeingreso" class="form-control" id="fechadeingreso">
            <label for="exampleDatepicker1" class="form-label">Ingrese una fecha</label>
          </div>
        </div>
        <div class="col-6">
          <label for="select2" style="color: #7e3763 !important;">Ingresa un puesto:</label><br>
          <select id="idpuesto" name="idpuesto" class="selectpicker" aria-label="select example" style="background: #7e3763 !important;">
            <option selected>Seleccione una opcion</option>
            <?php foreach ($list_tbl_puesto as $registro) { ?>
              <option value="<?php echo $registro['id'] ?>"><?php echo $registro['puesto'] ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

  </div>
  <!-- Submit button -->
  <div class="text-center">
    <button class="btn btn-primary" type="submit" style="background-color: #7e3763;">Registrarme</button> &nbsp;&nbsp;&nbsp;
    <a class="btn btn-primary" type="button" href="index.php" style="background: #fff; color:#7e3763;">Cancelar</a>
  </div>
  <br>
  </form>
  <div class="card-footer text-muted" style="background: #7e3763;"></div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="../../js/mdb.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include("../../templates/footer.php"); ?>