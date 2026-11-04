<?php
//Modfificar la ruta de acceso para que en Nginx se conecte al otro servicio de base de datos
$con = new mysqli('localhost', 'root', '', 'Fonda');

if ($con) {
    echo"Conexión exitosa";
} else {
    die(mysqli_error($con));
}
return $con;
?>