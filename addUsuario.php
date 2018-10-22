<?php
include_once 'model/conexion.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <?php include 'inc/header.php'; ?>
  <!--  <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>-->
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
                     <form role="form" id="formData">
  <div class="form-group">
    <label for="inputName" class="control-label">Nombre</label>
    <input type="text" class="form-control" id="inputName" placeholder="Cina" name="nombre" maxlength="30" required>
  </div>
  <div class="form-group">
    <label for="inputName" class="control-label">Apellido 1</label>
    <input type="text" class="form-control" id="inputName" placeholder="Saffary" name="app" maxlength="30" required>
  </div>

  <div class="form-group">
    <label for="inputName" class="control-label">Apellido 2</label>
    <input type="text" class="form-control" id="inputName" placeholder="Lara" name="apm" maxlength="30">
  </div>

  <div class="form-group">
    <label for="inputEmail" class="control-label">Email/Usuario</label>
    <input type="email" class="form-control" id="inputEmail" placeholder=" Ejemplo: ejemplo@email.com" name="correo" data-error="direccion email incorrecta" required>
<span class="help-block">NOTA: el usuario queda de 10 caracteres y se toma del correo</span>
    <div class="help-block with-errors"></div>
      <input type="hidden" id="hdnUsuario" name="usuario" />
  </div>
  <div class="form-group">
    <label for="inputPassword" class="control-label">Password</label>
      <input type="password" data-minlength="5" class="form-control" id="inputPassword" placeholder="Password"
             name="password" maxlength="8" required>
      <span class="help-block">Minimo de 5 caracteres</span>

  </div>
  <div class="form-group">
    <label for="dllPuesto" class="control-label">Puesto Principal</label>
      <!--<input type="text" id="hdnpuesto" name="puesto_principal_id" value="2"/>-->
      <select id="dllPuesto" class="form-control" name="puesto_principal_id" required="true">
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
                var cadena = $.trim( $("#inputEmail").val() );
                arregloDeSubCadenas = cadena.split("@", 1);
                $("#hdnUsuario").val( arregloDeSubCadenas );

                console.log("creo usuarios "+$("#hdnUsuario").val());

                //==> Guardamos por AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'controller/addInfo.php',
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
                                    location.href = 'lisUsuario.php';
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
