</main>
<section class="">
  <!-- Footer -->
  <footer class="text-center text-white" style="background-color: #7e3763;  position: fixed; left: 0;
   bottom: 0; width: 100%; text-align: center;">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: CTA -->

      <!-- Section: CTA -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="p-1" style="background-color: rgba(0, 0, 0, 0.1);">
      <div class="container">
        <div class="row">
          <div class="col-4">
            <label for=""></label>
          </div>
          <div class="col-4">
            <img src="https://www.gob.mx/cms/uploads/image/file/522774/escudo.png" style="width: 10%; height:100%;" alt="">
          </div>
          <div class="col-4">
            <label for=""></label>
          </div>
        </div>
      </div>

    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</section>
<!-- Navbar -->
<!-- End your project here-->

<!-- MDB -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Custom scripts -->
<script type="text/javascript">
    function borrar(id) {
    //index.php?txtID=
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: '¿Deseas eliminar el registro?',
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Aceptar',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "index.php?txtID=" + id;

      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Accion Cancelada',
          '',
          'error'
        )
      }
    })
  }
  function editar(id) {
    //index.php?txtID=
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: '¿Estas seguro de editar el registro?',
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Aceptar',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "index.php?txtID=" + id;

      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Accion Cancelada',
          '',
          'error'
        )
      }
    })
  }
  $(document).ready(function() {
    $("#datos").DataTable({
      "pageLength":3,
      lengthMenu:[
        [3,10,25,50],
        [3,10,25,50]
      ],
      "language":{
        "url":"https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json",
      }
    });
  });
  
</script>

</body>

</html>