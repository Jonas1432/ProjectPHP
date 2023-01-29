<?php include('../../db.php');
if (isset($_GET['txtID'])) {
  $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

  $sentencia = $conexion->prepare("DELETE FROM tbl_puesto WHERE id=:id");
  $sentencia->bindParam(":id", $txtID);
  $sentencia->execute();
  $mensaje = "Registro eliminado";
  header("Location:index.php?mensaje=" . $mensaje);
}

$sentencia = $conexion->prepare("SELECT * FROM tbl_puesto");
$sentencia->execute();
$list_tbl_puesto = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("../../templates/header.php"); ?>
<br>
<link rel="stylesheet" href="../../css/mdb.min.css" />
<link rel="stylesheet" href="../../css/nav.css">
<div class="card card-cascade narrower border border-light">
  <div class="card-header py-2 d-flex justify-content-between align-items-center" style="background: #7e3763 !important; color: #fff;">
    <div class="row">
      <h2>&nbsp;&nbsp;Gestionar Puestos</h2>
    </div>
    <div class="form-outline col-sm-4">
      <i class="fas fa-search trailing" style="color: #fff;"></i>
      <input id="searchTerm" type="text" onkeyup="doSearch()" class="search form-control form-icon-trailing" style="color:#fff ;" />
      <label class="form-label" style="color:#fff;">Buscar Registro</label>
    </div>
    <div>
      <a type="button" href="create.php" class="btn btn-outline-light btn-rounded" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Agregar usuarios">
        <i class="fa-sharp fa-solid fa-address-card"></i>
      </a>
    </div>
  </div>
 
</div>
  <table id="datos" class="table align-middle mb-0 bg-white results">
    <thead class="bg-light">
      <tr style="color: #7e3763;">
        <th scope="col">ID</th>
        <th scope="col">Nombre del puesto</th>
        <th scope="col">Área</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($list_tbl_puesto as $registro) { ?>
        <tr class="">
          <td scope="row"><?php echo $registro['id'] ?></td>
          <td><?php echo $registro['puesto'] ?></td>
          <td><?php echo $registro['area'] ?></td>
          <td>
            <a href="update.php?txtID=<?php echo $registro['id'] ?>" role="button" class="btn btn-outline btn-floating" style=" color: #7e3763; border: 1px solid #7e3763;" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Editar" data-mdb-ripple-color="dark">
              <i style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" class="fa-solid fa-pen-to-square"></i>
            </a>
            <a href="javascript:borrar(<?php echo $registro['id'] ?>);" role="button" class="btn btn-outline btn-floating" style=" color: #7e3763; border: 1px solid #7e3763;" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Eliminar" data-mdb-ripple-color="dark">
              <i style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" class="fa-solid fa-trash"></i>
            </a>
          </td>
        </tr>
      <?php } ?>
      <tr class='noSearch hide'>

        <td colspan="4" class="text-center" style="color: #7e3763;"></td>

      </tr>
    </tbody>
  </table>
</div>
</div>
</div>
<div class="card-footer" style="background: #7e3763;">
</div>
</div>

<script type="text/javascript">
  function doSearch() {

    const tableReg = document.getElementById('datos');

    const searchText = document.getElementById('searchTerm').value.toLowerCase();

    let total = 0;

    // Recorremos todas las filas con contenido de la tabla

    for (let i = 1; i < tableReg.rows.length; i++) {

      // Si el td tiene la clase "noSearch" no se busca en su contenido

      if (tableReg.rows[i].classList.contains("noSearch")) {

        continue;

      }



      let found = false;

      const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');

      // Recorremos todas las celdas

      for (let j = 0; j < cellsOfRow.length && !found; j++) {

        const compareWith = cellsOfRow[j].innerHTML.toLowerCase();

        // Buscamos el texto en el contenido de la celda

        if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {

          found = true;

          total++;

        }

      }

      if (found) {

        tableReg.rows[i].style.display = '';

      } else {

        // si no ha encontrado ninguna coincidencia, esconde la

        // fila de la tabla

        tableReg.rows[i].style.display = 'none';

      }

    }



    // mostramos las coincidencias

    const lastTR = tableReg.rows[tableReg.rows.length - 1];

    const td = lastTR.querySelector("td");

    lastTR.classList.remove("hide", "red");

    if (searchText == "") {

      lastTR.classList.add("hide");

    } else if (total) {

      td.innerHTML = "Se ha encontrado " + total + " coincidencia" + ((total > 1) ? "s" : "");

    } else {

      lastTR.classList.add("red");

      td.innerHTML = "No se han encontrado coincidencias";

    }

  }
</script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="../../js/mdb.min.js"></script>
<?php include("../../templates/footer.php"); ?>