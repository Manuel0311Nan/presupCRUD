<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/../src/functions.php');
require_once(dirname(__FILE__) . '/../src/fpdf/fpdf.php');
// require_once(dirname(__FILE__) . '/../src/mailer/PHPMailer.php');
require_once(dirname(__FILE__) . '/../src/mailer/SMTP.php');
require_once(dirname(__FILE__) . '/../src/mailer/Exception.php');

$conexion = connectServer(SERVER, USER, PASS, DATABASE);

$query = "SELECT * FROM presupuestos ";
$valor = $conexion -> prepare($query);
$valor -> execute();
if(isset($_GET['pdf'])){
    $id = $_GET ['id'];
    $titulo =trim($_POST['titulo']);
    $fecha_generacion = $_POST['fecha_generacion'];
    $empresa = trim($_POST['empresa']);
    $precio = $_POST['precio'];
    $solucion = $_POST['solucion'];
    $solicitud = $_POST['solicitud'];

//Creamos el archivo PDF en horizontal (L), en milímetros (mm) y con medida DIN A4
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->GetPageWidth();   //Ancho PDF
$pdf->GetPageHeight();  //Alto  
$pdf->SetFont('Helvetica');


//Añadimos la primera hoja, la portada
$pdf->AddPage();
$pdf->Image('./assets/img/01_portada.jpg', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
$pdf->SetFontSize(30);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetXY(null, '150');
$pdf->MultiCell($pdf->GetPageWidth(), 10, utf8_decode($titulo), 0 , 'C');

$pdf->SetXY(null, '165');
$pdf->SetFontSize(18);
$pdf->MultiCell($pdf->GetPageWidth(), 10, utf8_decode($empresa) . utf8_decode(" · ")  . utf8_decode($num_presupuesto) .  utf8_decode(" · ") . $fecha->format("d/m/Y"), 0 , 'C');


//Añadimos la segunda hoja, solicitud
$pdf->AddPage();
$pdf->Image('./assets/img/02_solicitud.jpg', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
$pdf->SetXY(15, '50');
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell($pdf->GetPageWidth()-25, 10, str_replace('\n', "\n", $solicitud), 0 , 'L');


//Añadimos la tercera hoja, presupuesto
$pdf->AddPage();
$pdf->Image('./assets/img/03_presupuesto.jpg', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
$pdf->SetXY(15, '50');
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell($pdf->GetPageWidth()-25, 10, str_replace('\n', "\n", $solucion), 0 , 'L');


//Añadimos la cuarta hoja, final
$pdf->AddPage();
$pdf->Image('./assets/img/04_final.jpg', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());

$ruta = "./../public/assets/pdf/" . str_replace("#", "", $num_presupuesto) . ".pdf";
$pdf->Output($ruta,'I');

//Primero comprobamos que el número de usuarios registrados no supere los que se han contratado (NUM_USERS)
$query = "INSERT INTO presupuestos(num_presupuesto, titulo) VALUES(?,?)";
$array = array($num_presupuesto, $titulo);
$valor = doQuery($conexion, $query, $array);
$response = array("status" => "exito", "result" => "http://localhost/presupcrud/public/assets/pdf" . str_replace("#", "", $num_presupuesto) . ".pdf");
disconnectServer($conexion);
}