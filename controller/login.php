<?php
session_start();
include ("../model/modeloDB.php");
include_once '../model/conexion.php'; 

$user = $_POST['usuario'];
$pass = $_POST['password'];  


$srLogin = new srAgenda(); 
$srLogin -> login($Con,$user , $pass); 
//$srLogin -> login($user , $pass); 
 

?>