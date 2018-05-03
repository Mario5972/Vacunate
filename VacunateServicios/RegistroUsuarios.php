<?php

$hostname = "localhost";
$database = "vacunate";
$database_user = "root";
$database_passwd = "M@rio160114";

$json = array();

if (isset($_GET["nombre"])
&& isset($_GET["apellido_paterno"]) && isset($_GET["apellido_materno"])
&& isset($_GET["email"]) && isset($_GET["contrasena"])) {

    //$id_usuario = $_GET["id_usuario"];
    $nombre = $_GET["nombre"];
    $apellido_paterno = $_GET["apellido_paterno"];
    $apellido_materno = $_GET["apellido_materno"];
    $email = $_GET["email"];
    $contrasena = $_GET["contrasena"];

    $conexion = mysqli_connect($hostname, $database_user, $database_passwd, $database);

  $insert="INSERT INTO usuarios(nombre, apellido_paterno, apellido_materno, email, contrasena) VALUES ('{$nombre}','{$apellido_paterno}','{$apellido_materno}', '{$email}', SHA2('{$contrasena}', 256))";
  $resultado_insert=mysqli_query($conexion,$insert);

  if($resultado_insert){
    $consulta="SELECT * FROM usuarios WHERE id_usuario = LAST_INSERT_ID()";
    $resultado=mysqli_query($conexion,$consulta);

    if($registro=mysqli_fetch_assoc($resultado)){
      $json['usuario'][]=$registro;
    }
    mysqli_close($conexion);
    echo json_encode($json, JSON_PRETTY_PRINT);
  }
  else{
    $resulta["documento"]=0;
    $resulta["nombre"]='No Registra';
    $resulta["profesion"]='No Registra';
    $json['usuario'][]=$resulta;
    echo json_encode($json);
  }

}
else{
    $resulta["documento"]=0;
    $resulta["nombre"]='WS No retorna';
    $resulta["profesion"]='WS No retorna';
    $json['usuario'][]=$resulta;
    echo json_encode($json);
  }
