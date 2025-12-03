<?php
session_start();
include('Conexion.php');

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    exit("No autorizado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agregar Producto</title>
<link rel="stylesheet" href="../CSS/Estilo.css">
<link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>

<div class="form-container">
    <h2>Agregar Producto</h2>
    <form action="guardar_producto.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="nombre" placeholder="Nombre del producto" required>
        <input type="number" name="precio" placeholder="Precio MXN" required>
        <input type="text" name="imagen" placeholder="Ingrese el url de la imagen" required>
        <button type="submit">Guardar Producto</button>
    </form>
    <a href="admin.php">Volver al panel</a>
</div>

</body>
</html>
