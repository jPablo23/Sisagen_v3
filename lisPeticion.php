<?php
//==> librerias php
require "phplib/listados_PDO/PDO_Pagination.php";

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
	$pagination->rowCount("SELECT peticion_id,
																descripcion,
																peticion_status,
																nombre_estarus,
																eventos_id,
																evento_titulo,
																usuario
								FROM vw_peticiones
						    WHERE descripcion LIKE '%$search%'
								      ");
	$pagination->config(3, 5);
	$sql = "SELECT peticion_id,
									descripcion,
									peticion_status,
									nombre_estarus,
									eventos_id,
									evento_titulo,
									usuario
								FROM vw_peticiones
						    WHERE descripcion LIKE '%$search%'
		    ORDER BY peticion_id ASC
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
	$pagination->rowCount("SELECT peticion_id,
																descripcion,
																peticion_status,
																nombre_estarus,
																eventos_id,
																evento_titulo,
																usuario
								FROM vw_peticiones
                ");
	$pagination->config(3, 5);
	$sql = "SELECT peticion_id,
									descripcion,
									peticion_status,
									nombre_estarus,
									eventos_id,
									evento_titulo,
									usuario
								FROM vw_peticiones
						   ORDER BY peticion_id ASC LIMIT $pagination->start_row, $pagination->max_rows";
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

    <title>Listado de peticiones</title>
</head>

<body>
<?php include 'inc/navigation.php'; ?>
    <br>
    <br>
    <br>
<div class="form-group">
  <div class="table-responsive">
<table class="table table-bordered table-striped">
    <tr>
        <th align="center">Descripcion</th>
        <th align="center">Titulo de Evento</th>
				<th align="center">Estatus</th>
        <th align="center">Usuario</th>
        <th align="center"><span class='fa fa-check'></span></th>
    </tr>
    <?php
    foreach($model as $row)
    {
        echo "<tr>";
        echo "<td align='center'>".$row['descripcion']."</td>";
				echo "<td align='center'>".$row['evento_titulo']."</td>";
        echo "<td align='center'>".$row['nombre_estarus']."</td>";
        echo "<td align='center'>".$row['usuario']."</td>";
        echo "<td align='center' data-value='".$row['peticion_id']."' class='editar' onclick='editar(".$row['peticion_id'].")'><span class='fa fa-check'></span> </td>";
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

function editar(value){
    //console.log("hola "+ value);
 location.href="obtener_peticion.php?idElemen="+ value;


    }//== fin

</script>


<?php include 'inc/footer.php'; ?>

</body>

</html>
