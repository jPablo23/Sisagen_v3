<?php
include '../phplib/tcpdf/6.2.12/config/tcpdf_config.php';
include '../phplib/tcpdf/6.2.12/tcpdf.php';
//incluimos nuestro archivo config
include_once '../model/conexion.php';

// Incluimos nuestro archivo de funciones
include '../funciones.php';

$tmpPath = "/tmp/";
$file = "Hoja_de_reporte.pdf";


/**
 * [reportePDF Crea el reporte con sonsulta de la base de datos]
 * @param  [type] $idTraspaso [Recupera el ID del traspaso que inserto]
 * @return [type]             [html--> Para dibujar el pdf]
 */

class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		//$image_file = '../themes/default/images/logo_izquierdo.jpg';
		//$this->Image($image_file, 30, 7, 17, 20, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->ln(5);
		$this->SetTextColor(0, 100, 0, 0);
		$this->SetFont('helvetica', 'B', 12);
		// Title

		$arrDiasSemana = array(
							0 => "Dom",
							1 => "Lun",
							2 => "Mar",
							3 => "Mié",
							4 => "Jue",
							5 => "Vie",
							6 => "Sáb"
								);

		$arrMeses = array(
							"01" => "Ene",
							"02" => "Feb",
							"03" => "Mar",
							"04" => "Abr",
							"05" => "May",
							"06" => "Jun",
							"07" => "Jul",
							"08" => "Ago",
							"09" => "Sep",
							"10" => "Oct",
							"11" => "Nov",
							"12" => "Dic"
								);

		$fecha =  $arrDiasSemana[strftime("%w")]. ' '. strftime("%d/"). $arrMeses[strftime("%m")]. strftime("/%Y %l:%M %P");
		$this->Cell(0, 0, 'REPORTE DEL SISTEMA DE RESERVACIÓN', 0, 1, 'L', 0, '', 0);

		//Titulo de la fecha de impresión
		$this->SetTextColor(0, 255, 255, 255);
		$this->SetFont('helvetica', 'NB', 7);
		$this->Text(135, 6, 'Impresión: ');
		//Fecha de impresión
		$this->SetFont('helvetica', 'N', 7);
		$this->Text(160, 6, $fecha);

	}

	// Page footer
	public function Footer() {
		;

		$footerHTML = "";
		$this->writeHTML($footerHTML, true, false, false, false, '');
		$this->SetFont('helvetica', 'B', 8);
		// Page number
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

	}
} //Aqui termina la extension para el header y footer.


function reportePDF_superior()
{

	$html ='
<body>
<div align="center">
<h1>Sistema de Prestamos Online</h1>
<img src="../img/logo1.png" alt="Conalep" width="50" height="50" />
<h5 style="font-size: 60%;">Plantel San Felipe GTO.</h5>
</div>
</body>
';
	return $html;
}//--> Fin funcion de Reporte

function reportePDF_tablaItems($Con)
{
//Mandamos el SQL para ejecutar
// y lo buscamos en la base de datos
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

	$html = '';
	$i=0;
	$html = $html.'<div align="center" id="divTabla-items">
			<table>';
			$html=$html.'<tr>
PARA EL DETALLE, FORMATEADO EN UNA TABLA
						</tr>';
	foreach ($resultUpd as $value) {
		if($i%2==0){
					$html=  $html.'<tr>';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $value["title"];
				$html = $html.'</td><td>';
				$html = $html. $value["body"];
				$html = $html.'</td><td>';
				$html = $html. $value["inicio_normal"];
				$html = $html.'</td><td>';
				$html = $html.'</td></tr>';
				$i++;
	}
$html=$html.'</table></div>';

	return $html;

}//--Fin Funcion_tablaItems

function reportePDF_usuarios_involucrados()
{

$html= '<div align="center">
Hola soy el pie de pagina
</div>
	';
	return $html;

}//--> Usuarios Involucrados




//--> Consulta al traspaso que se realizaron

// create new PDF document
$pdf = new MYPDF("L", PDF_UNIT, "LETTER", true, 'UTF-8', false);
//PDF_PAGE_FORMAT

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistema de Prestamos Online');
$pdf->SetTitle('Hoja de reporte');
$pdf->SetSubject('Hoja reporte');
$pdf->SetKeywords('Hoja reporte');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(6, 11, 6);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set font
//$pdf->SetFont('Arial', 'B', 12);
//========> no tengo arial
$pdf->SetFont('helvetica','B',12);
// add a page
$pdf->AddPage();

//*************
  ob_end_clean();//rompimiento de pagina
//*************

 // set some text to print
$fichaBorderColor = "#FA11B3";
$fichaLabelColor = "#FA11B3";
$fichaLabel = "#B9AD39";
$html ='
	<style>

		table{
			margin: 0;
			paddin:0;
			font-size: 10px;
		}

		.table-ficha{
			position: relative;
			margin: 0;
			paddin:0;
			width:100%;
			font-weight:normal;
		}

		.table-ficha tr td{
			margin: 0;
			paddin:0;
			border: 5px solid '.$fichaBorderColor.';
		}

		.table-ficha-right tr td.first-child{
			border-bottom: 5px solid '.$fichaBorderColor.';
		}


		label.title{
			color:'.$fichaLabelColor.';
			font-size: 14px;
			font-weight: bold;
		}

		label.subtitle{
			color:'.$fichaLabelColor.';
			font-size: 12px;
			font-weight: bold;
		}

		label.title-agenda{
			color:'.$fichaLabel.';
			font-size: 16px;
			font-weight: bold;
		}

		.table-data{
			width:100%;
			border 1px solid red;
		}

		.table-data-label{
			width:100px;
		}

		.table-data-text{
			width:370px;
		}

		.table-border-left{
			border-left: 1px solid '.$fichaLabelColor.';
		}

	</style>

';

//preg_replace( array("/<div><\/div>/"), array("<br>"), $ficha["programa_actividades"])
$pdf->writeHTML($html, true, false, true, false, '');

//=========================>
$html_superior =reportePDF_superior();
$html_tablaItems =reportePDF_tablaItems($Con);
$html_usuarios_involucrados = reportePDF_usuarios_involucrados();

$pdf->writeHTML($html_superior, true, false, true, false, '');
$pdf->writeHTML($html_tablaItems, true, false, true, false, '');
$pdf->writeHTML($html_usuarios_involucrados, true, false, true, false, '');

//=============================>
//Close and output PDF document
//$pdf->Output($tmpPath.$file, 'F');
$pdf->Output($tmpPath.$file, 'I');

$pdf->close();


$html_superior =reportePDF_superior();
$html_tablaItems =reportePDF_tablaItems($Con);
$html_usuarios_involucrados = reportePDF_usuarios_involucrados();

$pdf->writeHTML($html_superior, true, false, true, false, '');
$pdf->writeHTML($html_tablaItems, true, false, true, false, '');
$pdf->writeHTML($html_usuarios_involucrados, true, false, true, false, '');

$pdf->AddPage();

$pdf->Output($tmpPath.$file, 'I');

$pdf->close();

?>
