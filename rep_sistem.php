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
    <div class="col-xs-12 col-md-12"><h3>Generacion de reportes</h3></div>
  </div><!-- fin titulo -->
<!--  <div class="row">
    <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
    <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
    <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
  </div>fin Detalles de reporte -->

  <!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#Todo" aria-controls="Todo" role="tab" data-toggle="tab">Reporte</a></li>
<li role="presentation"><a href="#CondicionUsuario" aria-controls="CondicionUsuario" role="tab" data-toggle="tab">Reporte por usuario</a></li>
<li role="presentation"><a href="#CondicionFechas" aria-controls="CondicionFechas" role="tab" data-toggle="tab">Reporte por fechas</a></li>
</ul>

<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="Todo">
    <!--<form role="form" id="formDataTodo">-->
    <div class="form-group">
      <button id="btnTodo" type="button" class="btn btn-primary glyphicon glyphicon-file" > Obtener reporte</button>
    </div>
  <!--</form>-->
  <a class="btn btn-info btnNext" ><span class="glyphicon glyphicon-menu-right"></span> Siguiente</a>
  </div><!-- fin tab-pane active -->
  <div role="tabpanel" class="tab-pane" id="CondicionUsuario">
    <form role="form" id="formDataUsu" method="post" action="controller/report_evts2.php">
    <div class="form-group">
      <label for="dllPuesto" class="control-label">Usuario</label>
        <!--<input type="text" id="hdnpuesto" name="puesto_principal_id" value="2"/>-->
        <select id="dllUsuario" class="form-control" name="usuarios_id" required="true">
          <?php

          echo "<option value=''>Seleccione</option>";
          $resultN = mysqli_query($Con,"SELECT idRow, usuario FROM tbl_usuarios WHERE eliminado = '0'");
          while($fila = mysqli_fetch_array($resultN)) {
          echo "<option value='".$fila['idRow']."'>".$fila['usuario']."</option>";
          }

          ?>
        </select>

    </div>
    <div class="form-group">
      <button id="btnUsu" type="submit" class="btn btn-primary glyphicon glyphicon-file" > Obtener reporte</button>
    </div>
    </form>
    <a class="btn btn-info btnPrevious" ><span class="glyphicon glyphicon-menu-left"></span> Anterior</a> |
    <a class="btn btn-info btnNext" ><span class="glyphicon glyphicon-menu-right"></span> Siguiente</a>
  </div><!-- fin tab-pane active -->
  <div role="tabpanel" class="tab-pane" id="CondicionFechas">
    <form role="form" id="formDataFes" method="post" action="controller/report_evts3.php">
    <label for="from">Inicio</label>
<input type="text" name="from" id="txtfecha_Inicio">
    <br>

    <label for="to">Final</label>
<input type="text" name="to" id="txtfecha_Final">

    <br>
    <button id="btnFes" type="submit" class="btn btn-primary glyphicon glyphicon-file" > Obtener reporte</button>
  </form>
  <a class="btn btn-info btnPrevious" ><span class="glyphicon glyphicon-menu-left"></span> Anterior</a>
  </div><!-- fin tab-pane active -->
</div><!-- fin  tab-content-->


</div>
<br>
<br>
<br>
<br>

<?php include 'inc/footer.php'; ?>

</body>
<script type="text/javascript">

$(document).ready(function() {

  //==> funcion de los botones
  $('.btnNext').click(function(){
   $('.nav-tabs > .active').next('li').find('a').trigger('click');
  });

   $('.btnPrevious').click(function(){
   $('.nav-tabs > .active').prev('li').find('a').trigger('click');
  });

  $.datepicker.regional['es'] = {
  closeText: 'Cerrar',
  prevText: '<Ant',
  nextText: 'Sig>',
  currentText: 'Hoy',
  monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
  monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
  dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
  dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
  dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
  weekHeader: 'Sm',
  dateFormat: 'yy-mm-dd',
  //dateFormat: 'dd/mm/yy',
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: false,
  yearSuffix: ''
  };
  $.datepicker.setDefaults($.datepicker.regional['es']);

  //============== Funcion de calendario
 	$( "#txtfecha_Inicio" ).datepicker();
 //============== Funcion de calendario
 	$( "#txtfecha_Final" ).datepicker();
console.log("hola soy nuevo");
//$("#formDataTodo").submit(function(event){
$("#btnTodo").click(function(){
//==> obtenemos por AJAX
//--> Creo PDF
						location.href="controller/report_evts1.php";//-->**/
 }); ///==> fin obtener todos
 }); ///==> fin
</script>

</html>
