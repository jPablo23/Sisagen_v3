<?php
//==> Lo utilizo para agregar el espacio fisico
include_once 'model/conexion.php';
/**
**
**  BY iCODEART
**
**********************************************************************
**                      REDES SOCIALES                            ****
**********************************************************************
**                                                                ****
** FACEBOOK: https://www.facebook.com/icodeart                    ****
** TWIITER: https://twitter.com/icodeart                          ****
** YOUTUBE: https://www.youtube.com/c/icodeartdeveloper           ****
** GITHUB: https://github.com/icodeart                            ****
** TELEGRAM: https://telegram.me/icodeart                         ****
** EMAIL: info@icodeart.com                                       ****
**                                                                ****
**********************************************************************
**********************************************************************
**/

// Definimos nuestra zona horaria
date_default_timezone_set("America/Santiago");

// incluimos el archivo de funciones
include 'funciones.php';

// incluimos el archivo de configuracion
include 'model/config.php';

// Verificamos si se ha enviado el campo con name from
if (isset($_POST['from']))
{

    // Si se ha enviado verificamos que no vengan vacios
    if ($_POST['from']!="" AND $_POST['to']!="")
    {

        // Recibimos el fecha de inicio y la fecha final desde el form

        $inicio = _formatear($_POST['from']);
        // y la formateamos con la funcion _formatear

        $final  = _formatear($_POST['to']);

        // Recibimos el fecha de inicio y la fecha final desde el form

        $inicio_normal = $_POST['from'];

        // y la formateamos con la funcion _formatear
        $final_normal  = $_POST['to'];

        // Recibimos los demas datos desde el form
        $titulo = evaluar($_POST['title']);

        // y con la funcion evaluar
        $body   = evaluar($_POST['event']);

        // reemplazamos los caracteres no permitidos
        $clase  = evaluar($_POST['class']);

        // insertamos el evento
        $query="INSERT INTO tbl_eventos (title,
										body,
										url,
										class,
										start,
										end,
										inicio_normal,
										final_normal
)

		VALUES('$titulo',
			   '$body',
			   '',
			   '$clase',
			   '$inicio',
			   '$final',
			   '$inicio_normal',
			   '$final_normal')";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query);

        // Obtenemos el ultimo id insetado
        $im=$conexion->query("SELECT MAX(id) AS id FROM tbl_eventos");
        $row = $im->fetch_row();
        $id = trim($row[0]);

        // para generar el link del evento
        $link = "descripcion_evento.php?id=$id";

        // y actualizamos su link
        $query="UPDATE tbl_eventos SET url = '$link' WHERE id = $id";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query);

        // redireccionamos a nuestro calendario
        //header("Location:$base_url");
        	header("Location:$base_url"."panel.php");
    }
}

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8">
		<?php include 'inc/header.php'; ?>
        <title>Sistema de Prestamos Online</title>

    </head>

</head>
<body style="background: white;">
<?php include 'inc/navigation.php'; ?>
        <div class="container">
