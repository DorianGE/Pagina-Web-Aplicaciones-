<?php
session_start();
include('Conexion.php');

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    exit("No autorizado");
}

$nombre = $_POST['nombre'];
$precio = $_POST['precio'];

// Guardar imagen
$imagen = $_FILES['imagen']['name'];
$tmp = $_FILES['imagen']['tmp_name'];
move_uploaded_file($tmp, "../Imagenes/".$imagen);

// Insertar en BD
$sql = "INSERT INTO productos (Nombre, Precio, Imagen) VALUES (?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->execute([$nombre, $precio, $imagen]);

header("Location: admin.php");
?>
