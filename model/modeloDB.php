<?php
//include_once 'conexion.php';
require_once("db_mysql.php");
include '../funciones.php';

include '../phplib/Sendmail/sendmail.php';


class srAgenda{

/**
* Login de usuario
*/
    public  function login($Con,$usuario, $pass){

        //Consulta que trae el usuario

        $resultN = mysqli_query($Con, "SELECT * FROM tbl_usuarios Where usuario='$usuario' and password = '$pass'");
        if (mysqli_num_rows($resultN)>0)
        {
            //--> Pasan a la siguiente fase
            while ($fila = mysqli_fetch_array($resultN))
            {

                //$_SESSION['userid'] = $result->idusuario;
                //$_SESSION['nombre'] = $fila['Usu'];
                //$_SESSION['Rol'] = $fila['Rol'];
                //Id
                $_SESSION['id'] = $fila['idRow'];
                //$this->ini = 1;
                //Nombre

                $_SESSION['name'] = $fila['nombre'];
                //apellido

                $_SESSION['apellido'] = $fila['app'];

                //Usuario
                $_SESSION['usuario'] = $fila['usuario'];
                //Rol

                $_SESSION['rol_principal'] = $fila['puesto_principal_id'];

                    /*switch ($fila['Rol'])
                    {
                    case 1://--> Es administrador
                    header("location:administrador.php");
                    break;
                    case 2://--> Es Docente
                    header("location:administrador.php");
                    break;
                    case 3://--> Es un triste alumno
                    header("location:index.php");
                    break;
                    }*/
                header("Location: ../panel.php");


            }

        } else {
        echo "
        <meta charset='utf-8'>
        <script type='text/javascript'>
         alert('Error! usuario o contraseña incorrectos'); location.href = '../index.php';
        </script>";
        }//==> fin if

    }//==> fin funcion login

/************************************
* Agregar  usuario
************************************/

    public function usuarioAdd($Conxion,$_serialice){
        //print_r($_serialice);
        //echo "-----------";

        //$Con = La conexion que se tiene en la base de datos y lo
        //contiene la clase CapaDatos/Conexion.php.
        $sql = InsertQuery('tbl_usuarios', $_serialice);

        //echo "es sql ".$sql;
        //print_r($arrSQL);
        $result_consulta=mysqli_query($Conxion,$sql);
        if($result_consulta){
        //echo 'Se guardo con éxito el registro';
        //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

            //return true;
            echo 'true';
        }
        else {
        die("Fallo la consulta. ".mysqli_error());
        return false;
        }



    }//==> fin add usuario

/************************************
* Agregar  update
************************************/

    public function usuarioUpd($Conxion,$_serialice,$_ID){

        $sql = UpdateQuery('tbl_usuarios', $_serialice, "idRow = $_ID");

        //echo "es sql ".$sql;
        //print_r($arrSQL);
        $result_consulta=mysqli_query($Conxion,$sql);
        if($result_consulta){
        //echo 'Se guardo con éxito el registro';
        //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

            //return true;
            echo 'true';
        }
        else {
        die("Fallo la consulta. ".mysqli_error());
        return false;
        }



    }//==> fin actualizar usuario

/************************************
* Agregar  borrar
************************************/

    public function usuarioDel($Conxion,$_ID){


        $_serialice["eliminado"] = true;

        $sql = UpdateQuery('tbl_usuarios', $_serialice, "idRow = $_ID");

        //echo "es sql ".$sql;
        //print_r($arrSQL);
        $result_consulta=mysqli_query($Conxion,$sql);
        if($result_consulta){
        //echo 'Se guardo con éxito el registro';
        //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

            //return true;
            echo 'true';
        }
        else {
        die("Fallo la consulta. ".mysqli_error());
        return false;
        }



    }//==> fin borrar usuario



/************************************
* Agregar  Area
************************************/

