<?php 
// 1. Definimos las credenciales usando una lógica "Híbrida"
// (Si existe la variable en la nube la usa, si no, usa la de XAMPP)

$host     = getenv('DB_HOST') !== false ? getenv('DB_HOST') : "localhost";
$dbname   = getenv('DB_NAME') !== false ? getenv('DB_NAME') : "productos";
$usuario  = getenv('DB_USER') !== false ? getenv('DB_USER') : "root";
$pass     = getenv('DB_PASS') !== false ? getenv('DB_PASS') : "";
$port     = getenv('DB_PORT') !== false ? getenv('DB_PORT') : "3306"; // Importante para bases de datos externas

try 
{
    // 2. Agregamos "port=$port" a la conexión, ya que en la nube a veces no es el 3306
    $conexion = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $usuario, $pass);
    
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Esta línea extra ayuda a que los caracteres especiales (tildes, ñ) se vean bien
    $conexion->exec("set names utf8");

} catch (PDOException $e) // CORREGIDO: Antes decía PDOExeption (faltaba la c)
{
    die("Error en la conexion: " . $e->getMessage());
} 
?>
