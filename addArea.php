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
        <div class="container">
            <div class="row">
<div class="col-lg-12">
                     <form role="form" id="formData" action ="controller/addInfoArea.php" method="post">
  <div class="form-group">
    <label for="inputName" class="control-label">Nombre</label>
    <input type="text" class="form-control" id="inputName" placeholder="Centro B1" name="nombre" maxlength="20" required>
  </div>
  <div class="form-group">
    <label for="dllPuesto" class="control-label">Puesto Principal</label>
      <!--<input type="text" id="hdnpuesto" name="puesto_principal_id" value="2"/>-->
      <select id="dllRol" class="form-control" name="roles_id" required="true">
        <?php

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
    <button id="btnAgregar" type="submit" class="btn btn-primary" >Agregar</button>

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

//$("#dllRol").empty().append("<option value=''>Seleccione</option>");
   var opc = '<?php echo $_GET["opc"];?>';

 // console.log(opc);
    switch (opc){
		case 'nuevo':

            //==> oculta eliminar
            $("#btnEliminar").hide();
            //$("#").click(function(){
            $("#formData").submit(function(event){
$("#loading").show();
$("#btnAgregar").hide();
                //==> Guardamos por AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'controller/addInfoArea.php',
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
                    });



                event.preventDefault();
            });

            break;
        case 'editar':

			break;

	}//cierro switch*/


 });

</script>

</html>
