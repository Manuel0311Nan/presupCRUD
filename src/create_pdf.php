<?php
require_once(dirname(__FILE__) . '/../config/config.php');
require_once(dirname(__FILE__) . '/functions.php');
require_once(dirname(__FILE__) . '/fpdf/fpdf.php');
require_once(dirname(__FILE__) . '/mailer/PHPMailer.php');
require_once(dirname(__FILE__) . '/mailer/SMTP.php');
require_once(dirname(__FILE__) . '/mailer/Exception.php');
$conexion = connectServer(SERVER, USER, PASS, DATABASE);

define('EURO',chr(128));

//Datos recibidos desde el Frontend
$empresa = trim(strip_tags($_POST['empresa']));
$fecha = new DateTime($_POST['fecha']);
$num_presupuesto = trim(strip_tags($_POST['num_presupuesto']));
$titulo = trim(strip_tags($_POST['titulo']));
$precio = trim(strip_tags($_POST['precio']));
$solicitud = trim(strip_tags($_POST['solicitud']));
$solicitud = str_replace('€', EURO, $solicitud);
$solucion = trim(strip_tags($_POST['solucion']));
$solucion = str_replace('€', EURO, $solucion);


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
$pdf->MultiCell($pdf->GetPageWidth()-25, 10, utf8_decode(str_replace('\n', "\n", $solicitud)), 0 , 'L');


//Añadimos la tercera hoja, presupuesto
$pdf->AddPage();
$pdf->Image('./assets/img/03_presupuesto.jpg', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
$pdf->SetXY(15, '50');
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell($pdf->GetPageWidth()-25, 10, utf8_decode(str_replace('\n', "\n", $solucion)), 0 , 'L');
$pdf->SetXY(null, '179');
$pdf->MultiCell($pdf->GetPageWidth(), 10, number_format($precio, 2, ',', '.') . ' ' . EURO, 0 , 'C');


//Añadimos la tercera y media hoja, observaciones
$pdf->AddPage();
$pdf->Image('./assets/img/035_Observaciones.jpg', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());


//Añadimos la cuarta hoja, final
$pdf->AddPage();
$pdf->Image('./assets/img/04_final.jpg', 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());

$ruta = "./../public/assets/pdf/" . str_replace("#", "", $num_presupuesto) . ".pdf";
$pdf->Output($ruta,'F');

//Primero comprobamos que el número de usuarios registrados no supere los que se han contratado (NUM_USERS)
$query = "INSERT INTO presupuestos(num_presupuesto, titulo, empresa, precio) VALUES(?,?,?,?)";
$array = array($num_presupuesto, $titulo, $empresa, number_format($precio, 2, ',', '.') . ' €');
$valor = doQuery($conexion, $query, $array);
$response = array("status" => "exito", "result" => "http://localhost/presupcrud/public/assets/pdf" . str_replace("#", "", $num_presupuesto) . ".pdf");
disconnectServer($conexion);
