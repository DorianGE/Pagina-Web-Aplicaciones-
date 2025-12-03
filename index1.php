<?php
session_start();
include('CRUD/Conexion.php'); // Conexión PDO

// Obtener productos desde la base de datos
$sql = "SELECT * FROM productos";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PetShop</title>

  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="CSS/Estilo.css"/>
  <script src="https://www.youtube.com/iframe_api"></script>
  <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=MXN"></script>
</head>

<body>
  <h3>Tienda de mascotas</h3>
  <img src="Imagenes/Logo Tienda de Accesorios para Mascotas Alegre Café y Rosa.png" alt="Logo Tienda" />

  <!-- Musica de estancia -->
  <div class="centered">
    <h2>Musica de estancia en la pagina</h2>
    <p>Puedes pausarla si no te gusta</p>
    <div id="youtube-music-player" class="music-player"></div>
    <script>
      function onYouTubeIframeAPIReady() {
        new YT.Player('youtube-music-player', {
          height: '150',
          width: '300',
          videoId: 'vFOxhhWhjnQ',
          playerVars: {autoplay: 1, controls: 1, modestbranding: 1, rel: 0, showinfo: 0, iv_load_policy: 3, loop: 1, playlist: 'vFOxhhWhjnQ'}
        });
      }
    </script>
  </div>

  <p>Bienvenido a nuestra página web. Aquí podrás encontrar varias cosas que se venden en la tienda física. ¡Visítanos en Chihuahua! Ubicación abajo:</p>

  <!-- Mapa Leaflet -->
  <div id="map"></div>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const ubicacion = [28.636944444444, -106.07694444444];
      const map = L.map("map").setView(ubicacion, 13);
      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "© OpenStreetMap contributors",
      }).addTo(map);
      L.marker(ubicacion)
        .addTo(map)
        .bindPopup("Ubicación de la tienda")
        .openPopup();
    });
  </script>

  <!-- Botón admin -->
  <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
    <a href="CRUD/admin.php"><button class = "Admin">Administrar productos</button></a>
  <?php endif; ?>

  <!-- Productos -->
  <div class="productos">
    <?php foreach($productos as $producto): ?>
      <div class="producto">
        <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
        
        <img src="<?php echo $producto['imagen']; ?>" width="150" alt="Producto">
        
        <p>Precio: $<?php echo htmlspecialchars($producto['precio']); ?> MXN</p>
        
        <div id="paypal-button-<?php echo $producto['id']; ?>"></div>

          <script>
            paypal.Buttons({
              // Configuración del estilo (opcional, para que se vea mejor)
              style: {
                  shape: 'rect',
                  color: 'gold',
                  layout: 'vertical',
                  label: 'pay',
              },
              createOrder: function(data, actions) {
                return actions.order.create({
                  purchase_units: [{
                    description: '<?php echo $producto['nombre']; ?>',
                    amount: { 
                        // Aseguramos que el precio sea un número válido
                        value: '<?php echo $producto['precio']; ?>' 
                    }
                  }]
                });
              },
              onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                  // Mensaje de éxito
                  alert('Pago completado por ' + details.payer.name.given_name);
                });
              },
              onError: function (err) {
                // Esto te avisará en la consola si PayPal falla por algo interno
                console.error('Error en PayPal:', err);
              }
            }).render('#paypal-button-<?php echo $producto['id']; ?>');
          </script>

        </div>
    <?php endforeach; ?>
  </div>

  <!-- Formulario contacto -->
  <div class="centered">
    <h2>Contáctanos</h2>
    <p>¿Necesitas ayuda? Mándanos un mensaje:</p>

    <form action="enviar.php" method="POST">
      <input type="text" name="numero" placeholder="Ingrese su número" required /><br /><br />
      <textarea name="mensaje" placeholder="Deja tu mensaje" required></textarea><br /><br />
      <button type="submit">Enviar mensaje</button>
    </form>
  </div>
</body>
</html>