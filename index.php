<?php
// index.php
include 'sendEmail.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Datos del correo
    $to = $data['email'];
    $subject = 'Notificación de evento';
    $message = $data['message'];

    // Llamada para enviar el correo
    $response = sendEmail($to, $subject, $message);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
