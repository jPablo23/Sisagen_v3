<?php
include_once '../model/conexion.php';
$term = trim(strip_tags($_GET['term']));


$resultUpd = mysqli_query($Con,"SELECT *
                                   FROM tbl_materiales
                                  WHERE eliminado = '0'");

/*while($fila = mysqli_fetch_array($resultUpd)) {
//echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";

$resultfila["id"]=$fila["id"];
$resultfila["title"]=$fila["title"];
$resultfila["url"]=$fila["url"];
$resultfila["class"]=$fila["class"];
$resultfila["start"]=$fila["start"];
$resultfila["end"]=$fila["end"];


}*/




$toJSON = array();
foreach($resultUpd as $num => $val){
    $toJSON[$num]['value'] = $val['idRow'];
    $toJSON[$num]['label'] = $val['nombre'];
}
echo json_encode($toJSON);


//echo json_encode($results);
//echo $results;


?>
