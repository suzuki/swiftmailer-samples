<?php
/**
 * 120-message-attach.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('File attachement mail')
    ->setBody('Mail body')
;

// POINT of this sample
$attachment = Swift_Attachment::fromPath(
    './images/panda.jpg',
    'image/jpeg'
);
$message->attach($attachment);

$result = $mailer->send($message);
