<?php
// NotificationService.php

// sendEmail.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Asegúrate de tener el autoload de Composer

function sendEmail($to, $subject, $message)
{
    $config = include('config.php');

    $mail = new PHPMailer(true);  // Crear una nueva instancia de PHPMailer

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = $config['mail']['host'];  // Servidor SMTP de Mailtrap
        $mail->SMTPAuth = true;
        $mail->Username = $config['mail']['username'];  // Usuario de Mailtrap
        $mail->Password = $config['mail']['password'];  // Contraseña de Mailtrap
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $config['mail']['port'];  // Puerto para Mailtrap
        $mail->CharSet = 'UTF-8';

        // Remitente
        $mail->setFrom($config['mail']['from_email'], $config['mail']['from_name']);

        // Destinatario
        $mail->addAddress($to);  // Dirección del destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        // Enviar el correo
        if ($mail->send()) {
            return ['status' => 'success', 'message' => 'Correo enviado con éxito'];
        } else {
            return ['status' => 'error', 'message' => 'Error al enviar el correo'];
        }
    } catch (Exception $e) {
        return ['status' => 'error', 'message' => 'Error al enviar el correo: ' . $mail->ErrorInfo];
    }
}
