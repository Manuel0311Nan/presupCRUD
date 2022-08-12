<?php
session_start();
// !isset($_SESSION["auth"]) || $_SESSION["auth"] == false ? header('Location: ./parts/login.php') : '';
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/../src/functions.php");
require_once(dirname(__FILE__) . "/head.php");
require_once(dirname(__FILE__) . "/registro.php");
// require_once(dirname(__FILE__) . "/parts/loading.php");


$conexion = connectServer(SERVER, USER, PASS, DATABASE);
$id = $_GET ['id'];
$sql = "SELECT * FROM presupuestos WHERE id= $id";
$array = array();
$valor = doQuery($conexion, $sql, $array);

if(isset($_POST['update'])){
    $id = $_GET ['id'];
    $titulo =trim($_POST['titulo']);
    $fecha_generacion = $_POST['fecha_generacion'];
    $empresa = trim($_POST['empresa']);
    $precio = $_POST['precio'];
    $solucion = $_POST['solucion'];
    $solicitud = $_POST['solicitud'];
    $query = $conexion->prepare("UPDATE presupuestos SET  titulo= '$titulo', fecha_generacion= '$fecha_generacion', empresa= '$empresa', precio= '$precio' WHERE id = $id");
    // $query->bindParam(':num_presupuesto', $num_presupuesto);
    // $query->bindParam(':titulo', $titulo);
    // $query->bindParam(':fecha_generacion', $fecha_generacion);
    // $query->bindParam(':empresa', $empresa);
    // $query->bindParam(':precio', $precio);
    $query->execute(); //se rompe con esta linea
    header('Location: lista.php');
}

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
<body class="container fw-bold data" >
<div class=" d-flex justify-content-center align-items-center bg-data">
  <div class="mr-3">
<h1 class="text-center">Edición de presupuestos</h1>
<p class="text-center ">Edita todos los campos que necesites y generaremos un nuevo PDF</p>
</div>
<img class="rounded-circle img-fluid imag " src="../public/assets/img/logo.jpeg" alt="" >
</div>
<div class="d-flex my-2 justify-content-end col-12">
            <a href="./lista.php" class="btn boton fw-bold col-12 col-sm-4 col-lg-2">LISTADO</a>
        </div>
    <form class="bg-transparent mt-4" action="edit.php?id=<?php echo  $_GET['id']; ?>"  method="POST" target="./lista.php">
      <div class="form-row row container justify-content-md-center align-items-center">
      <div class="form-group col-md-7">
      <?php
                while($p = $valor->fetch(PDO::FETCH_ASSOC))
                {?>
        <label for="num_presupuesto">Nº Presupuesto</label>
        <input value="<?php echo $p['num_presupuesto']; ?>"  class="form-control" id="num_presupuesto" name="num_presupuesto" placeholder="" readonly>
      </div>
      <?php } ?>
      <div class="form-group col-md-2">
          <label for="fecha_generacion">Fecha</label>
          <input type="date" class="form-control " id="fecha" name="fecha_generacion" autofocus>
        </div>
      </div>
      <div class="form-row row container justify-content-md-center mt-2">
      <div class="form-group col-md-5">
          <label for="empresa">Empresa</label>
          <input type="text" class="form-control" id="empresa" name="empresa" autofocus required>
        </div>
      <div class="form-group col-md-4">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" autofocus required>
      </div>
      <div class="form-group col-md-3">
          <label for=" precio">Precio</label>
          <input type="number" class="form-control" id="precio" name="precio" autofocus required>
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