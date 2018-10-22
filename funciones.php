<?php
/*
// conecto a la base de datos para extraer los datos y enviar el correo
//incluimos nuestro archivo config
include 'model/config.php';
*/

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

// Evaluar los datos que ingresa el usuario y eliminamos caracteres no deseados.
function evaluar($valor)
{
	$nopermitido = array("'",'\\','<','>',"\"");
	$valor = str_replace($nopermitido, "", $valor);
	return $valor;
}

// Formatear una fecha a microtime para añadir al evento, tipo 1401517498985.
function _formatear($fecha)
{
	return strtotime(substr($fecha, 6, 4)."-".substr($fecha, 3, 2)."-".substr($fecha, 0, 2)." " .substr($fecha, 10, 6)) * 1000;
}

//==> funcion para enviar correo

/*function SentMail()
{
	//==============================================> Envia correo

	//==> obtener los correos
	$resultN = mysqli_query($Conxion,"SELECT * FROM vw_sentCorreoUsuarioReserva
	                                   WHERE eventos_id = 4");
	if ($row = mysqli_fetch_array($resultN)) {
	  $Correo = trim($row[0]);
	}

	$m= new Mail; // create the mail
	//$m->From( "mahjesus@gmail.com" );
	$m->To( "".$Correo."" );
	$m->Subject( "Correo de reservacion de areas" );

	$message ="<!DOCTYPE html>
	<html>
	<head>
	  <meta charset='utf-8'>
	</head>
	<body>
	<div style='background-color:#E8E8E8; position:relative; width:100%; font-style:normal;  font-family:sans-serif;'>
	  <div style='color:#FFFFFF; width:100%; padding:0; font-style:normal;  font-family:sans-serif;'>
	    <div style='display:block; padding:1rem; background-color:#3498DB; color:#FFFFFF; margin:0; text-align:center; font-size:1.5rem; font-weight:bold; font-style:italic; font-family:sans-serif;'>Agendacion de estudio optometrista</div>
	  </div>
	  <div style='color:#000000; margin:0 auto; min-height:100px; width:80%; background-color:#FFFFFF; padding:1rem; font-size: 1rem; font-style:normal; font-family:sans-serif;'>
	    <p style='text-align:justify; margin:10px; font-size: 1rem; font-style:italic; font-family:sans-serif;'>
	    Nuevo evento creado, con la fecha $inicio_normal y termina el $final_normal

	    </p>
	    <br/>
	  </div>
	  <div>
	    <p style='text-align:right; margin:0; padding:5px 10px; font-size:.85rem; background-color:#484848; color:#FFFFFF; font-weight:normal; font-style:italic; font-family:sans-serif;'> mensajeAutomatico </p>
	  </div>
	  <div style='background-color:#484848; color:#FFFFFF; min-height:60px; text-align:center; width:100%; font-size: 1rem; font-style:italic; font-family:sans-serif;'>
	    <h4 style='display:inline-block; margin:10px 10px 0px 10px; font-size:.80rem; font-style:italic; font-family:sans-serif;'>Optica</h4>
	    <h3 style='margin:0px 10px 1px 10px; font-size:.90rem; font-style:italic; font-family:sans-serif;'>Tu mejor opción</h3>
	  </div>
	</div>
	</body>
	</html>";
	$m->Body( $message,'utf8');        // set the body
	$m->Cc( "koda_kenshin@hotmail.com");
	$m->Send();        // send the mail


}*/

 ?>
