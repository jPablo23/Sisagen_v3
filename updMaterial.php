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
                                FROM tbl_materiales
                                WHERE idRow =".$_IdRow);
while($fila = mysqli_fetch_array($resultUpd)) {
//echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";

    $Nombre      = $fila['nombre'];
    $descripcion = $fila['descripcion'];
    $existencias   = $fila['existencias'];
    $imagen   = $fila['imagen'];


}

?>



        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                     <form role="form" enctype="multipart/form-data" id="formuploadajax" method="post">
  <div class="form-group">
    <label for="inputName" class="control-label">Nombre</label>
    <input type="text" class="form-control" id="inputName" placeholder="Centro B1" name="nombre" maxlength="30" required value="<?php echo $Nombre ?>">
  </div>
  <div class="form-group">
    <label for="inputName" class="control-label">descripcion</label>
    <input type="text" class="form-control" id="inputName" placeholder="maximo 100 caracteres" name="descripcion" maxlength="100" required value="<?php echo $descripcion ?>">
  </div>

  <div class="form-group">
    <label for="inputName" class="control-label">existencias</label>
    <input type="number" class="form-control" id="inputName" placeholder="Existencia de material (Numericos)" name="existencias" min="1" required value="<?php echo $existencias ?>">

  </div>

  <div class="form-group">
    <label for="inputName" class="control-label">Imagen</label>
<img class='img-thumbnail' src='<?php echo $imagen ?>' alt='Imagen Material' height='95' width='100'>
      <a id="btnCambioImagen">Cambiar</a>
<input type="hidden" id="hdnCambio" name="Cambio" value="false">
  </div>

<div class="form-group CambioImagen">

      <input type="file" class="form-control" id="txtdocumento_filesyst" placeholder="img" name="documento_filesyst" onchange="validarIMG()" required>
    <input type="hidden" id="txtImagen" name="imagen"/>
      <input type="hidden" id="txtdocumento_filesystem" name="documento_filesystem"/>
    <a id="btnNoCambio">No cambiar</a>
  </div>

  </div>
  <div class="form-group">
      <button id="btnAgregar" class="btn btn-primary" >Aceptar</button>

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

    function validarIMG()
{

  var ext = $('#txtdocumento_filesyst').val().split('.').pop().toLowerCase();
  if($.inArray(ext, ['png','jpg']) == -1) {
    alert('Acepta solo .png y .jpg, Imagenes');

    $('#txtdocumento_filesyst').val('');
    $("#txtImagen").val('');
    $("#txtdocumento_filesystem").val('');
  }
    else
    {
        $("#txtImagen").val('img/img_upload/'+$("#txtdocumento_filesyst").val());
        $("#txtdocumento_filesystem").val($("#txtdocumento_filesyst").val());
    }

}




$(document).ready(function() {
$("#loading").hide();

    //================= valida tamaño
    $("#txtdocumento_filesyst").bind('change', function(){
        //Tamañoen bytes (1,5 Mb)
        if (this.files[0].size >= 2072864) {
            var tamanio = this.files[0].size/1048576;
            tamanio = tamanio.toFixed(2);
            alert('ATENCIÓN:\n\nSu archivo pesa '+(tamanio)+' Mb y supera el límite permito de 2 Mb.');


            $(this).val('');
            $("#txtImagen").val('');
        }else
        {
            validarIMG();
        }
    });
    //===============>

    $(".CambioImagen").hide();
    $("#txtdocumento_filesyst").prop('disabled', true);
    $("#txtImagen").prop('disabled', true);
    $("#txtdocumento_filesystem").prop('disabled', true);
    //$("#CambioImagen").hide();


    var idRow = '<?php echo $_GET["idElemen"];?>';

    $("#btnCambioImagen").click(function(){

        $("#hdnCambio").val("true");

    $(".CambioImagen").show();
    $("#txtdocumento_filesyst").prop('disabled', false);
    $("#txtImagen").prop('disabled', false);
    $("#txtdocumento_filesystem").prop('disabled', false);

    });//==> Fin agrega

    $("#btnNoCambio").click(function(){

        $("#hdnCambio").val("false");
    $(".CambioImagen").hide();
    $("#txtdocumento_filesyst").prop('disabled', true);
    $("#txtImagen").prop('disabled', true);
    $("#txtdocumento_filesystem").prop('disabled', true);

    });//==> Fin quita



/*    $("#btnAgregar").click(function(){

 $("#formuploadajax").trigger('submit');

    });//==> Fin agrega*/

    $("#btnEliminar").click(function(){
    			if( confirm("¿Esta seguro de eliminar el registro?") )
				{
          $("#loading").show();
          $("#btnAgregar").hide();
          $("#btnEliminar").hide();
                //==> Guardamos por AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'controller/delMateria.php?id='+idRow,
                        data: $('#formData').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
                        success: function(data){
                        //alert("devuelve "+data);

                            if(data == "true"){
                            console.log("Registro exitoso");

                                setTimeout(function() {
                                    location.href = 'lisMaterial.php';
                                }, 2000);

                            }else
                            {
                            console.log("Ops algo no esta bien");

                            }


                        }
                    });//==> fin ajax

                }//===> fin confirm

    });//==> Fin quita






           //==> fuente del metodo http://www.desarrolloweb.com/articulos/upload-archivos-ajax-jquery.html

            $("#formuploadajax").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formuploadajax"));
            formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $("#loading").show();
            $("#btnAgregar").hide();
            $("#btnEliminar").hide();
            $.ajax({
                url: "controller/udpMateria.php?id="+idRow,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
	           processData: false
            }).done(function(res){
                    //alert("devuelve "+res);

                if(res == "true"){
                    console.log("Registro exitoso");

                    setTimeout(function() {
                    location.href = 'lisMaterial.php';
                    }, 2000);

                }else
                {
                    console.log("Ops algo no esta bien");

                }


            });
        });//==> fin submmit


 });

</script>

</html>
