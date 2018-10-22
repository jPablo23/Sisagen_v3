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
	$pagination->rowCount("SELECT idRow,
                                    nombre,
                                    app,
                                    apm,
                                    usuario,
                                    password,
                                    correo,
                                    puesto_principal_id
								FROM tbl_usuarios
						    WHERE usuario LIKE '%$search%' OR
						          nombre LIKE '%$search%' OR
						          app LIKE '%$search%'    AND
                            eliminado = false AND
														idRow <> 1");
	$pagination->config(3, 5);
	$sql = "SELECT idRow,
                                    nombre,
                                    app,
                                    apm,
                                    usuario,
                                    password,
                                    correo,
                                    puesto_principal_id
								FROM tbl_usuarios
		    WHERE usuario LIKE '%$search%' OR
		          nombre LIKE '%$search%' OR
		          app LIKE '%$search%'
                  AND eliminado = false
									AND idRow <> 1
		    ORDER BY usuario ASC
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
	$pagination->rowCount("SELECT idRow,
                                    nombre,
                                    app,
                                    apm,
                                    usuario,
                                    password,
                                    correo,
                                    puesto_principal_id
								FROM tbl_usuarios
                                WHERE eliminado = false AND
																idRow <> 1");
	$pagination->config(3, 5);
	$sql = "SELECT idRow,
                                    nombre,
                                    app,
                                    apm,
                                    usuario,
                                    password,
                                    correo,
                                    puesto_principal_id
								FROM tbl_usuarios
                                WHERE eliminado = false AND
																idRow <> 1
						   ORDER BY usuario ASC LIMIT $pagination->start_row, $pagination->max_rows";
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

    <title>Listado de usuarios</title>
</head>

<body>
<?php include 'inc/navigation.php'; ?>
    <br>
    <br>
    <br>
<div class="form-group">
<button id='btnAgregar' class="btn btn-primary glyphicon glyphicon-plus">Agregar</button>
</div>

<div class="form-group">
  <div class="table-responsive">
<table class="table table-bordered table-striped">
    <tr>
        <th align="center">Nombre</th>
        <th align="center">Apellido</th>
        <th align="center">Apellido</th>
        <th align="center">Usuario</th>
        <th align="center">Correo</th>
        <th align="center"><span class='glyphicon glyphicon-pencil'></span></th>
    </tr>
    <?php
    foreach($model as $row)
    {
        echo "<tr>";
        echo "<td align='center'>".$row['nombre']."</td>";
        echo "<td align='center'>".$row['app']."</td>";
        echo "<td align='center'>".$row['apm']."</td>";
        echo "<td align='center'>".$row['usuario']."</td>";
        echo "<td align='center'>".$row['correo']."</td>";
        echo "<td align='center' data-value='".$row['idRow']."' class='editar' onclick='editar(".$row['idRow'].")'><span class='glyphicon glyphicon-pencil'></span> </td>";
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
             location.href="addUsuario.php?opc=nuevo";
		    });

});//==> fin ready




function editar(value){
    console.log("hola "+ value);
 location.href="updUsuario.php?idElemen="+ value;


    }//== fin

</script>


<?php include 'inc/footer.php'; ?>

</body>

</html>
