<?php
/**
 * 110-message-addpart.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('Multipart mail sample')
;

// POINT of this sample
$message->addPart('This is TEXT part.', 'text/plain');
$message->addPart('<b>This is HTML part.</b>', 'text/html');

$result = $mailer->send($message);
