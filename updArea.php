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
                                FROM vw_obtareas
                                WHERE idRow =".$_IdRow);
while($fila = mysqli_fetch_array($resultUpd)) {
//echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";

    $Nombre      = $fila['area_nombre'];
    $roles_id      = $fila['roles_id'];
    $rol_nombre      = $fila['rol_nombre'];

}

?>



        <div class="container">
            <div class="row">
<div class="col-lg-12">
                     <form role="form" id="formData">
  <div class="form-group">
    <label for="inputName" class="control-label">Nombre</label>
    <input type="text" class="form-control" id="inputName" placeholder="Centro B1" name="nombre" maxlength="20" required value="<?php echo $Nombre ?>">
  </div>

  <div class="form-group">
    <label for="dllPuesto" class="control-label">Puesto Principal</label>
      <!--<input type="text" id="hdnpuesto" name="puesto_principal_id" value="2"/>
      <input type="text" class="form-control" value="" readonly>-->
      <select id="dllPuesto" class="form-control" name="roles_id" required="true">
        <?php

        echo "<option value='".$roles_id."'>".$rol_nombre."</option>";
        echo "<option value=''>Seleccione</option>";
        $resultN = mysqli_query($Con,"SELECT idRow, nombre FROM tbl_roles");
        while($fila = mysqli_fetch_array($resultN)) {
        echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";
        }

        ?>
      </select>

  </div>


</div>
<div class="form-group">
   <button id="btnAgregar"  class="btn btn-primary" >Agregar</button>
</div>
</form>
 <div class="form-group">
    <button id="btnEliminar" class="btn btn-primary" >Eliminar</button>
</div>
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

            $("#btnEliminar").click(function(){
            			if( confirm("¿Esta seguro de eliminar el registro?") )
        				{
                  $("#loading").show();
                  $("#btnAgregar").hide();
                  $("#btnEliminar").hide();

                        //==> Guardamos por AJAX
                            $.ajax({
                                type: 'POST',
                                url: 'controller/delArea.php?id='+idRow,
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
                                            location.href = 'lisArea.php';
                                        }, 2000);

                                    }else
                                    {
                                    //console.log("Ops algo no esta bien");
                                    alert("Ops algo no esta bien, se redirecciona a la lista");
                                    setTimeout(function() {
                                        location.href = 'lisArea.php';
                                    }, 2000);
                                    }


                                }
                            });//==> fin ajax

                        }//===> fin confirm

            });//==> Fin quita


//=====> sutmit
$("#formData").submit(function(event){
$("#loading").show();
$("#btnAgregar").hide();
$("#btnEliminar").hide();
        //==> Guardamos por AJAX
            $.ajax({
                type: 'POST',
                url: 'controller/udpArea.php?id='+idRow,
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
                            location.href = 'lisArea.php';
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
