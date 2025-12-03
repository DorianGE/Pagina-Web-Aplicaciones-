<?php
session_start();
include('../CRUD/Conexion.php');

if (isset($_POST['google_email'])) {
    $email = $_POST['google_email'];
    $nombre = $_POST['google_name'];
    $imagen = $_POST['google_picture'];

    // 1. Verificar si el usuario ya existe
    $sql = "SELECT * FROM usuarios WHERE Correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // --- USUARIO YA EXISTE (LOGIN) ---
        $_SESSION['user_id'] = $usuario['Id'];
        $_SESSION['nombre'] = $usuario['Nombre'];
        // Usamos la columna 'role' tal cual está en la base de datos
        $_SESSION['role'] = $usuario['role']; 
        
        header("Location: ../index1.php");
        exit();

    } else {
        // --- USUARIO NUEVO (REGISTRO) ---
        // Contraseña temporal para usuarios de Google
        $pass_temporal = password_hash("google_access", PASSWORD_DEFAULT); 
        
        // CORRECCIÓN: Ahora dice 'role' (minúscula)
        $sqlInsert = "INSERT INTO usuarios (Nombre, Correo, Contrasena, role) VALUES (?, ?, ?, 'cliente')";
        $stmtInsert = $conexion->prepare($sqlInsert);
        
        if ($stmtInsert->execute([$nombre, $email, $pass_temporal])) {
            $nuevoId = $conexion->lastInsertId();
            
            // Crear sesión inmediata
            $_SESSION['user_id'] = $nuevoId;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['role'] = 'cliente';

            header("Location: ../index1.php");
            exit();
        } else {
            echo "Error al registrar en la base de datos.";
        }
    }

} else {
    // Si intentan entrar directo sin datos POST
    header("Location: ../index.php");
    exit();
}
?>