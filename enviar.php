<?php
require_once 'vendor/autoload.php'; // ruta al autoload.php
use Twilio\Rest\Client;

// Credenciales de Twilio (de tu cuenta)
$sid    = "AC44bc3da74340ca66c24148ea269fff66";
$token  = "47a6ceb059d3198bd14852cdad7dd54c"; // reemplaza por tu AuthToken
$twilio = new Client($sid, $token);

// Datos del formulario
$numero  = $_POST['numero'];
$mensaje = $_POST['mensaje'];

// Enviar mensaje WhatsApp
try {
    $message = $twilio->messages->create(
        "whatsapp:$numero",
        [
            "from" => "whatsapp:+14155238886", // tu número de Twilio
            "body" => $mensaje
        ]
    );

    echo "<h2>✅ Mensaje enviado con SID: " . $message->sid . "</h2>";
    echo "<a href='index1.html'>Volver</a>";

} catch (Exception $e) {
    echo "<h2>❌ Error al enviar:</h2>";
    echo $e->getMessage();
}
?>