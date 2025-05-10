<?php
// Activamos errores para verlos en pantalla
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
include 'conexion.php';

if (isset($_POST['submit'])) {
    // Recibimos los datos del formulario
    $Nombre = $_POST['Nombre'] ?? '';
    $Telefono = $_POST['Telefono'] ?? '';
    $Correo = $_POST['Correo'] ?? '';
    $Direccion_local = $_POST['Direccion_local'] ?? '';

    // Validamos que los campos no estén vacíos
    if (!empty($Nombre) && !empty($Telefono) && !empty($Correo) && !empty($Direccion_local)) {
        // Insertamos usando consulta preparada
        $stmt = $con->prepare("INSERT INTO Proveedores (Nombre, Telefono, Correo, Direccion_local) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die("Error en prepare: " . $con->error);
        }

        $stmt->bind_param("ssss", $Nombre, $Telefono, $Correo, $Direccion_local);

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
    <title>Proveedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c983c732cd.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: rgb(238, 224, 229);
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(113, 92, 77, 0.1);
            margin-top: 50px;
        }
        h2, h3 {
            color: rgb(142, 113, 90);
            text-align: center;
        }
        button[type="submit"], .btn-primary {
            background-color: rgb(143, 118, 128);
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="text-center mb-4">
        <img src="Proveedor_banner.png" alt="Header Image" class="img-fluid">
    </div>
    <button class="btn btn-primary" background-color = "rgb(143, 118, 128)" onclick="window.location.href='http://localhost/Avance_CRUD/index.php'">Inicio</button>

    <!-------------------- Formulario -------------------->
    <form method="post" class="form-container">
        <h2>Registro de Proveedores</h2>

        <div class="mb-3">
            <label for="Nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="Nombre" name="Nombre" required>
        </div>
        <div class="mb-3">
            <label for="Correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="Correo" name="Correo" required>
        </div>
        <div class="mb-3">
            <label for="Telefono" class="form-label">Teléfono</label>
            <input type="number" class="form-control" id="Telefono" name="Telefono" required>
        </div>
        <div class="mb-3">
            <label for="Direccion_local" class="form-label">Dirección del local</label>
            <input type="text" class="form-control" id="Direccion_local" name="Direccion_local" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Guardar</button>
    </form>

    <!-------------------- Tabla -------------------->
    <h3>Lista de Proveedores</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Dirección del local</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM Proveedores";
            $result = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                    <td>' . $row['PK_Proveedor'] . '</td>
                    <td>' . $row['Nombre'] . '</td>
                    <td>' . $row['Telefono'] . '</td>
                    <td>' . $row['Correo'] . '</td>
                    <td>' . $row['Direccion_local'] . '</td>
                    <td>
                        <a href="Update_proveedor.php?updateid=' . $row['PK_Proveedor'] . '" class="btn btn-warning btn-sm"><i class="fa-solid fa-user-pen"></i></a>
                        <a href="Delete_proveedor.php?deleteid=' . $row['PK_Proveedor'] . '" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
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
