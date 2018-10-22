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
                                FROM vw_obtUsuario
                                WHERE idRow =".$_IdRow);
while($fila = mysqli_fetch_array($resultUpd)) {
//echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";

    $Nombre = $fila['nombre'];
    $app = $fila['app'];
    $apm = $fila['apm'];
    $usuario = $fila['usuario'];
    $password = $fila['password'];
    $correo = $fila['correo'];
    $nombre_rol = $fila['nombre_rol'];
    $puesto_principal = $fila['puesto_principal_id'];

}

?>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                     <form role="form" id="formData">
  <div class="form-group">
    <label for="inputName" class="control-label">Nombre</label>
    <input type="text" class="form-control" id="inputName" placeholder="Cina" name="nombre" maxlength="30" required value="<?php echo $Nombre ?>">
  </div>
  <div class="form-group">
    <label for="inputName" class="control-label">Apellido 1</label>
    <input type="text" class="form-control" id="inputName" placeholder="Saffary" name="app" maxlength="30" required value="<?php echo $app ?>">
  </div>

  <div class="form-group">
    <label for="inputName" class="control-label">Apellido 2</label>
    <input type="text" class="form-control" id="inputName" placeholder="Lara" name="apm" maxlength="30" value="<?php echo $apm ?>">
  </div>

  <div class="form-group">
    <label for="inputEmail" class="control-label">Email/Usuario</label>
    <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="correo" data-error="Bruh, that email address is invalid" required value="<?php echo $correo ?>">
    <span class="help-block">NOTA: el usuario queda de 10 caracteres y se toma del correo</span>
    <div class="help-block with-errors"></div>
      <input type="hidden" id="hdnUsuario" name="usuario" />
  </div>
  <div class="form-group">
    <label for="inputPassword" class="control-label">Password</label>
      <input type="password" data-minlength="5" class="form-control" id="inputPassword" placeholder="Password"
             name="password" maxlength="8" required value="<?php echo $password ?>">
      <span class="help-block">Minimo de 5 caracteres</span>

  </div>
  <div class="form-group">
  <?php
if($_SESSION['rol_principal'] == 1){
  echo '<label for="dllPuesto" class="control-label">Puesto Principal</label>';
  echo '<select id="dllPuesto" class="form-control" name="puesto_principal_id">';
  echo "<option value='".$puesto_principal."'>".$nombre_rol."</option>";
  echo "<option value=''>Seleccione</option>";
  $resultN = mysqli_query($Con,"SELECT idRow, nombre FROM tbl_roles");
  while($fila = mysqli_fetch_array($resultN)) {
  echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";
  }
  echo '</select>';
}
  ?>

      <!--<input type="text" id="hdnpuesto" name="puesto_principal_id" value="2"/>
      <input type="text" class="form-control" value="" readonly>-->
  </div>
  </div>
  <div class="form-group">
      <button id="btnAgregar" class="btn btn-primary" >Aceptar</button>

  </div>
</form>
<div class="form-group">
    <?php

    // el usuario comun
    if($_SESSION['rol_principal'] == 1){
     echo '<button id="btnEliminar" class="btn btn-primary" >Eliminar</button>';
    }
    ?>
</div>
<div id="loading" aling="center">
  <div id="overlayShadow"></div>
  <div id="overlayMessage"><img id="loading-image" src="img/ajaxloader.gif">
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

   var idAdmin = '<?php echo $_SESSION['rol_principal'];?>';

    console.log("id es: "+idRow);

         //$("#btnAgregar").click(function(){
        $("#formData").submit(function(event){
          $("#loading").show();
          $("#btnAgregar").hide();
          $("#btnEliminar").hide();
                var cadena = $.trim( $("#inputEmail").val() );
                arregloDeSubCadenas = cadena.split("@", 1);
                $("#hdnUsuario").val( arregloDeSubCadenas );

                console.log("creo usuarios "+$("#hdnUsuario").val());

                //==> Guardamos por AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'controller/udpInfo.php?id='+idRow,
                        data: $('#formData').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
                        success: function(data){
                        //alert("devuelve "+data);

                            if(data == "true"){
                            console.log("Registro exitoso");

                                setTimeout(function() {
                                  if (idAdmin == 1) {
                                    location.href = 'lisUsuario.php';
                                  }
                                  else {
                                    location.href = 'panel.php';
                                  }

                                }, 2000);

                            }else
                            {
                            console.log("Ops algo no esta bien");

                            }


                        }
                    });//==> fin ajax



                event.preventDefault();
            });//==> Fin del actualizar

  //==============> borrar

$("#btnEliminar").click(function(){
  $("#loading").show();
  $("#btnAgregar").hide();
  $("#btnEliminar").hide();
        //$("#formData").submit(function(event){
			if( confirm("¿Esta seguro de eliminar el registro?") )
				{
                var cadena = $.trim( $("#inputEmail").val() );
                arregloDeSubCadenas = cadena.split("@", 1);
                $("#hdnUsuario").val( arregloDeSubCadenas );

                console.log("creo usuarios "+$("#hdnUsuario").val());

                //==> Guardamos por AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'controller/delInfo.php?id='+idRow,
                        data: $('#formData').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
                        success: function(data){
                        //alert("devuelve "+data);

                            if(data == "true"){
                            console.log("Registro exitoso");

                                setTimeout(function() {
                                    location.href = 'lisUsuario.php';
                                }, 2000);

                            }else
                            {
                            console.log("Ops algo no esta bien");

                            }


                        }
                    });//==> fin ajax

                }//===> fin confirm

               // event.preventDefault();
            });//==> Fin del actualizar





 });

</script>

</html>