<br>
<br>
                <div class="row">
                        <div class="page-header"><h2></h2></div>
                                <div class="pull-left form-inline"><br>
                                        <div class="btn-group">
                                            <button class="btn btn-primary" data-calendar-nav="prev"><< Anterior</button>
                                            <button class="btn" data-calendar-nav="today">Hoy</button>
                                            <button class="btn btn-primary" data-calendar-nav="next">Siguiente >></button>
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-warning" data-calendar-view="year">Año</button>
                                            <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
                                            <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                                            <button class="btn btn-warning" data-calendar-view="day">Dia</button>
                                        </div>

                                </div>
                                    <div class="pull-right form-inline"><br>
                                      <a class="btn btn-info" href="lisEventos.php">Eventos</a>
                                        <!--<button class="btn btn-info" data-toggle='modal' data-target='#add_evento'>Añadir Evento</button>-->
                                    </div>

                </div><hr>

                <div class="row">
                        <div id="calendar"></div> <!-- Aqui se mostrara nuestro calendario -->
                        <br><br>
                </div>

                <!--ventana modal para el calendario-->
                <div class="modal fade" id="events-modal">
                    <div class="modal-dialog">
                            <div class="modal-content">
                                    <div class="modal-body" style="height: 400px">
                                        <p>One fine body&hellip;</p>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
        </div>

    <script src="js/underscore-min.js"></script>
    <script src="js/calendar.js"></script>
    <script type="text/javascript">
        (function($){
                //creamos la fecha actual
                var date = new Date();
                var yyyy = date.getFullYear().toString();
                var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
                var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

                //establecemos los valores del calendario
                var options = {

                    // definimos que los eventos se mostraran en ventana modal
                        modal: '#events-modal',

                        // dentro de un iframe
                        modal_type:'iframe',

                        //obtenemos los eventos de la base de datos
                        events_source: 'obtener_eventos.php',

                        // mostramos el calendario en el mes
                        view: 'month',

                        // y dia actual
                        day: yyyy+"-"+mm+"-"+dd,


                        // definimos el idioma por defecto
                        language: 'es-ES',

                        //Template de nuestro calendario
                        tmpl_path: 'tmpls/',
                        tmpl_cache: false,


                        // Hora de inicio
                        time_start: '08:00',

                        // y Hora final de cada dia
                        time_end: '22:00',

                        // intervalo de tiempo entre las hora, en este caso son 30 minutos
                        time_split: '30',

                        // Definimos un ancho del 100% a nuestro calendario
                        width: '100%',

                        onAfterEventsLoad: function(events)
                        {
                                if(!events)
                                {
                                        return;
                                }
                                var list = $('#eventlist');
                                list.html('');

                                $.each(events, function(key, val)
                                {
                                        $(document.createElement('li'))
                                                .html('<a href="' + val.url + '">' + val.title + '</a>')
                                                .appendTo(list);
                                });
                        },
                        onAfterViewLoad: function(view)
                        {
                                $('.page-header h2').text(this.getTitle());
                                $('.btn-group button').removeClass('active');
                                $('button[data-calendar-view="' + view + '"]').addClass('active');
                        },
                        classes: {
                                months: {
                                        general: 'label'
                                }
                        }
                };


                // id del div donde se mostrara el calendario
                var calendar = $('#calendar').calendar(options);

                $('.btn-group button[data-calendar-nav]').each(function()
                {
                        var $this = $(this);
                        $this.click(function()
                        {
                                calendar.navigate($this.data('calendar-nav'));
                        });
                });

                $('.btn-group button[data-calendar-view]').each(function()
                {
                        var $this = $(this);
                        $this.click(function()
                        {
                                calendar.view($this.data('calendar-view'));
                        });
                });

                $('#first_day').change(function()
                {
                        var value = $(this).val();
                        value = value.length ? parseInt(value) : null;
                        calendar.setOptions({first_day: value});
                        calendar.view();
                });
        }(jQuery));
    </script>

<div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Agregar nuevo evento</h4>
      </div>
      <div class="modal-body">
        <!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Cabecera</a></li>
  <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Detalles</a></li>
</ul>
        <form action="" method="post">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
              <label for="from">Inicio</label>
              <div class='input-group date' id='from'>
                  <input type='text' id="from" name="from" class="form-control" readonly />
                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
              </div>

              <br>

              <label for="to">Final</label>
              <div class='input-group date' id='to'>
                  <input type='text' name="to" id="to" class="form-control" readonly />
                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
              </div>

              <br>

              <label for="tipo">Tipo de evento</label>
              <select class="form-control" name="class" id="tipo">
                  <option value="event-info">Informacion</option>
                  <option value="event-success">Exito</option>
                  <option value="event-important">Importantante</option>
                  <option value="event-warning">Advertencia</option>
                  <option value="event-special">Especial</option>
              </select>

              <br>


              <label for="title">Título</label>
              <input type="text" required autocomplete="off" name="title" class="form-control" id="title" placeholder="Introduce un título">

              <br>


              <label for="body">Evento</label>
              <textarea id="body" name="event" required class="form-control" rows="3"></textarea>
            </div> <!-- fin home -->
            <div role="tabpanel" class="tab-pane" id="profile">
              <div class="form-group" id="divEspFisicos">
              <label for="title">Espacio físico a reservar</label>
              <select id="dllEspacioFisico" class="form-control" name="espacios_fisicos_id" required="true">
                <?php

                echo "<option value=''>Seleccione...</option>";
                $resultN = mysqli_query($Con,"SELECT idRow, nombre FROM tbl_espacios_fisicos WHERE eliminado = '0'");
                while($fila = mysqli_fetch_array($resultN)) {
                echo "<option value='".$fila['idRow']."'>".$fila['nombre']."</option>";
                }

                ?>
              </select>
              <br>
            </div>
              <div class="form-group" id="divMateriales">
                <h5>Materiales Requeridos</h5>
                <label for="title">Material</label>
                <input type="txtBuscar" autocomplete="on"
                class="form-control" id="txtBuscar" placeholder="Busca por nombre del material o Descripcion"
                messages="">
                <input type="hidden" id="idRow">
                <br>
                <label for="txtCantidad" class="control-label">Cantidad</label>
                <input type="number" min="1" id="txtCantidad" class="form-control"
                message='Falta cantidad'
                placeholder="acepta solo enteros"/>

                <input id="hdnMaterialesIDs" type="text" name="MaterialesIDs">
              </div>
            </div><!-- fin  profile -->
          </div> <!--Fin tab-content -->
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
      <div class="modal-footer">
      <!--  <input type="text" id="city" />-->
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Agregar</button>
        </form>
    </div>
  </div>
</div>
</div>
<?php include 'inc/footer.php'; ?>

</body>
</html>
