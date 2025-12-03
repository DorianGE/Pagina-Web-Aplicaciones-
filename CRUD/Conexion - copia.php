<?php 
$host = "localhost";
$dbname = "productos";
$usuario = "root";
$pass = "";

try 
{
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOExeption $e)
  {
    die("Error en la conexion: " . $e->getMessage());
  } 
?>