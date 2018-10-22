<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <?php include 'inc/header.php'; ?>
    <title>Sistema de Prestamos Online</title>
</head>

<body>
   <section id="Formulario">
           <fieldset>
        <legend>  Acceso al sistema</legend>

<div id="divLogin" class="center-block">
<h2 align="center"> SISTEMA DE PRESTAMOS ONLINE </h2>
<br>
<br>
<br>

	<div class="row">
		<div class="col-md-12">
			<form data-toggle="validator" role="form" id="frm" action ="controller/login.php" method="post">

				<div class="form-group">

				<span class="glyphicon glyphicon-user"></span>	<label for="exampleInputEmail1"> Usuario </label>
					<input class="form-control" type="text" name="usuario"
                           placeholder="Usuario" required message='Escriba el nombre del usuario.' maxlength="10"/>
				</div>
				<div class="form-group">

					<span class="glyphicon glyphicon-screenshot"></span><label for="exampleInputPassword1"> Password </label>
					<input class="form-control" type="password" name="password" data-minlength="5" maxlength="8" placeholder="Password" required/>
				</div>
				<button type="submit" class="btn btn-default glyphicon glyphicon-ok"> Acceder </button>
			</form>
		</div>
	</div>
</div>
 </fieldset>
 </section>
 <br>
 <br>
 <br>
 <br>
 <footer>
     <div class="container">
         <div class="row" style="text-align: center;">
             <div class="col-lg-12">
                 <img src="img/logo1.png" alt="Conalep" width="50" height="50" />
                 <h1 style="font-size: 60%;">Plantel San Felipe GTO.</h1>
                 <p>
                   copyright&copy; Sistema de asignacion de areas @2016<br> Arguello #306,
                      Col. Oriental, San Felipe, Gto. C.P. 37600 
                 </p>
             </div>
         </div>
     </div>
 </footer>

</body>

</html>
