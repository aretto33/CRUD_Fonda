<?php
$con = new mysqli('localhost', 'root', '', 'Papeleria_Kawaii');

if ($con) {
    echo"Conexión exitosa";
} else {
    die(mysqli_error($con));
}
return $con;
?>