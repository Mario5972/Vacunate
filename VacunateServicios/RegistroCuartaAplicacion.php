<?php

$hostname = "localhost";
$database = "vacunate";
$database_user = "root";
$database_passwd = "M@rio160114";

$json = array();

if (isset($_GET["id_vacuna"]) && isset($_GET["id_cartilla"])
&& isset($_GET["aplicacion"]) && isset($_GET["fecha_aplicacion"])) {

    $id_vacuna = $_GET["id_vacuna"];
    $id_cartilla = $_GET["id_cartilla"];
    $aplicacion = $_GET["aplicacion"];
    $fecha_aplicacion = $_GET["fecha_aplicacion"];

    $conexion = mysqli_connect($hostname, $database_user, $database_passwd, $database);

  $insert="INSERT INTO cuarta_aplicacion(id_vacuna, id_cartilla, aplicacion, fecha_aplicacion) VALUES ('{$id_vacuna}','{$id_cartilla}','{$aplicacion}','{$fecha_aplicacion}')";
  $resultado_insert=mysqli_query($conexion,$insert);

  if($resultado_insert){
    $consulta="SELECT LAST_INSERT_ID() FROM segunda_aplicacion";
    $resultado=mysqli_query($conexion,$consulta);

    if($registro=mysqli_fetch_assoc($resultado)){
      $json['cuarta_aplicacion'][]=$registro;
    }
    mysqli_close($conexion);
    echo json_encode($json, JSON_PRETTY_PRINT);
  }
  else{
    $resulta["documento"]=0;
    $resulta["nombre"]='No Registra';
    $resulta["profesion"]='No Registra';
    $json['usuario'][]=$resulta;
    echo json_encode($json, JSON_PRETTY_PRINT);
  }

}
else{
    $resulta["documento"]=0;
    $resulta["nombre"]='WS No retorna';
    $resulta["profesion"]='WS No retorna';
    $json['usuario'][]=$resulta;
    echo json_encode($json, JSON_PRETTY_PRINT);
  }
