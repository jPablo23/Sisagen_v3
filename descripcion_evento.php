<?php
if(!isset($_SESSION))
{
	session_start();
}


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

    //incluimos nuestro archivo config
    include 'model/config.php';

    // Incluimos nuestro archivo de funciones
    include 'funciones.php';

    // Obtenemos el id del evento
    $id  = evaluar($_GET['id']);

    // y lo buscamos en la base de datos
    $bd  = $conexion->query("SELECT * FROM tbl_eventos WHERE id=$id");

    // Obtenemos los datos
    $row = $bd->fetch_assoc();

    // titulo
    $titulo=$row['title'];

    // cuerpo
    $evento=$row['body'];

    // Fecha inicio
    $inicio=$row['inicio_normal'];

    // Fecha Termino
    $final=$row['final_normal'];

		// obtener el id del usuario que lo creo
		$usuCreo = $row['usuarios_id'];

		// obtener capacidad de personas
		$numero_personas = $row['numero_personas'];

		// Extraemos los detalles de la reservacion
    $bd  = $conexion->query("SELECT spf.nombre as espacio_fi,
																		usu.usuario as usuario_r,
																		usu.nombre  as usu_nombre,
																		usu.app     as usu_app,
																		usu.apm     as usu_apm
														FROM tbl_eventos        as evt
														JOIN tbl_evento_detalle as edt   on evt.id = edt.eventos_id
														JOIN tbl_espacios_fisicos as spf ON spf.idRow = edt.espacios_fisicos_id
														JOIN tbl_usuarios       as usu   ON usu.idRow = evt.usuarios_id
														WHERE eventos_id =$id");
														// Obtenemos los datos
		$row2 = $bd->fetch_assoc();

		$usuario_r   = $row2['usuario_r'];
		$espacio_fi  = $row2['espacio_fi'];
		$usuCompleto = $row2['usu_nombre'].'  '.$row2['usu_app'].'  '.$row2['usu_apm'];

// Eliminar evento
if (isset($_POST['eliminar_evento']))
{
    $id  = evaluar($_GET['id']);
    $sql = "UPDATE tbl_eventos
              SET
							status_id = 2,
              es_cancelado = 1,
              fecha_cancelado = now()
              WHERE id = $id";
    if ($conexion->query($sql))
    {
        //echo "Evento eliminado";
				//Registro en el detalle
				//==> registramos en la tabla
				$usuarios_id = $_SESSION["id"];
				$comentarios = $_POST["comentario"];
				$sql = "INSERT INTO tbl_evento_cancelado
											(usuarios_id,
											eventos_id,
											comentario)
											VALUES
											('$usuarios_id',
											'$id',
											'$comentarios')";
		    if ($conexion->query($sql))
		    {
				echo "Evento eliminado";
				}else {
					echo "El evento no se pudo eliminar en detalle";
				} //=> fin else detalle

    }
    else
    {
        echo "El evento no se pudo eliminar";
    }
}
 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include 'inc/header.php'; ?>
	<title><?=$titulo?></title>

</head>
<body>
	 <h3><?=$titulo?></h3>
	 <hr>
     <b>Fecha inicio:</b> <?=$inicio?>
<hr>
		 <b>Fecha termino:</b> <?=$final?>
 	<p><?=$evento?></p>
<hr>
<p>
	usuario reservo: <?=$usuario_r?>
	<br>
	espacio físico reservado: <?=$espacio_fi?>
	<br>
	número de personas: <?=$numero_personas?>
	<br>
	<?=$usuCompleto?>
</p>

<?php
// la sesion es de un administrador
if($_SESSION['rol_principal'] == 1){
echo '<form id="formData" action="" method="post">
<input type="text" name="comentario" placeholder="Si elimina requiere comentario" required="true" class="form-control">
    <button id="btnEliminar" type="submit" class="btn btn-danger" name="eliminar_evento">Cancelar</button>
</form>';
}

// el usuario que lo creo decide cancelarlo
if($_SESSION['rol_principal'] != 1){
	if ($_SESSION['id'] == $usuCreo) {
		echo '
		<form id="formData" action="" method="post">
			<input type="text" name="comentario" placeholder="Si elimina requiere comentario" required="true" class="form-control">
		    <button id="btnEliminar" type="submit" class="btn btn-danger" name="eliminar_evento">Cancelar</button>
		</form>';
	}
}





?>

</body>
</html>
