<?php
include 'conexion.php';

// Obtener el ID del cliente que se va a actualizar
if (isset($_GET['updateid'])) {
    $updateid = $_GET['updateid'];

    // Obtener los datos actuales del Proveedor
    $sql = "SELECT * FROM Proveedores WHERE PK_Proveedor = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $updateid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    // Actualizar la información del Proveedor
    $Nombre = $_POST['Nombre'];
    $Telefono = $_POST['Telefono'];
    $Correo = $_POST['Correo'];
    $Direccion_local = $_POST['Direccion'];

    // Consulta para actualizar los datos
    $sql = "UPDATE Proveedores SET Nombre = ?, Telefono = ?, Correo = ?, Direccion_local = ? WHERE PK_Proveedor = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssi", $Nombre, $Telefono, $Correo, $Direccion_local, $updateid);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>Cliente actualizado exitosamente!</div>";
    } else {
        die("<div class='alert alert-danger'>Error al actualizar: " . $stmt->error . "</div>");
    }
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actualizar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c983c732cd.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: rgb(242, 214, 255); /* azul claro */
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        .form-group label {
            font-weight: bold;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #0056b3;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 form-container">
            <h2><i class="fas fa-user-edit"></i> Actualizar Cliente</h2>
            <form method="POST">
                <div class="form-group mb-3">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="Nombre" value="<?php echo $row['Nombre']; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label>Teléfono</label>
                    <input type="text" class="form-control" name="Telefono" value="<?php echo $row['Telefono']; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label>Correo</label>
                    <input type="email" class="form-control" name="Correo" value="<?php echo $row['Correo']; ?>" required>
                </div>
                <div class="form-group mb-4">
                    <label>Dirección</label>
                    <textarea class="form-control" name="Direccion" rows="3" required><?php echo $row['Direccion_local']; ?></textarea>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="update">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
