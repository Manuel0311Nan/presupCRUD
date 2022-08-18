<?php
session_start();
// !isset($_SESSION["auth"]) || $_SESSION["auth"] == false ? header('Location: ./parts/login.php') : '';
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/../src/functions.php");
require_once(dirname(__FILE__) . "/head.php");
require_once(dirname(__FILE__) . "/registro.php");
// require_once(dirname(__FILE__) . "/parts/loading.php");


$conexion = connectServer(SERVER, USER, PASS, DATABASE);
$query = "SELECT * FROM presupuestos";
$array = array();
$valor = doQuery($conexion, $query, $array);
$total = $valor->rowCount() + 1;


?>
<style>
      *{
        font-family: 'Roboto', sans-serif;
    }
  .data{
    background-color:#8D99AE;
}
.boton{
  background-color: #2B2D42;
  color: #EDF2F4;
}
.boton:hover{
    color: #EDF2F4;
}
</style>
<body class="container fw-bold data ">
<div class=" d-flex justify-content-center align-items-center">
  <div class="mr-3">
<h1 class="text-center">Creación de presupuestos</h1>
<p class="text-center ">Rellena todos los campos disponibles</p>
</div>
<img class="rounded-circle img-fluid imag " src="../public/assets/img/logo.jpeg" alt="" >
</div>
<div class="d-flex my-2 justify-content-end">
            <a href="./lista.php" class="btn boton fw-bold col-12 col-sm-4 col-lg-2">LISTADO</a>
        </div>
    <form class="bg-transparent mt-4" action="create_pdf.php" method="post" target="./lista.php">
      <div class="form-row row container justify-content-md-center align-items-center">
      <div class="form-group col-md-7">
        <label for="num_presupuesto">Nº Presupuesto</label>
        <input class="form-control" id="num_presupuesto" name="num_presupuesto" placeholder="" readonly>
        <span class="text-red error small d-none">Debe indicar describir en que consitirá el desarrollo</span>
      </div>
      <div class="form-group col-md-2">
          <label for="fecha_generacion">Fecha</label>
          <input type="date" class="form-control" id="fecha_generacion" name="fecha_generacion" readonly>
          <span class="text-red error small d-none">Debe indicar describir en que consitirá el desarrollo</span>
        </div>
      </div>
      <div class="form-row row container justify-content-md-center mt-2">
      <div class="form-group col-md-5">
          <label for="empresa">Empresa</label>
          <input type="text" class="form-control" id="empresa" name="empresa" autofocus required>
          <span class="text-red error small d-none">Debe indicar describir en que consitirá el desarrollo</span>
        </div>
      <div class="form-group col-md-4">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" placeholder="" name="titulo" autofocus required>
        <span class="text-red error small d-none">Debe indicar describir en que consitirá el desarrollo</span>
      </div>
      <div class="form-group col-md-3">
          <label for="precio">Precio</label>
          <input type="number" class="form-control" id="precio" name="precio" autofocus required>
          <span class="text-red error small d-none">Debe indicar describir en que consitirá el desarrollo</span>
        </div>
      </div>
      <div class="form-row row justify-content-md-center">
        <div class="form-group col-md-12 mt-2">
          <label class="mx-md-3" for="solicitud">Solicitud</label>
          <textarea type="text" class="form-control " id="solicitud" name="solicitud" rows="5" required> </textarea>
          <span class="text-red error small d-none">Debe indicar describir en que consitirá el desarrollo</span>
        </div>
        <div class="form-group col-md-12 mt-2">
          <label for="solucion">Solución</label>
          <textarea type="text" class="form-control" id="solucion" name="solucion" rows="5" required> </textarea>
          <span class="text-red error small d-none">Debe indicar describir en que consitirá el desarrollo</span>
        </div>
        </div>
        <div class="d-flex justify-content-center">
      <button id="crear_presupuesto"  name="crear_presupuesto" type="submit" class="btn btn-danger p-2 mt-2 w-100 "> GENERAR <span class="material-icons">file_open</span></button>
      </div>
    </form>
</body>
<script>
var now = new Date();

var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);

var hoy =  now.getFullYear() + "-" + (month) + "-" + (day);
            $("#fecha_generacion").val(hoy)
            
const  generateRandomString = (num) => {
var text = ""; var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; for( var i=0; i < num; i++ ) text += possible.charAt(Math.floor(Math.random() * possible.length)); return text;
    }
$("#num_presupuesto").val("#" + generateRandomString(5));
            // $("#saveOnDevice").click(function() {
            //     var empresa = $("#empresa").val();
            //     var fecha = $("#fecha_generacion").val();
            //     var num_presupuesto = $("#num_presupuesto").val();
            //     var titulo = $("#titulo").val();
            //     var precio = $("#precio").val();
            //     var solicitud = $("#solicitud").val();
            //     var solucion = $("#solucion").val();

            //     if (empresa.trim() == "" || empresa.trim() == null) {
            //         $('#empresa ~ .error').removeClass("d-none")
            //     } else {
            //         $('#empresa ~ .error').addClass("d-none")
            //         if (titulo.trim() == "" || titulo.trim() == null) {
            //             $('#titulo ~ .error').removeClass("d-none")
            //         } else {
            //             $('#titulo ~ .error').addClass("d-none")
            //         if (precio.trim() == "" || precio.trim() == null) {
            //             $('#precio ~ .error').removeClass("d-none")
            //         } else {
            //             $('#precio ~ .error').addClass("d-none")
            //         if (solicitud.trim() == "" || solicitud.trim() == null) {
            //             $('#solicitud ~ .error').removeClass("d-none")
            //         } else {
            //             $('#solicitud ~ .error').addClass("d-none")
            //         if (solucion.trim() == "" || solucion.trim() == null) {
            //             $('#solucion ~ .error').removeClass("d-none")
            //         } else {
            //             $('#solucion ~ .error').addClass("d-none")
            //               var fd = new FormData();
            //                 fd.append("action", "create_pdf");
            //                 fd.append("empresa", empresa.trim());
            //                 fd.append("fecha_generacion", fecha.trim());
            //                 fd.append("num_presupuesto", num_presupuesto.trim());
            //                 fd.append("titulo", titulo.trim());
            //                 fd.append("precio", precio.trim());
            //                 fd.append("solicitud", solicitud.trim());
            //                 fd.append("solucion", solucion.trim());

            //                 $.ajax({
            //                     data: fd,
            //                     url: './apiController.php',
            //                     method: 'POST',
            //                     dataType: "json",
            //                     processData: false,
            //                     contentType: false,
            //                     beforeSend: function() {
            //                         loading.show()
            //                     }
            //                 }).done(function(data) {
            //                     console.log(data);
            //                     loadingHide()
            //                     switch (data.status) {
            //                         case 'exito':
            //                                 window.open(data.result, '_blank');
            //                                 window.location.reload();
            //                             break;
            //                     }
            //                 })
            //               }
            //             }
            //         }
            //         }
            //         }
            // })


</script>
</html>