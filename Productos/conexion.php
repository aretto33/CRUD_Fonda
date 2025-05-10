<?php
$con = new mysqli('localhost', 'root', '', 'Fonda');

if ($con) {
    echo"Conexión exitosa";
} else {
    die(mysqli_error($con));
}
return $con;
?>