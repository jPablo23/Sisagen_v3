<?php
session_start();
include ("../model/modeloDB.php");
include_once '../model/conexion.php'; 

//echo "serialice = " + $_serialice = $_POST['serialice'];
//print_r($_POST);

$_ID = $_GET['id'];

//$_serialice = $_POST['correo'];

if($_POST["Cambio"] == "true"){
//====> Subir a servidor


  $target_path = "../img/img_upload";
  $nombre_archivo = $_POST["documento_filesystem"];
  //$target_path = $target_path . basename( $_FILES['documento_filesyst']['name']);
    if(move_uploaded_file($_FILES['documento_filesyst']['tmp_name'], $target_path .'/'.$nombre_archivo))
    {
    //echo  "<span style='color:green;'>El archivo ". basename( $_FILES['documento_filesyst']['name']). " ha sido subido</span><br>";
    
        $sraddMaterial = new srAgenda(); 
        $sraddMaterial -> materiaUpd($Con,$_POST,$_ID);
    
    }else{
     echo "false";
    } //= */
}
else
{
        $sraddMaterial = new srAgenda(); 
        $sraddMaterial -> materiaUpd($Con,$_POST,$_ID);
}


//$sraddArea = new srAgenda(); 
//$sraddArea -> areaAdd($Con,$_POST); 
//$srLogin -> login($user , $pass); 
 

?>