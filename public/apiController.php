<?php
session_start();
require_once(dirname(__FILE__) . "/../config/config.php");

// Controlador, ordenado alfabéticamente, que redirige a la función deseada según el 'action' solicitado a traves de AJAX
if (isset($_POST) && isset($_POST['action'])) 
{
    switch ($_POST['action']) 
    {
        case 'create_pdf': encrypted($_POST);break;
        case 'login': encrypted($_POST);break;
        default: echo json_encode(array("status" => "error", "result" => "Actualmente no se puede realizar la acción deseada"));
    }
}

// Función que llaman a diferentes recursos (TODAS LAS RESPUESTAS QUE VAYAN AL FROTNED DEBERÁN IR EN JSON)
function encrypted($data)
{
    $action = $data['action'];
    unset($data['action']);
    $data = array_map('strip_tags', $data);

    $response = "";

    require_once(dirname(__FILE__) . "/../src/" . trim(strip_tags($action)) . ".php");
    
    // echo json_encode(array("status" => "error", "result" => dirname(__FILE__) . "/../src/" . trim(strip_tags($action)) . ".php"));
    echo json_encode($response);
}