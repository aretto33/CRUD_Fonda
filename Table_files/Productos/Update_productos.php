<?php
include 'conexion.php';

// Obtener el ID del producto a actualizar
if (isset($_GET['updateid'])) {
    $updateid = $_GET['updateid'];

    // Obtener los datos actuales del producto
    $sql = "SELECT * FROM Productos WHERE PK_Producto = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $updateid); // tipo "s" porque es varchar
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    // Datos del formulario
    $Producto = $_POST['Producto'];
    $Precio = $_POST['Precio'];

    // Actualizar datos
    $sql = "UPDATE Productos SET Producto = ?, Precio = ? WHERE PK_Producto = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sds", $Producto, $Precio, $updateid);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>✅ Producto actualizado correctamente</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>❌ Error al actualizar: " . $stmt->error . "</div>";
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actualizar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c983c732cd.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: rgb(242, 214, 255);
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
        .btn-regresar {
            background-color: #6c757d;
            color: white;
        }
        .btn-regresar:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 form-container">
            <h2><i class="fas fa-box-open"></i> Actualizar Producto</h2>
            <form method="POST">
                <div class="form-group mb-3">
                    <label>Nombre del Producto</label>
                    <input type="text" class="form-control" name="Producto" value="<?php echo $row['Producto']; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label>Precio</label>
                    <input type="number" step="0.01" class="form-control" name="Precio" value="<?php echo $row['Precio']; ?>" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary" name="update">Actualizar</button>
                    <a href="index_productos.php" class="btn btn-regresar">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
