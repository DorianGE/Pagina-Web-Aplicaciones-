<?php
session_start();
include('Conexion.php');

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    exit("No autorizado");
}

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];

// Si sube imagen nueva
if(!empty($_FILES['imagen']['name'])){
    $imagen = $_FILES['imagen']['name'];
    $tmp = $_FILES['imagen']['tmp_name'];
    move_uploaded_file($tmp, "../Imagenes/".$imagen);
    $sql = "UPDATE productos SET Nombre = ?, Precio = ?, Imagen = ? WHERE Id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$nombre, $precio, $imagen, $id]);
} else {
    $sql = "UPDATE productos SET Nombre = ?, Precio = ? WHERE Id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$nombre, $precio, $id]);
}

header("Location: admin.php");
?>
