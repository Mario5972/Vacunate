<?php

$hostname = "localhost";
$database = "vacunate";
$database_user = "root";
$database_passwd = "M@rio160114";

$json = array();

if (isset($_GET["lat_usuario"])
&& isset($_GET["long_usuario"]) && isset($_GET["rango"])) {
    $lat_usuario = $_GET["lat_usuario"];
    $long_usuario = $_GET["long_usuario"];
		$rango = $_GET['rango'];
    $conexion = mysqli_connect($hostname, $database_user, $database_passwd, $database);

    if ($conexion) {
        $consulta="SELECT * FROM centro_salud";
        $resultado=mysqli_query($conexion, $consulta);

        while($registro=mysqli_fetch_assoc($resultado)) {
            //$json['centro_salud'][]=$registro;
						$distance = distanceCalculation($lat_usuario, $long_usuario,$registro['latitud'] , $registro['longitud'], 'km', 4);
						//echo "La distancia es: ".$distance."\n";
						if($distance < $rango){
							$json['centro_salud'][]=$registro;
						}
        }
        mysqli_close($conexion);
				//var_dump($json);
        echo json_encode($json,JSON_PRETTY_PRINT|JSON_PARTIAL_OUTPUT_ON_ERROR);
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


    function harvestine($lat1, $long1, $lat2, $long2)
    {
        //Distancia en kilometros en 1 grado distancia.
        //Distancia en millas nauticas en 1 grado distancia: $mn = 60.098;
        //Distancia en millas en 1 grado distancia: 69.174;
        //Solo aplicable a la tierra, es decir es una constante que cambiaria en la luna, marte... etc.
        $km = 111.302;

        //1 Grado = 0.01745329 Radianes
        $degtorad = 0.01745329;

        //1 Radian = 57.29577951 Grados
        $radtodeg = 57.29577951;
        //La formula que calcula la distancia en grados en una esfera, llamada formula de Harvestine. Para mas informacion hay que mirar en Wikipedia
        //http://es.wikipedia.org/wiki/F%C3%B3rmula_del_Haversine
        $dlong = ($long1 - $long2);
        $dvalue = (sin($lat1 * $degtorad) * sin($lat2 * $degtorad)) + (cos($lat1 * $degtorad) * cos($lat2 * $degtorad) * cos($dlong * $degtorad));
        $dd = acos($dvalue) * $radtodeg;
        return round(($dd * $km), 4);
    }

		function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2)
		{
		    // Cálculo de la distancia en grados
		    $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));

		    // Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
		    switch ($unit) {
		        case 'km':
		            $distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
		            break;
		        case 'mi':
		            $distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
		            break;
		        case 'nmi':
		            $distance =  $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
		    }
		    return round($distance, $decimals);
		}
