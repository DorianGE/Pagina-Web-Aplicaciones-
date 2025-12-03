<?php
session_start();
include('Conexion.php');

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    exit("No autorizado");
}

$id = $_GET['id'] ?? 0;
$sql = "SELECT * FROM productos WHERE Id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id]);
$prod = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$prod){
    exit("Producto no encontrado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Producto</title>
<link rel="stylesheet" href="../CSS/Estilo.css">
<link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>

<div class="form-container">
    <h2>Editar Producto</h2>
    <form action="actualizar_producto.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($prod['nombre']); ?>" required>
        <input type="number" name="precio" value="<?php echo $prod['precio']; ?>" required>
        <img src="<?php echo $prod['imagen']; ?>" alt="Vista previa" class="preview-img">
        <input type="text" name="imagen" placeholder="Ingrese el url de la imagen a cambiar" required>
        <button type="submit">Actualizar Producto</button>
    </form>
    <a href="admin.php">Volver al panel</a>
</div>

</body>
</html>
