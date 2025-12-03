<?php
session_start();
include('Conexion.php');

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    exit("No autorizado");
}

$id = $_GET['id'] ?? 0;
$sql = "DELETE FROM productos WHERE Id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id]);

header("Location: admin.php");
?>
