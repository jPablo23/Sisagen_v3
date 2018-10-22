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
                     <form role="form" enctype="multipart/form-data" id="formuploadajax" method="post">
  <div class="form-group">
    <label for="inputName" class="control-label">Nombre</label>
    <input type="text" class="form-control" id="inputName" placeholder="Centro B1" name="nombre" maxlength="30" required>
  </div>
  <div class="form-group">
    <label for="inputName" class="control-label">descripcion</label>
    <input type="text" class="form-control" id="inputName" placeholder="maximo 100 caracteres" name="descripcion" maxlength="100" required>
  </div>

  <div class="form-group">
    <label for="inputName" class="control-label">existencias</label>
    <input type="number" class="form-control" id="inputName" placeholder="Existencia de material (Numericos)" name="existencias" min="1" required>
  </div>

  <div class="form-group">
    <label for="inputName" class="control-label">Imagen</label>
    <input type="file" class="form-control" id="txtdocumento_filesyst" placeholder="img" name="documento_filesyst" onchange="validarIMG()" required>
    <input type="hidden" id="txtImagen" name="imagen"/>
      <input type="hidden" id="txtdocumento_filesystem" name="documento_filesystem"/>
  </div>


  </div>
 <div class="form-group">
    <button id="btnAgregar" type="submit" class="btn btn-primary" >Agregar</button>

</div>
</form>
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
   var opc = '<?php echo $_GET["opc"];?>';

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


 // console.log(opc);
    switch (opc){
		case 'nuevo':

            //==> fuente del metodo http://www.desarrolloweb.com/articulos/upload-archivos-ajax-jquery.html

            $("#formuploadajax").on("submit", function(e){
            e.preventDefault();
            $("#loading").show();
            $("#btnAgregar").hide();
            var f = $(this);
            var formData = new FormData(document.getElementById("formuploadajax"));
            formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: "controller/addMateria.php",
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
                    smoke.signal("Registro exitoso!", function(e){

                    }, {
                    duration: 3000,
                    classname: "custom-class"
                    });
                    setTimeout(function() {
                    location.href = 'lisMaterial.php';
                    }, 2000);

                }else
                {
                    console.log("Ops algo no esta bien");

                }


            });
        });




            break;
        case 'editar':

			break;

	}//cierro switch*/


 });

</script>

</html>
