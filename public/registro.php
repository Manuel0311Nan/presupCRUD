<?php

// require_once(dirname(__FILE__) . '/../config/config.php');
// require_once(dirname(__FILE__) . '/../src/functions.php');
// require_once(dirname(__FILE__) . '/../src/fpdf/fpdf.php');
// require_once(dirname(__FILE__) . '/../src/mailer/PHPMailer.php');
// require_once(dirname(__FILE__) . '/../src/mailer/SMTP.php');
// require_once(dirname(__FILE__) . '/../src/mailer/Exception.php');

require_once(dirname(__FILE__) . '/../config/config.php');
// require_once('../src/create_pdf.php');
$conexion = connectServer(SERVER, USER, PASS, DATABASE);

if(isset($_POST['crearPresupuesto'])){
    $num_presupuesto = trim($_POST['num_presupuesto']);
    $titulo = ucfirst(trim($_POST['titulo']));
    $fecha_generacion = $_POST['fecha_generacion'];
    $empresa = ucfirst(trim($_POST['empresa']));
    $precio = $_POST['precio'];
    $solucion = $_POST['solucion'];
    $solicitud = $_POST['solicitud'];
    $sentencia = $conexion->prepare("INSERT INTO presupuestos (num_presupuesto, titulo, fecha_generacion, empresa, precio, solucion, solicitud)VALUES(:num_presupuesto, :titulo, :fecha_generacion, :empresa, :precio, :solucion, :solicitud)");
    $sentencia->bindParam(':num_presupuesto', $num_presupuesto);
    $sentencia->bindParam(':titulo', $titulo);
    $sentencia->bindParam(':fecha_generacion', $fecha_generacion);
    $sentencia->bindParam(':empresa', $empresa);
    $sentencia->bindParam(':precio', $precio);
    $sentencia->bindParam(':solicitud', $solicitud);
    $sentencia->bindParam(':solucion', $solucion);
    $sentencia->execute();
header('Location: lista.php');
};

?>