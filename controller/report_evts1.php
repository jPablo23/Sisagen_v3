<?php
	include_once "../phplib/dompdf/dompdf_config.inc.php";
  include_once '../model/conexion.php';

//==> Tabla principal
  $resultUpd = mysqli_query($Con,"SELECT
  								evt.id,
  								evt.title,
  								evt.body,
  								evt.inicio_normal,
  								evt.final_normal,
  								evt.numero_personas,
  								evt.tiene_peticion,
  								usu.usuario,
  								usu.nombre  as usu_nombre,
  								usu.app     as usu_app,
  								usu.apm     as usu_apm
  				FROM tbl_eventos as evt
  				JOIN tbl_usuarios as usu ON usu.idRow = evt.usuarios_id");
//==> Tabla Espacio
  $resultEsp = mysqli_query($Con,"SELECT distinct spf.nombre AS espacio_fis
                                    FROM tbl_evento_detalle    AS evt
                                    JOIN tbl_espacios_fisicos  AS spf ON spf.idRow = evt.espacios_fisicos_id");
//==> Tabla Material
  $resultMat = mysqli_query($Con,"SELECT          mat.nombre AS material,
                                                  evn.title  AS titulo,
                                                  usu.usuario AS usuari
                                  FROM tbl_evento_detalle    AS evt
                                  JOIN tbl_materiales        AS mat  ON mat.idRow = evt.materiales_id
                                  JOIN tbl_eventos           AS evn ON evn.id    = evt.eventos_id
                                  JOIN tbl_usuarios          AS usu ON usu.idRow = evn.usuarios_id");

//==> Tabla Peticiones
  $resultPet = mysqli_query($Con,"SELECT pte.descripcion AS peticion,
                                         ste.nombre      AS sta_peticion,
                                         evn.title       AS evento_p,
                                         usu.usuario     AS usuari_p
                                  FROM tbl_peticiones    AS pte
                                  JOIN tbl_peticiones_status AS ste ON ste.idRow = pte.peticion_status
                                  JOIN tbl_eventos       AS evn ON evn.id = pte.eventos_id
                                  JOIN tbl_usuarios      AS usu ON usu.idRow = evn.usuarios_id");
//==> Tabla Cancelaciones
$resultCan = mysqli_query($Con,"SELECT  evn.title      as evento_cancelado,
                                        uss.usuario    as usuari_cancelo,
                                        ecn.comentario as comentario,
                                        usu.usuario    as usuario_evento
                                FROM tbl_evento_cancelado as ecn
                                JOIN tbl_eventos          as evn  ON evn.id = ecn.eventos_id
                                JOIN tbl_usuarios         as uss  ON uss.idRow = ecn.usuarios_id
                                JOIN tbl_usuarios         as usu  ON usu.idRow = evn.usuarios_id");


          $codigoHTML='
          <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml">
          <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <title>Reporte General</title>

          </head>

          <body>
          <div align="center">
          <h1>Sistema de Prestamos Online</h1>
          <img src="../img/logo1.png" alt="Conalep" width="50" height="50" />
          <h5 style="font-size: 60%;">Plantel San Felipe GTO.</h5>
          </div>
          <div align="center">
              <table width="95%">
                <tr>
                  <td bgcolor="#00785F"><strong>Titulo</strong></td>
                  <td bgcolor="#00785F"><strong>Evento</strong></td>
                  <td bgcolor="#00785F"><strong>Fecha inicio</strong></td>
                  <td bgcolor="#00785F"><strong>Fecha Fin</strong></td>
                  <td bgcolor="#00785F"><strong>Numero de personas</strong></td>
                  <td bgcolor="#00785F"><strong>Usuario</strong></td>
                </tr>';
                  while($dato=mysqli_fetch_array($resultUpd)){
          $codigoHTML.='
                <tr>
                  <td>'.$dato['title'].'</td>
                  <td>'.$dato['body'].'</td>
                  <td>'.$dato['inicio_normal'].'</td>
                  <td>'.$dato['final_normal'].'</td>
                  <td>'.$dato['numero_personas'].'</td>
                  <td>'.$dato['usuario'].'</td>
                </tr>';
                }
          $codigoHTML.='
              </table>
          </div>
          <hr>
          <div align="center">
              <table width="95%">
                <tr>
                  <td bgcolor="#00785F"><strong>Espacio reservado</strong></td>
                </tr>';
                  while($dato=mysqli_fetch_array($resultEsp)){
          $codigoHTML.='
                <tr>
                  <td>'.$dato['espacio_fis'].'</td>
                </tr>';
                }
          $codigoHTML.='
              </table>
          </div>
          <hr>
          <div align="center">
              <table width="95%">
                <tr>
                  <td bgcolor="#00785F"><strong>Material reservado</strong></td>
                  <td bgcolor="#00785F"><strong>Para el evento</strong></td>
                  <td bgcolor="#00785F"><strong>Usuario que reservo</strong></td>
                </tr>';
                  while($dato=mysqli_fetch_array($resultMat)){
          $codigoHTML.='
                <tr>
                  <td>'.$dato['material'].'</td>
                  <td>'.$dato['titulo'].'</td>
                  <td>'.$dato['usuari'].'</td>
                </tr>';
                }
          $codigoHTML.='
              </table>
          </div>
          <hr>
          <div align="center">
              <table width="95%">
                <tr>
                  <td bgcolor="#00785F"><strong>Peticiones</strong></td>
                  <td bgcolor="#00785F"><strong>Evento</strong></td>
                  <td bgcolor="#00785F"><strong>Usuario</strong></td>
                  <td bgcolor="#00785F"><strong>Seguimiento</strong></td>
                </tr>';
                  while($dato=mysqli_fetch_array($resultPet)){
          $codigoHTML.='
                <tr>
                  <td>'.$dato['peticion'].'</td>
                  <td>'.$dato['evento_p'].'</td>
                  <td>'.$dato['usuari_p'].'</td>
                  <td>'.$dato['sta_peticion'].'</td>
                </tr>';
                }
          $codigoHTML.='
              </table>
          </div>
          <hr>
          <div align="center">
              <table width="95%">
                <tr>
                  <td bgcolor="#00785F"><strong>Reservacion cancelada</strong></td>
                  <td bgcolor="#00785F"><strong>Usuario cancelo</strong></td>
                  <td bgcolor="#00785F"><strong>Comentario</strong></td>
                  <td bgcolor="#00785F"><strong>Usuario reservo</strong></td>
                </tr>';
                  while($dato=mysqli_fetch_array($resultCan)){
          $codigoHTML.='
                <tr>
                  <td>'.$dato['evento_cancelado'].'</td>
                  <td>'.$dato['usuari_cancelo'].'</td>
                  <td>'.$dato['comentario'].'</td>
                  <td>'.$dato['usuario_evento'].'</td>
                </tr>';
                }
          $codigoHTML.='
              </table>
          </div>

<div align="center">

          <p>
            copyright&copy; Colegio Nacional de Educaci&oacute;n Profecional
            T&eacute;cnica. Derechos reservados @2016<br> Trojes de Teran s/n,
            Col. La Florida, San Felipe, Gto. C.P. 37600 Telefono 01 428 685
            0104
          </p>
</div>

          </body>
          </html>';

//echo $codigoHTML;
$codigoHTML=utf8_decode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("ReporteGeneral.pdf");
?>
