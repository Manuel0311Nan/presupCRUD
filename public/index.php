<?php
session_start();
// !isset($_SESSION["auth"]) || $_SESSION["auth"] == false ? header('Location: ./parts/login.php') : '';
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/../src/functions.php");
require_once(dirname(__FILE__) . "/head.php");
// require_once(dirname(__FILE__) . "/parts/loading.php");


$conexion = connectServer(SERVER, USER, PASS, DATABASE);
$query = "SELECT * FROM presupuestos";
$array = array();
$valor = doQuery($conexion, $query, $array);
$total = $valor->rowCount() + 1;

?>
<body class="container fw-bold" style="background-color:#ff9999 ;">
<div class=" d-flex justify-content-center align-items-center">
  <div class="mr-3">
<h1 class="text-center">Presupuestos</h1>
<p class="text-center ">Introduce todos los datos para recibir un PDF</p>
</div>
<img class="rounded-circle img-fluid imag " src="../public/assets/img/logo.jpeg" alt="" >
</div>
    <form class="bg-transparent mt-4" action="registro.php" method="post">
      <div class="form-row row container justify-content-md-center align-items-center">
      <div class="form-group col-md-7">
        <label for="inputAddress">Nº Presupuesto</label>
        <input class="form-control" id="num_presupuesto" name="num_presupuesto" placeholder=""  readonly disabled>
      </div>
      <div class="form-group col-md-2">
          <label for="inputPassword4">Fecha</label>
          <input type="date" class="form-control" id="fecha" name="fecha_generacion" autofocus>
        </div>
      </div>
      <div class="form-row row container justify-content-md-center mt-2">
      <div class="form-group col-md-5">
          <label for="inputEmail4 text-danger">Empresa</label>
          <input type="text" class="form-control" id="empresa" name="empresa" autofocus>
        </div>
      <div class="form-group col-md-4">
        <label for="inputAddress2">Título</label>
        <input type="text" class="form-control" id="titulo" placeholder="" name="titulo" autofocus>
      </div>
      <div class="form-group col-md-3">
          <label for="inputEmail4 text-danger">Precio</label>
          <input type="text" class="form-control" id="precio" name="precio" autofocus>
        </div>
      </div>
      <div class="form-row row justify-content-md-center">
        <div class="form-group col-md-12 mt-2">
          <label class="mx-md-3" for="solicitud">Solicitud</label>
          <textarea type="text" class="form-control " id="solicitud" name="solicitud" rows="5"> </textarea>
        </div>
        <div class="form-group col-md-12 mt-2">
          <label for="solucion">Solución</label>
          <textarea type="text" class="form-control" id="solucion" name="solucion" rows="5"> </textarea>
        </div>
        </div>
        <div class="d-flex  justify-content-center">
      <button name="crearPresupuesto" type="submit" class="btn btn-danger p-2 mt-2 w-100 ">Generar Presupuesto</button>
      </div>
    </form>
</body>

</html>