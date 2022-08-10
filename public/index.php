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
<body class="bg-danger">
    <main class="container-lg bg-white rounded my-2 p-5">
        <div class="d-flex justify-content-end">
            <a href="./lista" class="btn btn-danger">LISTA</a>
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
    </main>
</body>

</html>