<?php
session_start();
// !isset($_SESSION["auth"]) || $_SESSION["auth"] == false ? header('Location: ./parts/login.php') : '';
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/../src/functions.php");
require_once(dirname(__FILE__) . "/head.php");
require_once(dirname(__FILE__) . "/registro.php");
// require_once(dirname(__FILE__) . "/parts/loading.php");


$conexion = connectServer(SERVER, USER, PASS, DATABASE);
// $query = "SELECT * FROM presupuestos";
// $array = array();
// $valor = doQuery($conexion, $query, $array);
// $total = $valor->rowCount() + 1;
