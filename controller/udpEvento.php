<?php
session_start();
include ("../model/modeloDB.php");
include_once '../model/conexion.php';

//echo "serialice = " + $_serialice = $_POST['serialice'];
//print_r($_POST);

//$_serialice = $_POST['correo'];

$_ID = $_GET['id'];

//echo $_ID;

$sraupdEvento = new srAgenda();
$sraupdEvento -> eventoUpd($Con,$_POST,$_ID);
//$srLogin -> login($user , $pass);  */


?>
