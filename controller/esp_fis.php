<?php
session_start();
include ("../model/modeloDB.php");
include_once '../model/conexion.php';

//echo "serialice = " + $_serialice = $_POST['serialice'];
//print_r($_POST);

?>
<select id="dllEspacioFisico" class="form-control" name="espacios_fisicos_id" required="true" onchange="obtener_numePersonas(this.value)">
  <?php

  echo "<option value=''>Seleccione...</option>";
  $resultN = mysqli_query($Con,"SELECT idRow,
                                       nombre
                                  FROM tbl_espacios_fisicos
                                  WHERE eliminado = '0'
                                    AND areas_id =".$_POST['idArea']);
  while($fila = mysqli_fetch_array($resultN)) {
  echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";
  }

  ?>
</select>
