<?php

include('../../db.php');

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT *,
    (SELECT puesto FROM tbl_puesto WHERE tbl_puesto.id=tbl_empleados.idpuesto limit 1) as puesto FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $nombre = $registro['nombre'];
    $apellido = $registro['apellido'];
    $foto = $registro['foto'];
    $cv = $registro['cv'];
    $idpuesto = $registro['idpuesto'];
    $fechadeingreso = $registro['fechadeingreso'];

    $fechaInicio = new DateTime($fechadeingreso);
    $fechaFin = new DateTime(date('y-m-d'));
    $diferencia = date_diff($fechaInicio, $fechaFin);

    /* $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":apellido", $apellido);
    $sentencia->bindParam(":foto", $add_foto);
    $sentencia->bindParam(":cv", $add_cv);
    $sentencia->bindParam(":idpuesto", $idpuesto);
    $sentencia->bindParam(":fechadeingreso", $fechadeingreso);*/
}
ob_start();
?>
<link rel="stylesheet" href="../../css/mdb.min.css" />
<link rel="stylesheet" href="../../css/nav.css">
<!-- Latest compiled and minified CSS -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de Recomendacion</title>
</head>

<body style="background-image:url('https://pbs.twimg.com/ext_tw_video_thumb/1300590518016118784/pu/img/eFXhwuG_ZJMqU_Wv.jpg:large');
    background-repeat: no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-1">
                <label for=""></label>
            </div>
            <div class="col-10">
                <div class="row">
                    <p style="text-align: right;font-weight: bold;">Emiliano Zapata, Mor., <?php echo date('d M Y') ?></p>
                    <p style="font-weight: bold;">ING. EDUARDO MARTÍNEZ VILLALOBOS &nbsp; </p>

                    <p style="font-weight: bold;">JEFE DEL ÁREA DE CÓMPUTO E INFORMÁTICA</p>

                    <p style="font-weight: bold;">TRIBUNAL SUPERIOR DE JUSTICIA DEL ESTADO DE MORELOS</p>

                    <p style="font-weight: bold;">P R E S E N T E.</p>

                    <p style="font-weight: bold; text-align: center;">CARTA DE PRESENTACIÓN</p>

                    <p>Por este conducto me permito presentar a C. <strong><?php echo $registro['nombre'] ?> <?php echo $registro['apellido'] ?></strong> estudiante del 11vo B
                        de la carrera de <strong>INGENIERÍA EN DESARROLLO Y GESTIÓN DE SOFTWARE</strong> de esta Universidad con numero
                        de experiencia <strong><?php echo $diferencia->y; ?> año(s)</strong> y quién desea realizar su estadía dentro de su empresa con el puesto <strong><?php echo $registro['puesto'] ?></strong> durante el período del 09 de
                        enero de 2023 al 21 de abril de 2023, cubriendo un total de 500 horas.</p>

                    <p>Lo anterior es con el objeto de consolidar la formación práctica del estudiante, ejerciendo las funciones propias de
                        la <strong>INGENIERÍA EN DESARROLLO Y GESTIÓN DE SOFTWARE</strong>. Así mismo informo a usted que el estudiante
                        cuenta con un Seguro Facultativo del IMSS número 27159818916 proporcionado por la escuela y sin costo para
                        su empresa</p>

                    <p>
                        Agradeciendo de antemano la atención que se sirva prestar a la presente, sin otro particular por el momento,
                        aprovecho la oportunidad para enviarle un cordial saludo.
                    </p>

                    <br>

                    <p style="font-weight: bold;">ATENTAMENTE</p>
                    <p style="font-weight: bold;"> M.A. VIVIANISSEL ARIZA BATALLA</p>
                    <p style="font-weight: bold;">JEFA DEL DEPARTAMENTO DE ESTADÍAS Y SEGUIMIENTO A EGRESADOS</p>
                    <img src="https://riskperu.com/wp-content/uploads/2021/10/frima-miguel-min.png" alt="firma" style="width:30%; height:15%;">
                    <br><br>
                    <small>La información de carácter personal recabada en este documento, será protegida por la Universidad Tecnológica Emiliano Zapata del Estado de Morelos de
                        acuerdo a lo establecido en la Ley de Protección de Datos Personales en Posesión de los Sujetos Obligados del Estado de Morelos. Consulte nuestro aviso de
                        privacidad en la página web de la UTEZ http://www.utez.edu.mx/.</small><br><br>
                    <hr style="background:#7e3763; height: 2px; width: 70%;">
                    <hr style="background:#7e3763; border-radius: 300px/100px; height: 2%; text-align: center;">


                </div>
            </div>
            <div class="col-1">
                <label for=""></label>
            </div>
        </div>
    </div>
</body>

</html>

<?php
$HTML = ob_get_clean();
require_once("../../libs/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$opciones = $dompdf->getOptions();
$opciones->set(array("isRemoteEnabled" => true));
$dompdf->setOptions($opciones);

$dompdf->loadHtml($HTML);

$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));


?>
<script type="text/javascript" src="../../js/mdb.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>