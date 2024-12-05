<?php
require("../Conexion/conexion.php");
require '../Librerias/PHPMailer/src/PHPMailer.php';
require '../Librerias/PHPMailer/src/SMTP.php';
require '../Librerias/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$response = array('success' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Preparar y ejecutar la consulta SQL
    $stmt = $conexion->prepare("SELECT contraseña FROM usuarios WHERE Correo = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($contraseña);
            $stmt->fetch();

            // Enviar correo con PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Configuración del servidor de correo
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';  // Especifica el servidor SMTP principal
                $mail->SMTPAuth = true;
                $mail->Username = 'victorjrodriguezp8@gmail.com';  // Tu correo
                $mail->Password = 'mkli ahmx dknj pram';  // Tu contraseña
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Remitente y destinatarios
                $mail->setFrom('victorjrodriguezp8@gmail.com', 'Tu Nombre');
                $mail->addAddress($email);

                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'Su contraseña de Usuario';

                // Crear el contenido HTML del correo
                $mail->Body = "
                <!DOCTYPE html>
                <html lang='es'>
                <head>
                    <meta charset='UTF-8'>
                    <title>Recuperación de Contraseña</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        h1 { text-align: center; font-size: 36px; color: #005EB8; }
                        h2 { color: #005EB8; }
                        .logo { display: block; margin: 0 auto; width: 150px; }
                        .content { text-align: justify; }
                        .footer { margin-top: 20px; font-size: 12px; color: gray; }
                    </style>
                </head>
                <body>
                    
                    <h2>Estimado Usuario,</h2>
                    <div class='content'>
                        <p>Le informamos que su contraseña ha sido recuperada exitosamente. A continuación se presenta:</p>
                        <h1>$contraseña</h1>
                        <p>Asegúrese de seguir las siguientes recomendaciones para proteger su contraseña:</p>
                        <ul>
                            <li>Utilice contraseñas que sean difíciles de adivinar.</li>
                            <li>Cambie su contraseña periódicamente.</li>
                            <li>No comparta su contraseña con nadie.</li>
                            <li>Habilite la autenticación de dos factores si es posible.</li>
                        </ul>
                    </div>
                    <div class='footer'>
                        <p>Nota: Este correo es enviado automáticamente. No responda a este mensaje, ya que es de uso exclusivo para enviar este tipo de comunicaciones y nadie revisa la bandeja de entrada.</p>
                    </div>
                </body>
                </html>
                ";

                $mail->AltBody = "Estimado Usuario,\n\nSu contraseña es: $contraseña\n\nPor favor, no responda a este mensaje.";

                $mail->send();
                $response['success'] = true;
                $response['message'] = 'La contraseña ha sido enviada a su correo electrónico.';
            } catch (Exception $e) {
                $response['message'] = "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        } else {
            $response['message'] = "El correo electrónico no existe en la base de datos.";
        }

        $stmt->close();
    } else {
        $response['message'] = "Error en la preparación de la consulta: " . $conexion->error;
    }
} else {
    $response['message'] = "Solicitud no válida";
}

$conexion->close();

echo json_encode($response);
?>
