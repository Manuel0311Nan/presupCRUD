<?php
session_start();
// !isset($_SESSION["auth"]) || $_SESSION["auth"] == false ? header('Location: ./parts/login.php') : '';
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/../src/functions.php");
require_once(dirname(__FILE__) . "/head.php");
require_once(dirname(__FILE__) . "/registro.php");
// require_once(dirname(__FILE__) . "/parts/loading.php");


$conexion = connectServer(SERVER, USER, PASS, DATABASE);
// if(isset($_GET['id'])){
//     $id = $_GET ['id'];
// $query = "SELECT * FROM presupuestos WHERE id = $id";

// $array = array();
// $valor = doQuery($conexion, $query, $array);
// $total = $valor->rowCount() + 1;
//         $row = mysqli_fetch_array($result);
//         $titulo = $row['titulo'];
//         $fecha_generacion = $row['fecha_generacion'];
//         $empresa = $row['empresa'];
//         $precio = $row['precio'];
//         $solucion = $row['solucion'];
//         $solicitud = $row['solicitud'];
// }
if(isset($_POST['update'])){
    $id = $_GET ['id'];
    $titulo = ucfirst(trim($_POST['titulo']));
    $fecha_generacion = $_POST['fecha_generacion'];
    $empresa = ucfirst(trim($_POST['empresa']));
    $precio = $_POST['precio'];
    $solucion = $_POST['solucion'];
    $solicitud = $_POST['solicitud'];

    $query = $conexion->prepare("UPDATE `presupuestos` SET  `titulo`= ':titulo',`fecha_generacion`=':fecha_generacion',`empresa`=':empresa',`precio`=':precio' WHERE id = $id");
    $query->bindParam(':num_presupuesto', $num_presupuesto);
    $query->bindParam(':titulo', $titulo);
    $query->bindParam(':fecha_generacion', $fecha_generacion);
    $query->bindParam(':empresa', $empresa);
    $query->bindParam(':precio', $precio);
    // $query->execute();
    header('Location: lista.php');
}

?>
<body class="container fw-bold" style="background-color:#ff9999 ;">
<div class=" d-flex justify-content-center align-items-center">
  <div class="mr-3">
<h1 class="text-center">Edición de presupuestos</h1>
<p class="text-center ">Edita los campos que necesites y generaremos un nuevo PDF</p>
</div>
<img class="rounded-circle img-fluid imag " src="../public/assets/img/logo.jpeg" alt="" >
</div>
<div class="d-flex my-2 justify-content-end">
            <a href="./lista.php" class="btn btn-dark">LISTADO</a>
        </div>
    <form class="bg-transparent mt-4" action="edit.php"  method="POST" target="./lista.php">
      <div class="form-row row container justify-content-md-center align-items-center">
      <div class="form-group col-md-7">
        <label for="num_presupuesto">Nº Presupuesto</label>
        <input class="form-control" id="num_presupuesto" name="num_presupuesto" placeholder="">
      </div>
      <div class="form-group col-md-2">
          <label for="fecha">Fecha</label>
          <input type="date" class="form-control" id="fecha" name="fecha_generacion" autofocus>
        </div>
      </div>
      <div class="form-row row container justify-content-md-center mt-2">
      <div class="form-group col-md-5">
          <label for=" empresa">Empresa</label>
          <input type="text" class="form-control" id="empresa" name="empresa" autofocus>
        </div>
      <div class="form-group col-md-4">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" placeholder="" name="titulo" autofocus>
      </div>
      <div class="form-group col-md-3">
          <label for=" precio">Precio</label>
          <input type="number" class="form-control" id="precio" name="precio" autofocus>
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
      <button name="update" type="submit" class="btn btn-danger p-2 mt-2 w-100 "> <span class="material-icons"> EDITAR  file_open</span></button>
      </div>
    </form>
</body>

</html>