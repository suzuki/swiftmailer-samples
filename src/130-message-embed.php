<?php
/**
 * 130-message-embed.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('Image embed mail')
;

// POINT of this sample
$embedImage = Swift_Image::fromPath('./images/panda.jpg');
$message->setBody(
    '<img src="' . $message->embed($embedImage) . '" />',
    'text/html'
);

$result = $mailer->send($message);
