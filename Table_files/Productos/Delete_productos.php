<?php
include 'conexion.php';

if (isset($_GET['deleteid'])) {
    // Sanitizar el ID recibido
    $ID = intval($_GET['deleteid']);

    // Construir la consulta SQL para eliminar el registro
    $sql = "DELETE FROM Productos WHERE PK_Producto = $ID";

    // Ejecutar la consulta
    $result = mysqli_query($con, $sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
        echo "<script>alert('Registro eliminado exitosamente');</script>";
        echo "<script>window.location = 'index_productos.php';</script>"; // Redirigir de vuelta a index.php
    } else {
        die("Error al eliminar el registro: " . mysqli_error($con));
    }
}
?>

