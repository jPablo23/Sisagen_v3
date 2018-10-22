<?php

?>
<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="panel.php"><img src="img/logo1.png" alt="Conalep" width="40" height="40" /></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                  <li>

                    <?php

                    // el usuario comun
                    if($_SESSION['rol_principal'] != 1){
                      $Usu1 = $_SESSION['usuario'];
                      $idUs = $_SESSION['id'];
                      //echo "updUsuario.php?idElemen=".$_SESSION['id'];
                      $url = "updUsuario.php?idElemen=".$_SESSION['id'];
                     echo '<a href="'.$url.'"> Hola '.$Usu1.'</a>';
                    }
                    ?>

                  </li>
                    <li>
                        <a href="panel.php">Calendario</a>
                    </li>
                <!--    <li>
                        <a href="agendar_area.php">Agendar reservacion</a>
                    </li>-->

                    <li class='pull-right'>
                        <a href="logout.php">Salir</a>
                    </li>
                  <!--  <li class='pull-right'>
                        <a href="controller/ajax_respons.php">hola</a>
                    </li>-->

<?php
// la sesion es de un administrador

if($_SESSION['rol_principal'] == 1){

    echo "<li class='dropdown pull-right'>
                        <a data-toggle='dropdown' class='dropdown-toggle' href='catalogos/index.php'>Catalogos</a>
                          <ul class='dropdown-menu'>
						<li>
							<a href='lisUsuario.php'>Usuarios</a>
						</li>
						<li>
							<a href='lisArea.php'>Áreas</a>
						</li>
            <li>
							<a href='lisEspFis.php'>Espacios Fisícos</a>
						</li>
						<li>
							<a href='lisMaterial.php'>Materiales</a>
						</li>
						<li class='divider'>
						</li>
						<li>
							<a href='rep_sistem.php'>Reportes</a>
						</li>
					</ul>
                    </li>
                    <li>
                        <a href='lisPeticion.php'>Atender Peticiones</a>
                    </li>";
    //echo $_SESSION['name'];
}
if(($_SESSION['rol_principal']  >= 2 && $_SESSION['rol_principal'] <= 5)){

    echo "<li class='dropdown pull-right'>
                        <a data-toggle='dropdown' class='dropdown-toggle' href='catalogos/index.php'>Catalogos</a>
          <ul class='dropdown-menu'>
						<li>
							<a href='lisArea.php'>Áreas</a>
						</li>
            <li>
							<a href='lisEspFis.php'>Espacios Fisícos</a>
						</li>
						<li>
							<a href='lisMaterial.php'>Materiales</a>
						</li>
					</ul>
          </li>";
    //echo $_SESSION['name'];
}
?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
