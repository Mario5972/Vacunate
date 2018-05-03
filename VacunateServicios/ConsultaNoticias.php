<?php

$hostname = "localhost";
$database = "vacunate";
$database_user = "root";
$database_passwd = "M@rio160114";

$json = array();

if (isset($_GET["id_usuario"])) {
    $id_usuario = $_GET["id_usuario"];
    $conexion = mysqli_connect($hostname, $database_user, $database_passwd, $database);

    if ($conexion) {
        $consulta="SELECT * FROM noticias";
        $resultado=mysqli_query($conexion, $consulta);

        while($registro=mysqli_fetch_assoc($resultado)) {
							$json['noticias'][]=$registro;
        }
        mysqli_close($conexion);
        echo json_encode($json, JSON_PRETTY_PRINT);
    } else {
        $resulta["documento"]=0;
        $resulta["nombre"]='No Registra';
        $resulta["profesion"]='No Registra';
        $json['usuario'][]=$resulta;
        echo json_encode($json);
    }
} else {
    $resulta["documento"]=0;
    $resulta["nombre"]='WS No retorna';
    $resulta["profesion"]='WS No retorna';
    $json['usuario'][]=$resulta;
    echo json_encode($json);
}
