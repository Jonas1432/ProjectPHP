<?php include('../../db.php');
if (isset($_GET['txtID'])) {
  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

  $sentencia = $conexion->prepare("SELECT * FROM tbl_usuario WHERE id=:id");
  $sentencia->bindParam(":id", $txtID);
  $sentencia->execute();
  $registro=$sentencia->fetch(PDO::FETCH_LAZY);
  $usuario=$registro['usuario'];
  $password=$registro['password'];
  $correo=$registro['correo'];
}
if($_POST){

  //Recolectamos los datos del metodo post
  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
  $password=(isset($_POST["password"])?$_POST["password"]:"");
  $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
  
  //Preparar la insercion de los datos

  $sentencia=$conexion->prepare("UPDATE tbl_usuario SET usuario=:usuario, password=:password, correo=:correo WHERE id=:id");

  //Asignando los valoes que vienen del metodo post del formulario
  $sentencia->bindParam(":usuario",$usuario);
  $sentencia->bindParam(":password",$password);
  $sentencia->bindParam(":correo",$correo);
  $sentencia->bindParam(":id",$txtID);
  $sentencia->execute();
  $mensaje="Registro actualizado";
  header("Location:index.php?mensaje=".$mensaje);

}
?>

<?php include("../../templates/header.php"); ?>
<link rel="stylesheet" href="../../css/mdb.min.css" />
<link rel="stylesheet" href="../../css/nav.css">
<br>
<div class="card">
  <div class="card-header text-center" style="background: #7e3763; color: #fff;">
    <h4>Editar Usuario</h4>
  </div>
  <div class="card-body">
    <form class="row g-3 needs-validation" novalidate method="post" action="" enctype="multipart/form-data">
      <!-- 2 column grid layout with text inputs for the first and last names -->
      <div class="row mb-4" style="display: none;">
        <div class="col-12">
          <label for="select2" style="color: #7e3763 !important;">ID:</label>
          <div class="form-outline">
            <input type="text" value="<?php echo $registro['id'] ?>" id="txtID" name="txtID" class="form-control" required />
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-12">
          <label for="select2" style="color: #7e3763 !important;">Nombre del usuario:</label>
          <div class="form-outline">
            <input type="text" id="usuario" value="<?php echo $registro['usuario'] ?>" name="usuario" class="form-control" required />
            <label class="form-label" for="usuario">Ingresa tu usuario</label>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-12">
          <label for="select2" style="color: #7e3763 !important;">Contraseña:</label>
          <div class="form-outline">
            <input type="password" aria-describedby="helpId" value="<?php echo $registro['password'] ?>" id="password" name="password" class="form-control" />
            <label class="form-label" for="password">Ingrese una contraseña</label>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-12">
          <label for="select2" style="color: #7e3763 !important;">Correo electronico:</label>
          <div class="form-outline">
            <input type="email" id="correo" value="<?php echo $registro['correo'] ?>" name="correo" class="form-control" required />
            <label class="form-label" for="correo">Ingresa un correo electronico</label>
          </div>
        </div>
      </div>

      <!-- Submit button -->
      <div class="text-center">
        <button class="btn btn-primary" type="submit" style="background-color: #7e3763;">Actualizar</button> &nbsp;&nbsp;&nbsp;
        <a class="btn btn-primary" type="button" href="index.php" style="background: #fff; color:#7e3763;">Cancelar</a>
      </div>
    </form>
  </div>
  <div class="card-footer text-muted text-center"><img src="../../img/mexico.ico" style="width: 10%; height:10%;" alt=""></div>
</div>


<script type="text/javascript" src="../../js/mdb.min.js"></script>
<?php include("../../templates/footer.php"); ?>