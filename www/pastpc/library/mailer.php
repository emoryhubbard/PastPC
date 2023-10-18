<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../../../');
$dotenv->load();

$mail = new PHPMailer(true);
//$mail->SMTPDebug = SMTP::DEBUG_CONNECTION;
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = $_SERVER['SMTP_SERVER'];
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = $_SERVER['SMTP_USERNAME'];
$mail->Password = $_SERVER['SMTP_PASSWORD'];

$mail->isHtml(true);

return $mail;