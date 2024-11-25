<?php
namespace Servicios;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;
require 'C:/xampp/htdocs/estancia/vendor/autoload.php';

class MailService {
    public static function enviarCorreo($destinatario, $asunto, $mensaje) {
        // Carga las variables de entorno desde model/config/.env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../config');
        $dotenv->load();
        $mail = new PHPMailer(true); 
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USERNAME'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // StartTLS
            $mail->Port = 587; // Puerto para StartTLS

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            
            $mail->setFrom($_ENV['SMTP_USERNAME'], 'Nombre del remitente');
            $mail->addAddress($destinatario);
            $mail->Subject = $asunto;
            $mail->Body = $mensaje;
            $mail->isHTML(true);

            $mail->send();
            return true;
        } catch (Exception $e) {
            return "Error: {$mail->ErrorInfo}";
        }
    }
}

