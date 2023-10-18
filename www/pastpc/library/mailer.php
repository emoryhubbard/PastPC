<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../../../');
$dotenv->load();

/*require_once(__DIR__ . '/../../vendor/autoload.php');
require_once(__DIR__ . '/../../env.php');*/
/*require_once '../../../test1.php';*/
/*Warning: require_once(../../../test1.php): failed to open stream: No such file or directory in /var/www/html/pastpc/library/mailer.php on line 12
Fatal error: require_once(): Failed opening required '../../../test1.php' (include_path='.:/usr/local/lib/php') in /var/www/html/pastpc/library/mailer.php on line 12
*/
//require_once '/var/test1.php';
//require_once '../../../test/test1.php';
//require_once '../../../test2.php';
//debugPrint($test1);
/*$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();*/
/*
Fatal error: Uncaught Dotenv\Exception\InvalidPathException: Unable to read any of the environment file(s) at [/var/www/html/pastpc/library/.env]. in /var/www/vendor/vlucas/phpdotenv/src/Store/FileStore.php:68 Stack trace: #0 /var/www/vendor/vlucas/phpdotenv/src/Dotenv.php(222): Dotenv\Store\FileStore->read() #1 /var/www/html/pastpc/library/mailer.php(9): Dotenv\Dotenv->load() #2 /var/www/html/pastpc/model/accounts-model.php(95): require('/var/www/html/p...') #3 /var/www/html/pastpc/accounts/index.php(198): sendEmail('edhthe4th@gmail...', '0df693dc10cbba8...') #4 {main} thrown in /var/www/vendor/vlucas/phpdotenv/src/Store/FileStore.php on line 68
*/
/*
require_once '../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../../../');
$dotenv->load();
*/
/*
2023-10-18 18:52:54 SMTP ERROR: Failed to connect to server: Cannot assign requested address (99)
SMTP Error: Could not connect to SMTP host. Failed to connect to server
*/
/*
2023-10-18 20:09:23 Connection: opening to localhost:587, timeout=300, options=array()
2023-10-18 20:09:23 Connection failed. Error #2: stream_socket_client(): unable to connect to localhost:587 (Cannot assign requested address) [/var/www/vendor/phpmailer/phpmailer/src/SMTP.php line 397]
2023-10-18 20:09:23 SMTP ERROR: Failed to connect to server: Cannot assign requested address (99)
SMTP Error: Could not connect to SMTP host. Failed to connect to server
*/
/*
2023-10-18 20:25:18 Connection: opening to smtp.gmail.com.:587, timeout=300, options=array()
2023-10-18 20:25:19 Connection: opened
2023-10-18 20:25:19 SERVER -> CLIENT: 220 smtp.gmail.com ESMTP z5-20020ac87ca5000000b0041cb787ff41sm209037qtv.67 - gsmtp
2023-10-18 20:25:19 CLIENT -> SERVER: EHLO lvh.me
2023-10-18 20:25:19 SERVER -> CLIENT: 250-smtp.gmail.com at your service, [174.192.198.166]250-SIZE 35882577250-8BITMIME250-STARTTLS250-ENHANCEDSTATUSCODES250-PIPELINING250-CHUNKING250 SMTPUTF8
2023-10-18 20:25:19 CLIENT -> SERVER: STARTTLS
2023-10-18 20:25:19 SERVER -> CLIENT: 220 2.0.0 Ready to start TLS
2023-10-18 20:25:20 CLIENT -> SERVER: EHLO lvh.me
2023-10-18 20:25:20 SERVER -> CLIENT: 250-smtp.gmail.com at your service, [174.192.198.166]250-SIZE 35882577250-8BITMIME250-AUTH LOGIN PLAIN XOAUTH2 PLAIN-CLIENTTOKEN OAUTHBEARER XOAUTH250-ENHANCEDSTATUSCODES250-PIPELINING250-CHUNKING250 SMTPUTF8
2023-10-18 20:25:20 CLIENT -> SERVER: AUTH LOGIN
2023-10-18 20:25:20 SERVER -> CLIENT: 334 VXNlcm5hbWU6
2023-10-18 20:25:20 CLIENT -> SERVER: [credentials hidden]
2023-10-18 20:25:20 SERVER -> CLIENT: 334 UGFzc3dvcmQ6
2023-10-18 20:25:20 CLIENT -> SERVER: [credentials hidden]
2023-10-18 20:25:20 SERVER -> CLIENT: 534-5.7.9 Application-specific password required. Learn more at534 5.7.9 https://support.google.com/mail/?p=InvalidSecondFactor z5-20020ac87ca5000000b0041cb787ff41sm209037qtv.67 - gsmtp
2023-10-18 20:25:20 SMTP ERROR: Password command failed: 534-5.7.9 Application-specific password required. Learn more at534 5.7.9 https://support.google.com/mail/?p=InvalidSecondFactor z5-20020ac87ca5000000b0041cb787ff41sm209037qtv.67 - gsmtp
SMTP Error: Could not authenticate.
2023-10-18 20:25:21 CLIENT -> SERVER: QUIT
2023-10-18 20:25:21 SERVER -> CLIENT: 221 2.0.0 closing connection z5-20020ac87ca5000000b0041cb787ff41sm209037qtv.67 - gsmtp
2023-10-18 20:25:21 Connection: closed
SMTP Error: Could not authentic
*/

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