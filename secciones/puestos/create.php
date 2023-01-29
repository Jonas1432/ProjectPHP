<?php include('../../db.php'); 
  if($_POST){

    //Recolectamos los datos del metodo post

    $puesto=(isset($_POST["puesto"])?$_POST["puesto"]:"");
    $area=(isset($_POST["area"])?$_POST["area"]:"");
    
    //Preparar la insercion de los datos

    $sentencia=$conexion->prepare("INSERT INTO tbl_puesto(id, puesto, area) 
    VALUES (null, :puesto, :area)");

    //Asignando los valoes que vienen del metodo post del formulario
    $sentencia->bindParam(":puesto",$puesto);
    $sentencia->bindParam(":area",$area);
    $sentencia->execute();
    $mensaje="Registro agregado";
    header("Location:index.php?mensaje=".$mensaje);

  }
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
    <h4>Agregar puesto</h4>
  </div>
  <div class="card-body">
    <form class="row g-3 needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
      <!-- 2 column grid layout with text inputs for the first and last names -->
      <div class="row mb-4">
        <div class="col-6">
          <label for="select2" style="color: #7e3763 !important;">Ingresa el puesto:</label>
          <div class="form-outline">
            <input type="text" id="puesto" name="puesto" class="form-control" />
            <label class="form-label" for="puesto">Ingrese un puesto</label>
          </div>
        </div>
        <div class="col-6">
          <label for="select2" style="color: #7e3763 !important;">Nombre del área:</label>
          <div class="form-outline">
            <input type="text" id="area" name="area" class="form-control" required />
            <label class="form-label" for="area">Ingresa una área</label>
          </div>
        </div>
      </div>

      <!-- Submit button -->
      <div class="text-center">
        <button class="btn btn-primary" type="submit" style="background-color: #7e3763;">Registrarme</button> &nbsp;&nbsp;&nbsp;
        <a class="btn btn-primary" type="button" href="index.php" style="background: #fff; color:#7e3763;">Cancelar</a>
      </div>
    </form>
  </div>
  <div class="card-footer text-muted" style="background: #7e3763;"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="../../js/mdb.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include("../../templates/footer.php"); ?>