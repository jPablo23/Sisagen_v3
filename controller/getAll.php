<?php
include_once '../model/conexion.php';

$resultUpd = mysqli_query($Con,"SELECT * FROM events");

while($fila = mysqli_fetch_array($resultUpd)) {
//echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";

$resultfila["id"]=$fila["id"];
$resultfila["title"]=$fila["title"];
$resultfila["url"]=$fila["url"];
$resultfila["class"]=$fila["class"];
$resultfila["start"]=$fila["start"];
$resultfila["end"]=$fila["end"];


}

echo json_encode(
        array(
          "success" => 1,
          "result" => [$resultfila]
        )
      );

?>
