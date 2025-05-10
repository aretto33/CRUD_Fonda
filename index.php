
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Fonda"Doña Lucha" - Inicio</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color:#f4f3ec;
            text-align: center;
            padding: 50px;
        }

        h1 {
            color:rgb(75, 81, 132);
            font-size: 3em;
        }

        .menu {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .menu a {
            text-decoration: none;
            background-color:rgb(54, 68, 139);
            color: white;
            padding: 15px 30px;
            border-radius: 15px;
            font-size: 1.2em;
            transition: background-color 0.3s ease;
        }

        .menu a:hover {
            background-color:rgb(42, 62, 117);

        }
        .banner {
            background-image: url('fonda_CRUD.png'); /* Ruta a tu imagen */
            background-size: cover; /* Ajusta la imagen al tamaño del contenedor */
            background-position: center; /* Centra la imagen */
            height: 350px; /* Ajusta la altura según tus necesidades */
            margin-bottom: 30px; /* Espacio debajo del banner */
        }
    </style>
</head>
<body>
    <div class="banner"></div> <!-- Aquí se inserta el banner -->

    <h1>Gestion de datos de la Fonda "Doña Lucha"</h1>
    <p>Selecciona una opción para administrar los datos:</p>

    <div class="menu">
        <a href="Proveedor/index_proveedore.php">Gestionar Trabajadores</a>
        <a href="Productos/index_productos.php">Gestionar Productos</a>
        <a href="Clientes/index_clientes.php">Gestionar Clientes</a>
        <a href="ventas.php">Gestionar Ventas</a>
        <a href="detalle_venta.php">Gestionar Detalles de Venta</a>
    </div>

</body>
</html>
