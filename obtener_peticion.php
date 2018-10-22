<?php
include_once 'model/conexion.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <?php include 'inc/header.php'; ?>
    <title>Sistema de Prestamos Online</title>
</head>

<body>
<?php include 'inc/navigation.php'; ?>

    <br>
    <br>
    <br>
    <br>
        <br>
    <br>

<?php

$_IdRow = $_GET["idElemen"];

$resultUpd = mysqli_query($Con,"SELECT
                                *
                                FROM vw_peticiones
                                WHERE peticion_id =".$_IdRow);
while($fila = mysqli_fetch_array($resultUpd)) {
//echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";

    $descripcion      = $fila['descripcion'];
    $peticion_status      = $fila['peticion_status'];
    $nombre_estarus      = $fila['nombre_estarus'];
    $eventos_id     = $fila['eventos_id'];
    $evento_titulo      = $fila['evento_titulo'];
    $usuario      = $fila['usuario'];

}

?>
        <div class="container">
            <div class="row">
<div class="col-lg-12">
                     <form role="form" id="formData">
  <div class="form-group">
    <label for="inputName" class="control-label">descripcion</label>
    <input type="text" class="form-control"
    id="inputName" placeholder="maximo 100 caracteres"
    value="<?php echo $descripcion ?>" readonly>
  </div>
  <div class="form-group">
    <label for="inputName" class="control-label">Estado esta</label>
    <input type="text" class="form-control"
    id="inputName"
    value="<?php echo $nombre_estarus ?>" readonly>
  </div>
  <div class="form-group">
    <label for="inputName" class="control-label">Evento en el que lo pidieron</label>
    <input type="text" class="form-control"
    id="inputName" value="<?php echo $evento_titulo ?>" readonly>
  </div>
  <div class="form-group">
    <label for="inputName" class="control-label">Usuario que realizo la peticion</label>
    <input type="text" class="form-control"
    id="inputName" value="<?php echo $nombre_estarus ?>" readonly>
  </div>

  <div class="form-group">
    <label for="dllPuesto" class="control-label">Cambiar status</label>
      <!--<input type="text" id="hdnpuesto" name="puesto_principal_id" value="2"/>-->
      <select id="dllRol" class="form-control" name="peticion_status" required="true">
        <?php
        echo "<option value='".$peticion_status."'>".$nombre_estarus."</option>";
        echo "<option value=''>Seleccione</option>";
        $resultN = mysqli_query($Con,"SELECT idRow, nombre FROM tbl_peticiones_status WHERE eliminado = '0'");
        while($fila = mysqli_fetch_array($resultN)) {
        echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";
        }

        ?>
      </select>

  </div>

</div>
<div class="form-group">
   <button type="submit" id="btnAgregar"  class="btn btn-primary" >Agregar</button>

</div>
</form>

<div id="loading" aling="center">
  <div id="overlayShadow"></div>
  <div id="overlayMessage"><img id="loading-image" style="margin: 7px 7px;" src="img/ajaxloader.gif">
  </div>
</div>
            </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>

</body>

<script type="text/javascript">

$(document).ready(function() {
$("#loading").hide();
    var idRow = '<?php echo $_GET["idElemen"];?>';

//=====> sutmit
$("#formData").submit(function(event){
$("#loading").show();
$("#btnAgregar").hide();
$("#btnEliminar").hide();
        //==> Guardamos por AJAX
            $.ajax({
                type: 'POST',
                url: 'controller/updPeticion.php?id='+idRow,
                data: $('#formData').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
                success: function(data){
                //alert("devuelve "+data);

                    if(data == "true"){
                    console.log("Registro exitoso");
                    smoke.signal("Registro exitoso!", function(e){

                    }, {
                    duration: 3000,
                    classname: "custom-class"
                    });

                        setTimeout(function() {
                            location.href = 'lisPeticion.php';
                        }, 2000);

                    }else
                    {
                    console.log("Ops algo no esta bien");

                    }


                }
            });//==> fin ajax



        event.preventDefault();
    });//==> Fin del actualizar

 });

</script>

</html>