    public function areaAdd($Conxion,$_serialice){
        //print_r($_serialice);
        //echo "-----------";

        //$Con = La conexion que se tiene en la base de datos y lo
        //contiene la clase CapaDatos/Conexion.php.
        $sql = InsertQuery('tbl_areas', $_serialice);

        //echo "es sql ".$sql;
        //print_r($arrSQL);
        $result_consulta=mysqli_query($Conxion,$sql);
        if($result_consulta){
        //echo 'Se guardo con éxito el registro';
        //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

            //return true;
            echo 'true';
        }
        else {
        die("Fallo la consulta. ".mysqli_error());
        return false;
        }



    }//==> fin add Area


/************************************
* Agregar  update
************************************/

    public function areasUpd($Conxion,$_serialice,$_ID){

        $sql = UpdateQuery('tbl_areas', $_serialice, "idRow = $_ID");

        //echo "es sql ".$sql;
        //print_r($arrSQL);
        $result_consulta=mysqli_query($Conxion,$sql);
        if($result_consulta){
        //echo 'Se guardo con éxito el registro';
        //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

            //return true;
            echo 'true';
        }
        else {
        die("Fallo la consulta. ".mysqli_error());
        return false;
        }



    }//==> fin actualizar areas

    /************************************
    * Agregar  borrar
    ************************************/

        public function areaDel($Conxion,$_ID){


            $_serialice["eliminado"] = true;

            $sql = UpdateQuery('tbl_areas', $_serialice, "idRow = $_ID");

            //echo "es sql ".$sql;
            //print_r($arrSQL);
            $result_consulta=mysqli_query($Conxion,$sql);
            if($result_consulta){
            //echo 'Se guardo con éxito el registro';
            //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

                //return true;
                echo 'true';
            }
            else {
            die("Fallo la consulta. ".mysqli_error());
            return false;
            }



        }//==> fin borrar usuario


/************************************
* Agregar  Material
************************************/

    public function materialAdd($Conxion,$_serialice){
        //print_r($_serialice);
        //echo "-----------";

        //$Con = La conexion que se tiene en la base de datos y lo
        //contiene la clase CapaDatos/Conexion.php.
        unset($_serialice['documento_filesystem']);//remueve elemento
        unset($_serialice['dato']);//remueve elemento
        $sql = InsertQuery('tbl_materiales', $_serialice);

        //echo "es sql ".$sql;
        //print_r($arrSQL);
        $result_consulta=mysqli_query($Conxion,$sql);
        if($result_consulta){
        //echo 'Se guardo con éxito el registro';
        //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

            //return true;
            echo 'true';
        }
        else {
        die("Fallo la consulta. ".mysqli_error());
        return false;
        }



    }//==> fin add Area


/************************************
* Agregar  update
************************************/

    public function materiaUpd($Conxion,$_serialice,$_ID){

        unset($_serialice['documento_filesystem']);//remueve elemento
        unset($_serialice['dato']);//remueve elemento
        unset($_serialice['Cambio']);//remueve elemento
        $sql = UpdateQuery('tbl_materiales', $_serialice, "idRow = $_ID");

        //echo "es sql ".$sql;
        //print_r($arrSQL);
        $result_consulta=mysqli_query($Conxion,$sql);
        if($result_consulta){
        //echo 'Se guardo con éxito el registro';
        //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

            //return true;
            echo 'true';
        }
        else {
        die("Fallo la consulta. ".mysqli_error());
        return false;
        }



    }//==> fin actualizar Material


/************************************
* Agregar  borrar
************************************/

    public function materialDel($Conxion,$_ID){


        $_serialice["eliminado"] = true;

        $sql = UpdateQuery('tbl_materiales', $_serialice, "idRow = $_ID");

        //echo "es sql ".$sql;
        //print_r($arrSQL);
        $result_consulta=mysqli_query($Conxion,$sql);
        if($result_consulta){
        //echo 'Se guardo con éxito el registro';
        //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

            //return true;
            echo 'true';
        }
        else {
        die("Fallo la consulta. ".mysqli_error());
        return false;
        }



    }//==> fin borrar material

    /************************************
    * Agregar  esp_fis  esp_fisUpd
    ************************************/

