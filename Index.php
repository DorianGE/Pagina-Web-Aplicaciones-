<?php
// (Tu lógica PHP de arriba se queda igual)
if(isset($_POST['btn_login'])) {
    $correo = $_POST['Correo'];
    $password = $_POST['Contrasena'];
}
if (isset($_POST['btn_register'])) {
    // ... lógica registro
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    
    <link rel="stylesheet" href="CSS/Style.css">
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>
<body>

    <div id="g_id_onload"
        data-client_id="453972736803-3ghau9h9r0hgk41d63mgo3ro27v54k0d.apps.googleusercontent.com"
        data-context="signin"
        data-ux_mode="popup"
        data-callback="handleCredentialResponse"
        data-auto_prompt="false">
    </div>

    <form id="google-form" action="inicio-sesion-registrarse/google_auth.php" method="POST" style="display: none;">
        <input type="hidden" name="google_email" id="g_email">
        <input type="hidden" name="google_name" id="g_name">
        <input type="hidden" name="google_picture" id="g_picture">
    </form>

    <div class="container">
        
        <div class="container-form">
            <form id="Log-in" action="inicio-sesion-registrarse/Iniciosesion.php" method="post" class="sign-in">
                <h2 class= "Texto2">Inicio de</h2>
                <h2>Sesión</h2>
                <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline" data-text="signin_with" data-size="large" data-logo_alignment="left"></div>
                <br>

                <span>Ingrese el correo y contraseña</span>
                
                <?php if (isset($_GET['error'])): ?>
                    <p class="error"><?= $_GET['error']; ?></p>
                <?php endif; ?>

                <div class="container-input">
                    <ion-icon name="mail"></ion-icon>
                    <input type="text" name="Correo" placeholder="Ingrese el correo">
                </div>
                <div class="container-input">
                    <ion-icon name="lock-closed"></ion-icon>
                    <input type="password" name="Contrasena" placeholder="Ingrese la contraseña">
                </div>
                <button type="submit" name="btn_login" class="button">Iniciar sesión</button>
            </form>
        </div>
        
        <div class="container-form">
            <form action="inicio-sesion-registrarse/Registrarse.php" method="post" class="sign-up">
                <h2>Registrarse</h2>

                <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline" data-text="signup_with" data-size="large" data-logo_alignment="left"></div>
                <br>

                <span>Ingrese sus datos</span>
                <div class="container-input">
                    <ion-icon name="person"></ion-icon>
                    <input type="text" name="Nombre" placeholder="Ingrese su usuario">
                </div>
                <div class="container-input">
                    <ion-icon name="mail"></ion-icon>
                    <input type="text" name="Correo" placeholder="Ingrese un correo">
                </div>
                <div class="container-input">
                    <ion-icon name="lock-closed"></ion-icon>
                    <input type="password" name="Contrasena" placeholder="Ingrese una contraseña">
                </div>
                <button type="submit" name="btn_register" class="button">Registrarse</button>
            </form>
        </div>

        <div class="container-welcome">
            <div class="welcome sign-up welcome">
                
            </div>
            <div class="welcome sign-in welcome">
                
            </div>
        </div>

    </div> <button id="btn" style="position: absolute; top: 10px; right: 10px; z-index: 100;">Click para cambiar</button>
        

    <script src="script.js"></script>

    <script>
        function handleCredentialResponse(response) {
            // 1. Decodificar el token de Google
            const data = parseJwt(response.credential);
            
            console.log("Datos de Google:", data);

            // 2. Llenar el formulario oculto
            document.getElementById('g_email').value = data.email;
            document.getElementById('g_name').value = data.name;
            document.getElementById('g_picture').value = data.picture;

            // 3. Enviar el formulario automáticamente a PHP
            document.getElementById('google-form').submit();
        }

        // Función para leer el token JWT
        function parseJwt(token) {
            var base64Url = token.split('.')[1];
            var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));
            return JSON.parse(jsonPayload);
        }
    </script>
</body>
</html>