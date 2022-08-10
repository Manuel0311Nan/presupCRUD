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
<body class="bg-danger container">
    <form class="bg-light mt-4 radius" action="registro.php" method="post">
      <div class="form-row container">
        <div class="form-group col-md-6">
          <label for="inputEmail4 text-danger">Empresa</label>
          <input type="text" class="form-control" id="empresa">
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Fecha</label>
          <input type="password" class="form-control" id="fecha">
        </div>
      </div>
      <div class="form-group">
        <label for="inputAddress">Address</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
      </div>
      <div class="form-group">
        <label for="inputAddress2">Address 2</label>
        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputCity">City</label>
          <input type="text" class="form-control" id="inputCity">
        </div>
        <div class="form-group col-md-4">
          <label for="inputState">State</label>
          <select id="inputState" class="form-control">
            <option selected>Choose...</option>
            <option>...</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="inputZip">Zip</label>
          <input type="text" class="form-control" id="inputZip">
        </div>
      </div>
      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gridCheck">
          <label class="form-check-label" for="gridCheck">
            Check me out
          </label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
    <!-- <main class="container-lg bg-white rounded my-2 p-5">
        <div class="d-flex justify-content-end">
            <a href="./lista.php" class="btn btn-danger">LISTA</a>
        </div>
        <form action="registro.php" method="post">
        <div class="row mx-0 justify-content-end my-3">
            <div id="empresaBox" class="col-12 col-sm-4 p-2">
                <div class="form-group">
                    <label class="text-red mb-1" for="">Empresa</label>
                    <input type="text" class="form-control" name="empresa" id="empresa" aria-describedby="helpId" placeholder="">
                    <span class="text-red error small d-none">Debe indicar la empresa</span>
                </div>
            </div>
            <div id="fechaBox" class="col-6 col-sm-4 p-2">
                <div class="form-group">
                    <label class="text-red mb-1" for="">Fecha</label>
                    <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="">
                </div>
            </div>
            <div id="num_presupuestoBox" class="col-6 col-sm-4 p-2">
                <div class="form-group">
                    <label class="text-red mb-1" for="">Nº Presupuesto</label>
                    <input type="text" class="form-control" readonly name="num_presupuesto" id="num_presupuesto" value="#<?= sprintf('%05d', $total); ?>" aria-describedby="helpId" placeholder="">
                </div>
            </div>
        </div>
        <div id="tituloBox" class="row mx-0 justify-content-center my-3">
            <div id="site" class="col-12 col-md-6 p-2">
                <div class="form-group">
                    <label class="text-red mb-1" for="">Titulo</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="">
                    <span class="text-red error small d-none">Añade el nombre del proyecto</span>
                </div>
            </div>
            <div id="precioBox"  class="col-12 col-md-6 p-2">
                <div class="form-group">
                    <label class="text-red mb-1" for="">Precio (€)</label>
                    <input type="number" class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="">
                    <span class="text-red error small d-none">Debe indicar el precio del presupuesto</span>
                </div>
            </div>
        </div>
        <div class="row mx-0 justify-content-center my-3">
            <div id="solicitudBox" class="col-12 col-md-6 p-2">
                <div class="form-group">
                    <label class="text-red mb-1" for="">¿Qué nos solicitan?</label>
                    <textarea class="form-control" name="solicitud" id="solicitud" rows="10"></textarea>
                    <span class="text-red error small d-none">Indica las necesidades del cliente</span>
                </div>
            </div>
            <div id="solucionBox" class="col-12 col-md-6 p-2">
                <div class="form-group">
                    <label class="text-red mb-1" for="">¿Qué ofrecemos nosotros?</label>
                    <textarea class="form-control" name="solucion" id="solucion" rows="10"></textarea>
                    <span class="text-red error small d-none">Debe indicar describir en que consitirá el desarrollo</span>
                </div>
            </div>
        </div>
        </form>
        <div class="row mx-0 justify-content-center my-3">
            <div class="col-12 col-md-6 p-2">
                <button type="submit" name="register" class="btn btn-danger w-100 btn-lg d-flex align-items-center justify-content-center">Generar presupuesto<span class="material-icons ms-2">save</span></button>
            </div>
        </div>
    </main> -->
</body>

</html>