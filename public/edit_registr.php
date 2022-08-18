<?php
require_once(dirname(__FILE__) . '/../config/config.php');
// require_once('../src/create_pdf.php');
$conexion = connectServer(SERVER, USER, PASS, DATABASE);

$conexion = connectServer(SERVER, USER, PASS, DATABASE);
$id = $_GET ['id'];
$sql = "SELECT * FROM presupuestos WHERE id= $id";
$array = array();
$valor = doQuery($conexion, $sql, $array);

if(isset($_POST['update'])){
    $id = $_GET ['id'];
    $num_presupuesto = trim($_POST['num_presupuesto']);
    $titulo =trim($_POST['titulo']);
    $fecha_generacion = $_POST['fecha_generacion'];
    $empresa = trim($_POST['empresa']);
    $precio = $_POST['precio'];
    $solicitud = $_POST['solicitud'];
    $solucion = $_POST['solucion'];
    $query = $conexion->prepare("UPDATE presupuestos SET num_presupuesto= '$num_presupuesto', titulo= '$titulo', fecha_generacion= '$fecha_generacion', empresa= '$empresa', precio= '$precio', solicitud='$solicitud', solucion= '$solucion' WHERE id = $id");
    $query->execute();
    header('Location: lista.php');
}
?>