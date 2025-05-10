<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'conexion.php';

if (isset($_POST['submit'])) {
    $Nombre = $_POST['Nombre'] ?? '';
    $Apellido_Pat = $_POST['Apellido_Pat'] ?? '';
    $Apellido_Mat = $_POST['Apellido_Mat'] ?? '';

    if (!empty($Nombre) && !empty($Apellido_Pat) && !empty($Apellido_Mat)) {
        $stmt = $con->prepare("INSERT INTO Clientes (Nombre, Apellido_Pat, Apellido_Mat) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Error en prepare: " . $con->error);
        }

        $stmt->bind_param("sss", $Nombre, $Apellido_Pat, $Apellido_Mat);

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
    <title>Clientes</title>
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
        <img src="1.png" alt="Header Image" class="img-fluid">
    </div>
    <button class="btn btn-primary mb-3" onclick="window.location.href='http://localhost/Avance_CRUD/index.php'">Inicio</button>

    <!-------------------- Formulario -------------------->
    <form method="post" class="form-container">
        <h2>Registro de Clientes</h2>

        <div class="mb-3">
            <label for="Nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="Nombre" name="Nombre" required>
        </div>
        <div class="mb-3">
            <label for="Apellido_Pat" class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" id="Apellido_Pat" name="Apellido_Pat" required>
        </div>
        <div class="mb-3">
            <label for="Apellido_Mat" class="form-label">Apellido Materno</label>
            <input type="text" class="form-control" id="Apellido_Mat" name="Apellido_Mat" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Guardar</button>
    </form>

    <!-------------------- Tabla -------------------->
    <h3 class="mt-5">Lista de Clientes</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM Clientes";
            $result = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                    <td>' . $row['PK_Cliente'] . '</td>
                    <td>' . $row['Nombre'] . '</td>
                    <td>' . $row['Apellido_Pat'] . '</td>
                    <td>' . $row['Apellido_Mat'] . '</td>
                    <td>
                        <a href="Update_clientes.php?updateid=' . $row['PK_Cliente'] . '" class="btn btn-warning btn-sm"><i class="fa-solid fa-user-pen"></i></a>
                        <a href="Delete_clientes.php?deleteid=' . $row['PK_Cliente'] . '" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
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