        public function esp_fisAdd($Conxion,$_serialice){
            //print_r($_serialice);
            //echo "-----------";

            //$Con = La conexion que se tiene en la base de datos y lo
            //contiene la clase CapaDatos/Conexion.php.
            $sql = InsertQuery('tbl_espacios_fisicos', $_serialice);

            //echo "es sql ".$sql;
            //print_r($arrSQL);
            $result_consulta=mysqli_query($Conxion,$sql);
            if($result_consulta){
            //echo 'Se guardo con éxito el registro';
            //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

                //return true;
                echo 'true';
            }
            else {
            die("Fallo la consulta. ".mysqli_error());
            return false;
            }



        }//==> fin add espacio fisico


        public function esp_fisUpd($Conxion,$_serialice,$_ID){

            $sql = UpdateQuery('tbl_espacios_fisicos', $_serialice, "idRow = $_ID");

            //echo "es sql ".$sql;
            //print_r($arrSQL);
            $result_consulta=mysqli_query($Conxion,$sql);
            if($result_consulta){
            //echo 'Se guardo con éxito el registro';
            //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

                //return true;
                echo 'true';
            }
            else {
            die("Fallo la consulta. ".mysqli_error());
            return false;
            }



        }//==> fin actualizar espacios fisicos
        /************************************
        * Agregar  borrar
        ************************************/

            public function esp_fisDel($Conxion,$_ID){


                $_serialice["eliminado"] = true;

                $sql = UpdateQuery('tbl_espacios_fisicos', $_serialice, "idRow = $_ID");

                //echo "es sql ".$sql;
                //print_r($arrSQL);
                $result_consulta=mysqli_query($Conxion,$sql);
                if($result_consulta){
                //echo 'Se guardo con éxito el registro';
                //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

                    //return true;
                    echo 'true';
                }
                else {
                die("Fallo la consulta. ".mysqli_error());
                return false;
                }



            }//==> fin borrar espacios fisicos
            /************************************
            * Agregar  Evento con detalle
            ************************************/

