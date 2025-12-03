<?php
include "../CRUD/Conexion.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['Nombre'];
    $correo = $_POST['Correo'];
    $password = $_POST['Contrasena'];

    if (empty($usuario) || empty($correo) || empty($password))
    {
         header("Location: ../index.php?error=Ingrese los campos faltantes");
    }

    // Encriptar la contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // INSERT con parámetros posicionales
    $sql = "INSERT INTO usuarios (Nombre, Correo, Contrasena) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    if ($stmt->execute([$usuario, $correo, $passwordHash])) {
        header("Location: ../index.php");
    } else {
        echo "Error al registrar";
    }
}
