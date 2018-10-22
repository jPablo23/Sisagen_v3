<?php
session_start();
include ("../model/modeloDB.php");
include_once '../model/conexion.php'; 

//echo "serialice = " + $_serialice = $_POST['serialice'];
//print_r($_POST);

//$_serialice = $_POST['correo'];

$sraddArea = new srAgenda(); 
$sraddArea -> areaAdd($Con,$_POST); 
//$srLogin -> login($user , $pass); 
 

?>