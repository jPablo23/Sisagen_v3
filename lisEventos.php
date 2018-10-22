
<?php

if(!isset($_SESSION))
{
	session_start();
}

//==> librerias php
require "phplib/listados_PDO/PDO_Pagination.php";

$usuArio = $_SESSION['id'];

/* Config Connection */
$root = 'root';
$password = '';
$host = 'localhost';
$dbname = 'dbsr';

$connection = new PDO("mysql:host=$host;dbname=$dbname;", $root, $password);
$pagination = new PDO_Pagination($connection);



$search = null;
if(isset($_REQUEST["search"]) && $_REQUEST["search"] != "")
{
	$search = htmlspecialchars($_REQUEST["search"]);
	$pagination->param = "&search=$search";
	$pagination->rowCount("SELECT id,
                                    title
								FROM tbl_eventos
						    WHERE title LIKE '%$search%'
								      AND es_cancelado = 0
                      AND usuarios_id = $usuArio ");
	$pagination->config(3, 5);
	$sql = "SELECT id,
                                    title
								FROM tbl_eventos
						    WHERE title LIKE '%$search%'
                AND es_cancelado = 0
                AND usuarios_id = $usuArio
		    ORDER BY id ASC
		    LIMIT $pagination->start_row, $pagination->max_rows";
	$query = $connection->prepare($sql);
	$query->execute();
	$model = array();
	while($rows = $query->fetch())
	{
		$model[] = $rows;
	}
}
else
{
	$pagination->rowCount("SELECT id,
                                    title
								FROM tbl_eventos
                WHERE es_cancelado = 0 ");
	$pagination->config(3, 5);
	$sql = "SELECT id,
                    title
								FROM tbl_eventos
								WHERE es_cancelado = 0
                AND usuarios_id = $usuArio
						   ORDER BY id ASC LIMIT $pagination->start_row, $pagination->max_rows";
	$query = $connection->prepare($sql);
	$query->execute();
	$model = array();
	while($rows = $query->fetch())
	{
		$model[] = $rows;
	}
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <?php include 'inc/header.php'; ?>

    <title>Listado de Areas</title>
</head>

<body>
<?php include 'inc/navigation.php'; ?>
    <br>
    <br>
    <br>
<div class="form-group">
<button id='btnAgregar' class="btn btn-primary glyphicon glyphicon-plus">AÑADIR EVENTO</button>
</div>

<div class="form-group">
  <div class="table-responsive">
<table class="table table-bordered table-striped">
    <tr>
        <th align="center">Evento</th>
        <th align="center"><span class='glyphicon glyphicon-pencil'></span></th>
    </tr>
    <?php
    foreach($model as $row)
    {
        echo "<tr>";
        echo "<td align='center'>".$row['title']."</td>";
        echo "<td align='center' data-value='".$row['id']."' class='editar' onclick='editar(".$row['id'].")'><span class='glyphicon glyphicon-pencil'></span> </td>";
        echo "</tr>";
    }
    ?>
</table>
    </div>
    </div>

<div>
<?php
$pagination->pages("btn");
?>
</div>


<script type="text/javascript">

$(document).ready(function() {

    		$("#btnAgregar").click(function(){
             location.href="addEvento.php";
		    });

});//==> fin ready




function editar(value){
    //console.log("hola "+ value);
 location.href="updEvento.php?idElemen="+ value;
}//== fin

</script>

<br>
<br>
<br>
<br>
<br>
<br>
<?php include 'inc/footer.php'; ?>

</body>

</html>
