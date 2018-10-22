<?php
session_start();
include ("../model/modeloDB.php");
include_once '../model/conexion.php';
/*
$opc = $_GET["opc"];
$idLinea = $_GET["Materiales"];
$idMarca = $_GET["idMarca"];
*/
$resultUpd = mysqli_query($Con,"SELECT idRow  AS id,
                                       nombre AS nombre
                                FROM tbl_materiales
                                WHERE eliminado = '0'");

while($fila = mysqli_fetch_array($resultUpd)) {
//echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";

$resultfila["id"]=$fila["id"];
$resultfila["nombre"]=$fila["nombre"];
/*$resultfila["url"]=$fila["url"];
$resultfila["class"]=$fila["class"];
$resultfila["start"]=$fila["start"];
$resultfila["end"]=$fila["end"];
*/

}

/*echo json_encode(
        array(
          "success" => 1,
          "result" => [$resultfila]
        )
      );*/

//echo json_encode($resultfila);
header('Content-Type: application/json');
echo json_encode($resultfila);
?>
