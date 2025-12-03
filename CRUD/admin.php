<?php
session_start();
include('Conexion.php');

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../index1.php");
    exit();
}

$sql = "SELECT * FROM productos";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Admin - Productos</title>
<link rel="stylesheet" href="../CSS/Estilo.css">
<link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>
<h2>Panel de administración de productos</h2>

<a href="agregar_producto.php"><button class="btn-agregar">Agregar Producto</button></a>

<div class="productos-admin">
<?php foreach($productos as $prod): ?>
    <div class="producto-card">
        <h3><?php echo htmlspecialchars($prod['nombre']); ?></h3>
        <img src="<?php echo $prod['imagen']; ?>" width="150" alt="Imagen del producto">
        <p>Precio: $<?php echo $prod['precio']; ?> MXN</p>
        <a href="editar_producto.php?id=<?php echo $prod['id']; ?>"><button class="btn-editar">Editar</button></a>
        <a href="eliminar_producto.php?id=<?php echo $prod['id']; ?>" onclick="return confirm('¿Eliminar producto?')"><button class="btn-eliminar">Eliminar</button></a>
    </div>
<?php endforeach; ?>
</div>

<div class="navegacion-admin">
    <a href="../index1.php" class="btn-volver">Volver a la pagina de inicio</a>
</div>
</body>
</html>
