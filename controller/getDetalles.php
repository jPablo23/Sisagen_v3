<?php
session_start();
include ("../model/modeloDB.php");
include_once '../model/conexion.php';

//echo "serialice = " + $_serialice = $_POST['serialice'];
//print_r($_POST);

switch ($_POST["opc"]) {
  case 'numPersonas':
        $resultN = mysqli_query($Con,"SELECT *
                                        FROM tbl_espacios_fisicos
                                        WHERE idRow =".$_POST['idRow']);

        while($fila = mysqli_fetch_array($resultN)) {
          //$resultfila["capacidad"]=$fila["capacidad"];
            echo $fila['capacidad'];
        }
         //print_r($resultfila);
         //echo $resultfila["capacidad"];
    break;
    case 'numMateriales':
          $resultN = mysqli_query($Con,"SELECT *
                                          FROM tbl_materiales
                                          WHERE idRow =".$_POST['idRow']);

          while($fila = mysqli_fetch_array($resultN)) {
            //$resultfila["capacidad"]=$fila["capacidad"];
              echo $fila['existencias'];
          }
           //print_r($resultfila);
           //echo $resultfila["capacidad"];
      break;

  default:
    # code...
    break;
}

?>
