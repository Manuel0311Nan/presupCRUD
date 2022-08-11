<?php
session_start();
// !isset($_SESSION["auth"]) || $_SESSION["auth"] == false ? header('Location: ./parts/login.php') : '';
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/../src/functions.php");
require_once(dirname(__FILE__) . "/head.php");
require_once(dirname(__FILE__) . "/registro.php");
require_once(dirname(__FILE__) . "/parts/loading.php");

$conexion = connectServer(SERVER, USER, PASS, DATABASE);


if (isset($_POST['delete'])){
    $id = $_GET['id'];
    $query = "DELETE FROM presupuestos WHERE id = $id ";
    $sentencia ->$conexion->prepare($query);
    $sentencia -> execute();

    if(!$result){
        die(".Query Failed");
    }
// $_SESSION['message'] = 'Task Removed Successfully';
// $_SESSION['message_type'] = 'danger';
    header("Location: lista.php");
}