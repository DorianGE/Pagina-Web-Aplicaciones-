<?php
session_start();

include ('../CRUD/Conexion.php');
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST['Correo']) || empty($_POST['Contrasena']))
    {
        header("Location: ../index.php?error=Ingrese los campos para acceder");
        exit();
    }
    $correo = $_POST['Correo'];
    $password = $_POST ['Contrasena'];

    $sql = "SELECT * FROM usuarios WHERE Correo = ?";
    $stmt = $conexion ->prepare($sql);
    $stmt -> execute([$correo]);

    $fila = $stmt -> fetch(PDO::FETCH_ASSOC);
    if (!$fila)
    {
        header("Location: ../index.php?error=El correo no esta registrado");
        echo "El correo no esta registrado";
        exit();
    }
    $hashBD = $fila['Contrasena'];

    if (!password_verify($password, $hashBD))
    {
        header("Location: ../index.php?error=Contraseña Incorrecta");
        exit();
    }

    $_SESSION['id'] = $fila['Id'];
    $_SESSION['nombre'] = $fila['Nombre'];
    $_SESSION['correo'] = $fila['Correo'];
    $_SESSION['role'] = $fila['Role'];

    header("Location: ../index1.php");
}
?>