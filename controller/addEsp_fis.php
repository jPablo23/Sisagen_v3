<?php
session_start();
include ("../model/modeloDB.php");
include_once '../model/conexion.php';

//echo "serialice = " + $_serialice = $_POST['serialice'];
//print_r($_POST);

//$_serialice = $_POST['correo'];

$sraddesp_fis = new srAgenda();
$sraddesp_fis -> esp_fisAdd($Con,$_POST);
//$srLogin -> login($user , $pass);


?>
