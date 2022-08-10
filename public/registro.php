<?php

require_once(dirname(__FILE__) . '/../config/config.php');
$conexion = connectServer(SERVER, USER, PASS, DATABASE);

if(isset($_POST['crearPresupuesto'])){
    if(strlen($_POST['titulo']) >=1 && strlen($_POST['empresa']) >=1 && strlen($_POST['precio'])){
        $num_presupuesto = trim($_POST['num_presupuesto']);
        $titulo = ucfirst(trim($_POST['titulo']));
        $fecha_generacion = $_POST['fecha_generacion'];
        $empresa = ucfirst(trim($_POST['empresa']));
        $precio = $_POST['precio'];
        $solucion = $_POST['solucion'];
        $solicitud = $_POST['solicitud'];
        $sentencia = $conexion->prepare("INSERT INTO presupuestos (num_presupuesto, titulo, fecha_generacion, empresa, precio)VALUES(:num_presupuesto, :titulo, :fecha_generacion, :empresa, :precio");
        $sentencia->bindParam(':num_presupuesto', $num_presupuesto);
        $sentencia->bindParam(':titulo', $titulo);
        $sentencia->bindParam(':fecha_generacion', $fecha_generacion);
        $sentencia->bindParam(':empresa', $empresa);
        $sentencia->bindParam(':precio', $precio);
        $sentencia->execute();
    }
}