                public function eventoAdd($Conxion,$_serialice){

              // Recibimos el fecha de inicio y la fecha final desde el form
                  $inicio = _formatear($_serialice['from']);
                  // y la formateamos con la funcion _formatear

                  $final  = _formatear($_serialice['to']);

                  // Recibimos el fecha de inicio y la fecha final desde el form

                  $inicio_normal = $_serialice['from'];

                  // y la formateamos con la funcion _formatear
                  $final_normal  = $_serialice['to'];

                  //==> decidimos si tiene peticion

                  $arrEventos = array(
                    "title" => $_serialice["title"],
                    "body" => $_serialice["event"],

                    "class" => $_serialice["class"],
                    "start" => $inicio,
                    "end" => $final,
                    "numero_personas" => $_serialice["numero_personas"],
                    "usuarios_id" =>$_SESSION["id"],

                    "status_id" => 1,
                    "inicio_normal" =>  $inicio_normal,
                    "final_normal" => $final_normal

                );
                    //print_r($_serialice);
                    //echo "-----------";

                    //$Con = La conexion que se tiene en la base de datos y lo
                    //contiene la clase CapaDatos/Conexion.php.
                    $sql = InsertQuery('tbl_eventos', $arrEventos);

                    //echo "es sql ".$sql;
                    //print_r($arrSQL);
                    $result_consulta=mysqli_query($Conxion,$sql);
                    if(!$result_consulta){
                    //echo 'Se guardo con éxito el registro';
                    //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

                        //return true;
                        //echo 'true';
                        die("Fallo la consulta. ".mysqli_error());
                        return false;
                    }
                    /*else {
                    die("Fallo la consulta. ".mysqli_error());
                    return false;
                  }*/

                  //==> obtener el proximo ID

                  $resultN = mysqli_query($Conxion,"SELECT MAX(id) AS id FROM tbl_eventos");
                  if ($row = mysqli_fetch_array($resultN)) {
                    $id = trim($row[0]);
                  }

                  // para generar el link del evento y actualizar la peticion
                  $link = "descripcion_evento.php?id=$id";

                  //==> Tiene peticion
                  if ($_serialice["tiene_peticion"] == '1') {
                  $tiene_peticion = 1;

                  $arrPeticio = array(
                    "descripcion" => $_serialice["descripcion"],
                    "eventos_id" => $id,
                    "peticion_status" => 1
                );
                        $sql = InsertQuery('tbl_peticiones', $arrPeticio);

                        //echo "es sql ".$sql;
                        //print_r($arrSQL);
                        $result_consulta=mysqli_query($Conxion,$sql);
                        if(!$result_consulta){
                        //echo 'Se guardo con éxito el registro';
                        //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

                            //return true;
                            //echo 'true';
                            die("Fallo la consulta. ".mysqli_error());
                            return false;
                        }
                  }
                  else {
                    $tiene_peticion = 0;
                  }

                  //$_serialiceX["url"] = $link;

                  //$sql = UpdateQuery('tbl_eventos', $_serialiceX, "id = $id");


                  $sql="UPDATE tbl_eventos SET url = '$link', tiene_peticion = $tiene_peticion WHERE id = $id";
                  //echo "es sql ".$sql;
                  //print_r($arrSQL);
                  $result_consulta=mysqli_query($Conxion,$sql);
                  if(!$result_consulta){
                  //echo 'Se guardo con éxito el registro';
                  //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

                      //return true;
                      //echo 'true';
                      die("Fallo la consulta. ".mysqli_error());
                      return false;
                  }
                /*  else {

                }*/

                //=====> Guardar detalle
                //$arritems = $_serialice["moredata1"];//==> id de materiales
                $arritems = explode(",",$_serialice["moredata1"]);//==> id de materiales
                $arrCanti = $_serialice["moredata2"];//==> Arr de las caantidades
                $pCount = 0;
          				foreach ( $arritems as $idsItems) {
          						$arrSQL2["eventos_id"] = $id;
          						$arrSQL2["espacios_fisicos_id"] = $_serialice["espacios_fisicos_id"];
          						$arrSQL2["materiales_id"] = $idsItems;

                      $sql = InsertQuery('tbl_evento_detalle', $arrSQL2);

                      //echo "es sql ".$sql;
                      //print_r($arrSQL2);
                      $result_consulta=mysqli_query($Conxion,$sql);
                      if(!$result_consulta){
                      //echo 'Se guardo con éxito el registro';
                      //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

                          //return true;
                          //echo 'true';
                          die("Fallo la consulta. ".mysqli_error());
                          return false;
                      }


          					//$pCount++;
          				}//==> fin item arr

//=====================================
//==> obtener los correos
$resultN = mysqli_query($Conxion,"SELECT * FROM vw_sentCorreoUsuarioReserva
                                  WHERE eventos_id = $id");
/*WHERE eventos_id = $id");*/
if ($row = mysqli_fetch_array($resultN)) {
  $Correo  = trim($row[0]);
  $Usuario = trim($row[1]);
  $Nombre  = trim($row[2]);
  $app     = trim($row[3]);
  $apm     = trim($row[4]);
}
//== Obtiene administrador
$resultN = mysqli_query($Conxion,"SELECT correo FROM tbl_usuarios
                                   WHERE idRow = 1");
if ($row = mysqli_fetch_array($resultN)) {
  $CorreoAdmin = trim($row[0]);
}

//== Obtiene nombre de espacio fisico
$resultN = mysqli_query($Conxion,"SELECT nombre FROM tbl_espacios_fisicos WHERE idRow =".$_serialice["espacios_fisicos_id"]);
if ($row = mysqli_fetch_array($resultN)) {
  $NombreEspac = trim($row[0]);
}

$Correo .= ', '.$CorreoAdmin;
//echo $Correo;
//$Correo .=

//$mail = "Prueba de mensaje";
$mail = '
<html lang="es">
<head>
<meta charset="utf-8">
  <title>Correo de reservacion de areas</title>
</head>
<body>
  <p>¡Se reservo un espacio fisico!</p>
  <table>
    <tr>
      <th>Titulo reservacion</th><th>Espacio fisico</th><th>#Personas</th><th>Fecha/hora</th>
    </tr>
    <tr>
    <td>'.$_serialice["title"].'</td><td> '.$NombreEspac.' </td><td>'.$_serialice["numero_personas"].'</td><td>'.$inicio_normal.' -A-'.$final_normal.' </td>
    </tr>
  </table>
  <p>El personal que reservo es:'.$Nombre.' '.$app.' '.$apm.' </p>
  <p>Con usuario: '.$Usuario.' </p>
</body>
</html>
';
//<td>'.$_serialice["title"].'</td><td> '.$NombreEspac.' </td><td>'.$_serialice["numero_personas"].'</td><td>'.$inicio_normal.' -A-'.$final_normal.' </td>

//Titulo
$titulo = "Correo de reservacion de areas";
//cabecera
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
//dirección del remitente
$headers .= "From: Sistema de agendacion de espacios fisicos < su correo > \r\n";
//Enviamos el mensaje a tu_dirección_email
$bool = mail($Correo,$titulo,$mail,$headers);
if($bool){
    //echo "Mensaje enviado";
      echo 'true';
}else{
  /*Para Pruebas*/
    //echo "Mensaje no enviado que paso boll: ".$bool." Cor ".$Correo." titu ".$titulo." ml ".$mail." ".$headers;
      echo 'true';
}
//=====================================
                  //  echo 'true';
                }//==> fin add evento

/**
 * actualiza peticion
 */

 public function PeticionUpd($Conxion,$_serialice,$_ID){

     $sql = UpdateQuery('tbl_peticiones', $_serialice, "idRow = $_ID");

     //echo "es sql ".$sql;
   //print_r($arrSQL);
     $result_consulta=mysqli_query($Conxion,$sql);
     if($result_consulta){
     //echo 'Se guardo con éxito el registro';
     //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

         //return true;
         echo 'true';
     }
     else {
     die("Fallo la consulta. ".mysqli_error());
     return false;
     }



 }//==> fin actualizar peticion

 /**
  * actualiza evento
  */

  public function eventoUpd($Conxion,$_serialice,$_ID){

// Recibimos el fecha de inicio y la fecha final desde el form
  $inicio = _formatear($_serialice['from']);
  // y la formateamos con la funcion _formatear

  $final  = _formatear($_serialice['to']);

  // Recibimos el fecha de inicio y la fecha final desde el form

  $inicio_normal = $_serialice['from'];

  // y la formateamos con la funcion _formatear
  $final_normal  = $_serialice['to'];

  //==> decidimos si tiene peticion

  $arrEventos = array(
    "title" => $_serialice["title"],
    "body" => $_serialice["event"],

    "class" => $_serialice["class"],
    "start" => $inicio,
    "end" => $final,
    "numero_personas" => $_serialice["numero_personas"],

    "inicio_normal" =>  $inicio_normal,
    "final_normal" => $final_normal

);

      $sql = UpdateQuery('tbl_eventos', $arrEventos, "id = $_ID");

      //echo "es sql ".$sql;
      //print_r($arrSQL);
      $result_consulta=mysqli_query($Conxion,$sql);
      if(!$result_consulta){
      //echo 'Se guardo con éxito el registro';
      //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

          //return true;
          die("actualiza evento Fallo la consulta. ".mysqli_error());
          return false;
      }

      //==> Tiene peticion
      if ($_serialice["tiene_peticion"] == '1') {

      //==> no existe una peticion
      if ($_serialice["peticiones_ids"] == '0') {
      //==> inserta una nueva peticion
      $arrPeticio = array(
        "descripcion" => $_serialice["descripcion"],
        "eventos_id" => $_ID,
        "peticion_status" => 1
    );
            $sql = InsertQuery('tbl_peticiones', $arrPeticio);

            //echo "es sql ".$sql;
            //print_r($arrSQL);
            $result_consulta=mysqli_query($Conxion,$sql);
            if(!$result_consulta){
            //echo 'Se guardo con éxito el registro';
            //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

                //return true;
                //echo 'true';
                die(" registrando peticion Fallo la consulta. ".mysqli_error());
                return false;
            }
//========================= fin nueva peticion ======================================================
      } else {
        //==> ya existe una peticion
        $idPeti = $_serialice["peticiones_ids"];
        $arrPeticio = array(
          "descripcion" => $_serialice["descripcion"],
          "peticion_status" => 1
        );
              $sql = UpdateQuery('tbl_peticiones', $arrPeticio, "idRow = $idPeti");

              //echo "es sql ".$sql;
              //print_r($arrSQL);
              $result_consulta=mysqli_query($Conxion,$sql);
              if(!$result_consulta){
              //echo 'Se guardo con éxito el registro';
              //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

                  //return true;
                  //echo 'true';
                  die("actualizando peticion Fallo la consulta. ".mysqli_error());
                  return false;
              }
//========================= fin actualiza peticion ======================================================
      }//==> fin if actualiza o inserta peticion
}//===> fin if tiene peticion
//========================= actualiza detalle ======================================================
//=====> Guardar detalle
//$arritems = $_serialice["moredata1"];//==> id de materiales
//==> obtener id materiales
$arrNuevos = explode(",",$_serialice["moredata1"]);//==> id de materiales

/*actualmente almacenados en la base de datos*/
$resultN = mysqli_query($Conxion,"SELECT GROUP_CONCAT(materiales_id ) as materiales_id from tbl_evento_detalle WHERE eventos_id = $_ID");
if ($row = mysqli_fetch_array($resultN)) {
  $materiales_id = trim($row[0]);
}
$arrActuales = explode(",", $materiales_id );

//==> agrega al array

$arrDataAgregar = array_diff($arrNuevos, $arrActuales);

/*detectados a marcar como eliminados en la base de datos*/
$DataBorrarID = implode(",", array_diff($arrActuales, $arrNuevos));

$pCountS = 0;
//$arrDataPuestos = array();
foreach($arrDataAgregar AS $dataID){
  $arrDataNuevosID[$pCountS] = array();
  $arrDataNuevosID[$pCountS]["eventos_id"] = $_ID;
  $arrDataNuevosID[$pCountS]["espacios_fisicos_id"] = $_serialice["espacios_fisicos_id"];
  $arrDataNuevosID[$pCountS]["materiales_id"] = $dataID;
  $pCountS++;
}

//echo "id a borrar ".$DataBorrarID;
/*Relacion de material con evento*/
if($DataBorrarID != ""){
$sql = "UPDATE tbl_evento_detalle
              SET eliminado = 1
              WHERE eventos_id = $_ID
                    AND materiales_id  IN(". $DataBorrarID. ")";

//echo "es sql ".$sql;
//print_r($arrSQL);
    $result_consulta=mysqli_query($Conxion,$sql);
    if(!$result_consulta){
    //echo 'Se guardo con éxito el registro';
    //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

        //return true;
        //echo 'true';
        die("borrar Fallo la consulta. ".mysqli_error());
        return false;
    }
}//fin borrarIDs

if(count($arrDataAgregar) != 0){
  foreach($arrDataNuevosID AS $arrData){
     if ($arrData["materiales_id"] != '') {
       $sql = InsertQuery('tbl_evento_detalle', $arrData);
       //echo $sql;
        $result_consulta=mysqli_query($Conxion,$sql);
         if(!$result_consulta){
             die("detalle material Fallo la consulta. ".mysqli_error());
             return false;
         }
     }

  }// fin foreach
}//fin if agregar almacenes
/*****/

//echo $materiales_id;
/*$arrCanti = $_serialice["moredata2"];//==> Arr de las caantidades
$pCount = 0;
  foreach ( $arritems as $idsItems) {
      $arrSQL2["eventos_id"] = $id;
      $arrSQL2["espacios_fisicos_id"] = $_serialice["espacios_fisicos_id"];
      $arrSQL2["materiales_id"] = $idsItems;

      $sql = InsertQuery('tbl_evento_detalle', $arrSQL2);

      //echo "es sql ".$sql;
      //print_r($arrSQL2);
      $result_consulta=mysqli_query($Conxion,$sql);
      if(!$result_consulta){
      //echo 'Se guardo con éxito el registro';
      //echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = 'addUsuario.php';</script>";

          //return true;
          //echo 'true';
          die("Fallo la consulta. ".mysqli_error());
          return false;
      }


    //$pCount++;
  }//==> fin detalle */


echo 'true';
  }//==> fin actualizar evento

}//=> fin clase srAgenda

?>
