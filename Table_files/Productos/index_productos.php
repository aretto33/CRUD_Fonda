<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'conexion.php';

if (isset($_POST['submit'])) {
    $PK_Producto = $_POST['PK_Producto'] ?? '';
    $Producto = $_POST['Producto'] ?? '';
    $Precio = $_POST['Precio'] ?? '';

    if (!empty($PK_Producto) && !empty($Producto) && !empty($Precio)) {
        $stmt = $con->prepare("INSERT INTO Productos (PK_Producto, Producto, Precio) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Error en prepare: " . $con->error);
        }

        $stmt->bind_param("sss", $PK_Producto, $Producto, $Precio);

        if ($stmt->execute()) {
            echo '<div class="alert alert-success">✅ Registro guardado exitosamente</div>';
        } else {
            echo '<div class="alert alert-danger">❌ Error al guardar: ' . $stmt->error . '</div>';
        }

        $stmt->close();
    } else {
        echo '<div class="alert alert-warning">⚠️ Todos los campos son obligatorios</div>';
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c983c732cd.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f4f3ec;
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(40, 44, 73, 0.1);
            margin-top: 50px;
        }
        h2, h3 {
            color: rgb(35, 41, 66);
            text-align: center;
        }
        button[type="submit"], .btn-primary {
            background-color: rgb(53, 61, 100);
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="text-center mb-4">
        <img src="3.png" alt="Header Image" class="img-fluid">
    </div>
    <button class="btn btn-primary mb-3" onclick="window.location.href='http://localhost/Avance_CRUD/index.php'">Inicio</button>

    <!-------------------- Formulario -------------------->
    <form method="post" class="form-container">
        <h2>Registro de Productos</h2>

        <div class="mb-3">
            <label for="PK_Producto" class="form-label">Clave del Producto</label>
            <input type="text" class="form-control" id="PK_Producto" name="PK_Producto" required>
        </div>
        <div class="mb-3">
            <label for="Producto" class="form-label">Producto</label>
            <input type="text" class="form-control" id="Producto" name="Producto" required>
        </div>
        <div class="mb-3">
            <label for="Precio" class="form-label">Precio</label>
            <input type="text" class="form-control" id="Precio" name="Precio" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Guardar</button>
    </form>

    <!-------------------- Tabla -------------------->
    <h3 class="mt-5">Lista de Productos</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM Productos";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                    <td>' . $row['PK_Producto'] . '</td>
                    <td>' . $row['Producto'] . '</td>
                    <td>' . $row['Precio'] . '</td>
                    <td>
                        <a href="Update_productos.php?updateid=' . $row['PK_Producto'] . '" class="btn btn-warning btn-sm"><i class="fa-solid fa-user-pen"></i></a>
                        <a href="Delete_productos.php?deleteid=' . $row['PK_Producto'] . '" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>';
            }            
            ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
