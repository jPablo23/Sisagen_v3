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
//==> obtiene informacion de la tabla principal
    $_IdRow = $_GET["idElemen"];

    $resultUpd = mysqli_query($Con,"SELECT
                                    *
                                    FROM tbl_eventos
                                    WHERE id =".$_IdRow);
    while($fila = mysqli_fetch_array($resultUpd)) {
    //echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";

        $id      = $fila['id'];
        $title      = $fila['title'];
        $body      = $fila['body'];
        $url      = $fila['url'];
        $class      = $fila['class'];
        $start      = $fila['start'];
        $end      = $fila['end'];
        $numero_personas      = $fila['numero_personas'];
        $usuarios_id      = $fila['usuarios_id'];
        $status_id      = $fila['status_id'];
        $tiene_peticion      = $fila['tiene_peticion'];
        $inicio_normal      = $fila['inicio_normal'];
        $final_normal      = $fila['final_normal'];

    }

?>


        <div class="container">
          <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Cabecera</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Detalles</a></li>
    <li role="presentation"><a href="#peticiones" aria-controls="peticiones" role="tab" data-toggle="tab">Peticiones</a></li>
  </ul>
          <form role="form" id="formData" action ="controller/addEvento.php" method="post">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="home">
                <label for="from">Inicio</label>
                <div class='input-group date' id='from'>
                    <input type='text' id="from" name="from" class="form-control" readonly required="true" value="<?php echo $inicio_normal ?>"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </div>

                <br>

                <label for="to">Final</label>
                <div class='input-group date' id='to'>
                    <input type='text' name="to" id="to" class="form-control" readonly required="true" value="<?php echo $final_normal ?>"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </div>

                <br>

                <label for="tipo">Tipo de evento</label>
                <select class="form-control" name="class" id="tipo">
                  <?php
                      switch ($class) {
                        case 'event-info':
                        //echo "Informacion";
                        echo "<option value='event-info'>Informacion</option>";
                        break;
                        case 'event-success':
                        //echo "Exito";
                        echo "<option value='event-success'>Exito</option>";
                        break;
                        case 'event-important':
                        //echo "Importantante";
                        echo "<option value='event-important'>Importantante</option>";
                        break;
                        case 'event-warning':
                        //echo "Advertencia";
                        echo "<option value='event-warning'>Advertencia</option>";
                        break;
                        case 'event-special':
                        //echo "Especial";
                        echo "<option value='event-special'>Especial</option>";
                        break;
                      }
                    ?>
                  <option value="">Selecciona</option>
                    <option value="event-info">Informacion</option>
                    <option value="event-success">Exito</option>
                    <option value="event-important">Importantante</option>
                    <option value="event-warning">Advertencia</option>
                    <option value="event-special">Especial</option>
                </select>

                <br>


                <label for="title">Título</label>
                <input type="text" required autocomplete="off" name="title" class="form-control" id="title" placeholder="Introduce un título" value="<?php echo $title ?>"
                maxlength="45">

                <br>


                <label for="body">Evento</label>
                <input type="text" id="body" name="event" required class="form-control" value="<?php echo $body ?>"
                maxlength="120"/>
                <a class="btn btn-info btnNext" ><span class="glyphicon glyphicon-menu-right"></span> Siguiente</a>
              </div> <!-- fin home -->

<?php
//==> obtiene informacion detalle
    //$_IdRow = $_GET["idElemen"];

    $resultUpd = mysqli_query($Con,"SELECT
                                    espacios_fisicos_id
                                    FROM tbl_evento_detalle
                                    WHERE eventos_id =".$_IdRow);
    if($fila = mysqli_fetch_array($resultUpd)) {
    //while($fila = mysqli_fetch_array($resultUpd)) {
    //echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";

        $espacios_fisicos_id      = $fila['espacios_fisicos_id'];
        //$title      = $fila['title'];
    }

///=> espacios fisicos
    $resultUpd = mysqli_query($Con,"SELECT
                                    *
                                    FROM vw_obtespacios_fisicos
                                    WHERE idRow =".$espacios_fisicos_id);
    while($fila = mysqli_fetch_array($resultUpd)) {
    //echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";

        $espNombre      = $fila['espNombre'];
        //$descripcion      = $fila['descripcion'];
        $capacidad      = $fila['capacidad'];
        $areas_id      = $fila['areas_id'];
        $arsnombre      = $fila['arsnombre'];
        $fisicos_id      = $fila['idRow'];

    }

$materialesIds = array();

    $resultUpd = mysqli_query($Con,"SELECT
                                        materiales_id,

                                        mat.nombre AS nombre_marca
                                        FROM tbl_evento_detalle as edt
                                        JOIN tbl_materiales     as mat ON mat.idRow = edt.materiales_id
                                        WHERE edt.eliminado = 0 AND eventos_id =".$_IdRow);
    //if($fila = mysqli_fetch_array($resultUpd)) {
    while($fila = mysqli_fetch_array($resultUpd)) {
    //echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";

        //$espacios_fisicos_id      = $fila['materiales_id'];

        //$title      = $fila['title'];

        $html = '';
      	$i=0;
      	$html = $html.'<div id="row-table-traspaso" class="form-group table-responsive">
      			<table id="items-Prov" class="table table-bordered table-striped">';
      			$html=$html.'<tr>
            <td align="center">#</td>
            <td align="center">Material</td>
            <td align="center"><span class="glyphicon glyphicon-trash"></span></td>
            </tr>';
      	foreach ($resultUpd as $value) {
          //==> obtengo id material
          //Descubrimiento
          //array_push($materialesIds, $value );
          array_push($materialesIds, $value["materiales_id"] );
      		if($i%2==0){
      					$html=  $html.'<tr class="rowid">';
      				}else{
      					$html=$html.'<tr class="rowid">';
      				}
      				$html = $html.'<td>';
      				$html = $html. $value["materiales_id"];
      				$html = $html.'</td><td>';
      				$html = $html. $value["nombre_marca"];
      				$html = $html.'</td><td align="center" class="eliminar"  data-valor="0" data-valor2="'.$value["materiales_id"].
              '"><a class="glyphicon glyphicon-trash"></a>';
//      				$html = $html. $value["cantidad"];
//      				$html = $html.'</td><td>';
      				$html = $html.'</td></tr>';
      				$i++;
      	}
      $html=$html.'</table></div>';

      	//echo $html;

    }
//print_r($materialesIds);

//==> obtener los nombres de los materiales

?>
        <div role="tabpanel" class="tab-pane" id="profile">
                <!-- Selecionar el área

                -->

                <div class="form-group">
                  <label for="dllPuesto" class="control-label">Area</label>
                    <!--<input type="text" id="hdnpuesto" name="puesto_principal_id" value="2"/>-->
                    <select id="dllRol" class="form-control" required="true" onchange="extraer_areas(this.value)">
                      <?php

                      echo "<option value='".$areas_id."'>".$arsnombre."</option>";
                      echo "<option value=''>Seleccione</option>";
                      $resultN = mysqli_query($Con,"SELECT idRow, nombre FROM tbl_areas WHERE eliminado = '0'");
                      while($fila = mysqli_fetch_array($resultN)) {
                      echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";
                      }

                      ?>
                    </select>

                </div>
                <div class="form-group" id="divEspFisicos">
                <label for="title">Espacio físico a reservar</label>
                <div id="divEspacioTempo">
                  <select id="dllEspacioFisico" class="form-control" name="espacios_fisicos_id" required="true" onchange="obtener_numePersonas(this.value)">
                    <?php
                    echo "<option value='".$fisicos_id."'>".$espNombre."</option>";
                    echo "<option value=''>Seleccione...</option>";
                    $resultN = mysqli_query($Con,"SELECT idRow,
                                                         nombre
                                                    FROM tbl_espacios_fisicos
                                                    WHERE eliminado = '0'
                                                      AND areas_id =".$areas_id);
                    while($fila = mysqli_fetch_array($resultN)) {
                    echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";
                    }

                    ?>
                  </select>
                </div>
                <div id="divEspaciobyArea"></div>

                <br>
                <label for="numero_personas">Número de personas</label>
                <input type="number" min="1" required autocomplete="off" name="numero_personas"
                class="form-control" id="numero_personas" placeholder="Introduce el numero de personas"
                onkeyup="validarCantidad(this.value,this.id)" value="<?php echo $numero_personas ?>" max="<?php echo $capacidad ?>">

                <br>
              </div>
                <div class="form-group" id="divMateriales">
                  <h4>Materiales Requeridos</h4>
                  <hr>
                  <label for="title">Material</label>
                  <input type="text" autocomplete="on"
                  class="form-control" id="txtBuscar" placeholder="Busca por nombre del material o Descripcion"
                  messages="" onkeyup="">
                  <input type="hidden" id="idRow">
                  <br>
                  <!--<label for="txtCantidad" class="control-label">Cantidad</label>-->
                  <input type="hidden" min="1" id="txtCantidad" class="form-control"
                  message='Falta cantidad' onkeyup="validarCantidad(this.value,this.id)"
                  placeholder="acepta solo enteros"/>
                  <br>
                  <a id="btnAgregarRenglon" class="btn btn-primary btn-lg glyphicon glyphicon-plus"> Agregar</a>
                  <input id="hdnMaterialesIDs" type="hidden" name="MaterialesIDs">
                </div>
                <?php echo $html; ?>
<!--                <div id="row-table-traspaso" class="form-group table-responsive">

<table id="items-Prov" class="table table-bordered table-striped">
<tr>
<td align="center">#</td>
<td align="center">Material</td>
<td align="center">cantidad</td>
<td align="center"><span class="fa fa-trash"></span></td>
</tr>
</table>

                </div>-->
                <a class="btn btn-info btnPrevious" ><span class="glyphicon glyphicon-menu-left"></span> Anterior</a> |
                <a class="btn btn-info btnNext" ><span class="glyphicon glyphicon-menu-right"></span> Siguiente</a>
              </div><!-- fin  profile -->

<!-- Tiene peticion -->

<?php

//echo "Tiene peticion";
//echo $tiene_peticion;

if ($tiene_peticion != 0) {
  //Carga las peticiones
  $resultUpd = mysqli_query($Con,"SELECT
                                  *
                                  FROM tbl_peticiones
                                  WHERE eventos_id =".$_IdRow);
  while($fila = mysqli_fetch_array($resultUpd)) {
  //echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";

      $peticiones_ids      = $fila['idRow'];
      $descripcion         = $fila['descripcion'];
      $peticion_status     = $fila['peticion_status'];

  }
}
else {
  $descripcion = "";
  $peticion_status = 0;
  $peticiones_ids = 0;
}

?>
              <div role="tabpanel" class="tab-pane" id="peticiones">
                <div class="form-group">
                  <label for="inputName" class="control-label">Tiene Peticion</label>
                  <input type="checkbox" id="chktiene_peticion">
                  <input type="hidden" id="hdntiene_peticion" name="tiene_peticion" value="false">
                  <input type="hidden" id="hdnpeticiones_id" name="peticiones_ids" value="<?php echo $peticiones_ids ?>">
                </div>
                <div class="form-group">
                  <label for="inputName" class="control-label">Describa brevemente la peticion</label>
                  <input type="text" class="form-control" id="txtdescripcion" placeholder="Tiene 200 caracteres para expresar
                  la peticion" name="descripcion" maxlength="200" value="<?php echo $descripcion ?>" readonly="true">
                </div>
                <!--<input type="text" id="city" />-->
                <a class="btn btn-info btnPrevious" ><span class="glyphicon glyphicon-menu-left"></span> Anterior</a> |
                | <button id="btnCancelar" type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-home"></i> Salir</button>
                | <button id="btnAgregar" type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Agregar</button>

              </div><!-- fin  peticiones-->
            </div> <!--Fin tab-content -->
    </form>
      <script type="text/javascript">
          $(function () {
              $('#from').datetimepicker({
                  language: 'es',
                  minDate: new Date()
              });
              $('#to').datetimepicker({
                  language: 'es',
                  minDate: new Date()
              });

          });
      </script>
        </div>
            </div>
<div id="loading" aling="center">
  <div id="overlayShadow"></div>
  <div id="overlayMessage"><img id="loading-image" style="margin: 7px 7px;" src="img/ajaxloader.gif">
  </div>
</div> <!-- fin de cargando -->

<?php include 'inc/footer.php'; ?>

</body>

<script type="text/javascript">

function extraer_areas(value)
{
  $("#divEspacioTempo").remove();
$("#loading").show();

//==> buscamos por AJAX
    $.ajax({
        type: 'POST',
        url: 'controller/esp_fis.php',
        //data: $('#formData').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
        data: { idArea: value},   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
        success: function(data){
        //alert("devuelve "+data);
        $("#divEspaciobyArea").html(data);
        }
    });

setTimeout(function(){
   $("#loading").hide();
   //==> $("#")
   $("#numero_personas").val("0");
}, 1000);

}//= extraer_areas

/**
 * Obtener el nuemero de personas, cada espacio fisico tiene un maximo de número de personas
 */

function  obtener_numePersonas(value)
{
var value2 = 'numPersonas';
  //console.log("es el valor de espacio fisico "+value);
  //==> buscamos por AJAX
      $.ajax({
          type: 'POST',
          url: 'controller/getDetalles.php',
          //data: $('#formData').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
          data: { idRow: value, opc: value2},   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
          success: function(data){
          //alert("devuelve "+data);
          ///==> colocamos el maximo
          $("#numero_personas").attr("max",data);
          $("#numero_personas").val(data);
          }
      });

  setTimeout(function(){
     $("#loading").hide();
  }, 1000);

}//== fin obtener_numePersonas

//== Validar numero de personas

function validarCantidad(value,id)
{
//  console.log(" que id muestra "+id);

  console.log("que es: "+$("#"+id).attr("max"));
  console.log("values es: "+value);
  var max = parseInt($("#"+id).attr("max"));
  var valor = parseInt(value);
 if (valor > max) {
   alert("NOTA no se puede sobrepasar el numero");
   $("#"+id).val(max);
 }
} //===>>>>>>validarCantidad

/**
 * Obtener el nuemero maximo
 */

function  obtener_numeMateriales(value)
{
  $("#loading").show();
var value2 = 'numMateriales';
  //console.log("es el valor de espacio fisico "+value);
  //==> buscamos por AJAX
      $.ajax({
          type: 'POST',
          url: 'controller/getDetalles.php',
          //data: $('#formData').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
          data: { idRow: value, opc: value2},   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
          success: function(data){
          //alert("devuelve "+data);
          ///==> colocamos el maximo
          $("#txtCantidad").attr("max",data);
          $("#txtCantidad").val(data);
          }
      });

  setTimeout(function(){
     $("#loading").hide();
  }, 1000);

}//== fin obtener_numeMateriales

//==> Para actualizar



$(function (){
  //==> Obtiene peticion
  var tiene_pet1 = '<?php echo $tiene_peticion ?>';

  if (tiene_pet1 == 1) {

    $("#chktiene_peticion").prop("checked",true);
    $("#hdntiene_peticion").val( "1" );
    $("#txtdescripcion").prop("required", true);
    $("#txtdescripcion").prop("readonly", false);

  }

  //==> funcion de los botones
  $('.btnNext').click(function(){
   $('.nav-tabs > .active').next('li').find('a').trigger('click');
  });

   $('.btnPrevious').click(function(){
   $('.nav-tabs > .active').prev('li').find('a').trigger('click');
  });

//==> obtener id
    var idRow = '<?php echo $_GET["idElemen"];?>';


  $("#loading").hide();
//  $("#txtdescripcion").prop("readonly", true);
var arrIdsItems = [];
var arrCantidadItems = [];
  //===> obtiene arr de items
var str  = '<?php echo $separado_por_comas = implode(",", $materialesIds);?>';//=> para evitar el doble registro de items
var res = str.split(",");
var idsItems = res;
console.log("materiales");
console.log(idsItems);
var CantidadItems = [];

//==> Son enable, para obligar al usuario a selccionar un area primero
/*$("#numero_personas").prop('disabled', true);
$("#numero_personas").prop('disabled', true);
$("#numero_personas").prop('disabled', true);
*/
/*  var availableTags = ["ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++",
"Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell",
"Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme"];

$("#city").autocomplete({
       source: availableTags,
       messages: {
        noResults: '',
        results: function() {}
    }
});*/

//======> Cambios en el checkbox
$("#chktiene_peticion").change(function(){
  if(this.checked)
   {

    $("#hdntiene_peticion").val( "1" );
    $("#txtdescripcion").prop("required", true);
    $("#txtdescripcion").prop("readonly", false);
   }
   else
   {

    $("#hdntiene_peticion").val( "0" );
    $("#txtdescripcion").prop("required", false);
    $("#txtdescripcion").prop("readonly", true);
   }

});

  //======== Funcion de autocomplete
   $( "#txtBuscar" ).autocomplete({
     source: "controller/ajax_respons.php",
     /*source:function(request, response) {
     $.getJSON("ajax_respons.php", { idAlamcen: $('#ddlAlmacenesOrigen').val() },
     response);
   },//--> fin source,*/

    /*messages: {
        noResults: 'No hay materiales con ese nombre o descripcion',
        results: function(count) {
          //return count + (count > 1 ? ' results' : ' result ') + ' found';
          console.log(count);
          return "existen "+count+" coincidenceas, para seleccionar mueva las teclas de navegacion";
        }
    },*/

   focus: function (event, ui) {
     event.preventDefault();
     $("#txtBuscar").val(ui.item.label);
     console.log(ui.item.label);
   },

   select: function(event,ui){
     event.preventDefault();
     //$("#txtbuscar").val(ui.item.label);
     $("#idRow").val(ui.item.value);
     //console.log("me activo en el SELECT");
     //===> Obtenemos la cantidad dispobible de Materiales
     obtener_numeMateriales(ui.item.value);
   }

   });


   //==================== Para la tabla de items Inicio
    $("#btnAgregarRenglon").click(function(){
      //==Verificamos si hay datos

      if ($("#txtBuscar").val() != "") {
        if($("#txtCantidad").val() != ""){


                //== multiplica cantidad por precio de compra = costos
                var cantidad = $("#txtCantidad").val();
                var material = $("#txtBuscar").val();
                var idRowMat = $("#idRow").val();

                var a = idsItems.indexOf(idRowMat);
                if(a < 0)
                {
                console.log("debe de inserta el item sin preocupaciones");
                $("#items-Prov").append(
                '<tr class="rowid"><td class="itemsIDCell">'+idRowMat+
                '</td><td class="">'+material+
                '</td><td class="candidadesCell" style="display: none;">'+cantidad+
                '</td><td align="center" class="eliminar"  data-valor="'+cantidad+
                '" data-valor2="'+idRowMat+
                '"><a class="glyphicon glyphicon-trash"></a></td>'+
                '</td></tr>'
                //'<h2>detalles</h2>' + '<p>'+ui.item.value+'<p>'
                //==> guardo en array para validarlo

                );//--> div con html
                idsItems.push(idRowMat);//--> arreglo de Items
                //CantidadItems[$("#txtItem_id").val()] = $("#txtCantidad").val();
                //CostosCompras[$("#txtItem_id").val()] = $("#txtCostoCompra").val();
                CantidadItems.push(cantidad);
                }
                else {
                console.log("Borra renglon para sumar cantidades");
                alert("Item existente en la lista");
                }

                console.log(idsItems);
                //== limpia campos y pone el focus en item
                $("#txtCantidad").val("");
                $("#txtBuscar").val("");
                $("#idRow").val("");
        }//==> fin cantidad
        else {
          console.log("No hay datos");
        }

      }
      else
      {
        console.log("No hay datos");
      }//  */


    });//== fin boton Agregar renglon

   $('#items-Prov').css( 'cursor', 'pointer' );
    $("#items-Prov").on("click",".eliminar", function(e){ //user click on remove text
    /*	$(this).parent('tr').remove(); //remove text box
    return false;*/
    //$(this).parent('tr').remove();
    e.preventDefault();
    //==> Remueve el id del array
    var itemID = $(this).attr("data-valor2"); //==> obtenemos el importe que se elimino y lo descontamos del total
    var index = idsItems.indexOf(itemID);

    if (index > -1) {
        idsItems.splice(index, 1);
    };
   console.log("nuevo arr item es: "+idsItems);
    //======= Remueve linea de la tabla
      $(this).closest("tr").remove();

      return false;
    });//== fin remover renglon

//====================> Grabar
$("#formData").submit(function(event){

$(".rowid").each(function() {
  var ItemsId    = $(this).find(".itemsIDCell").text();
  var Cantidades = $(this).find(".candidadesCell").text();


  arrIdsItems.push(ItemsId);
  arrCantidadItems[ItemsId] = (Cantidades);


});

var count = 0;

for (var i = 0; i < arrIdsItems.length; i++) {
  count++;
}

if (count > 0) {

  $("#loading").show();
  $("#btnAgregar").hide();
  $("#btnCancelar").hide();
      //==> Guardamos por AJAX
          $.ajax({
              type: 'POST',
              url: 'controller/udpEvento.php?id='+idRow,
              data: $('#formData').serialize() + "&moredata1=" + arrIdsItems + "&moredata2=" + arrCantidadItems,   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
              success: function(data){
              alert("devuelve "+data);
              console.log(data);
                  if(data == "true"){
                  console.log("Registro exitoso");

                      setTimeout(function() {
                          location.href = 'panel.php';
                      }, 2000);

                  }else
                  {
                  console.log("Ops algo no esta bien");

                  }


              }
          }); //
}
else {
  console.log("No tiene datos");
}

    event.preventDefault();
});

$("#btnCancelar").click(function() {
  $("#loading").show();
  $("#btnCancelar").hide();
  $("#btnAgregar").hide();
  location.href = 'panel.php';
});

});//==> fin funcion()
</script>
</html>
