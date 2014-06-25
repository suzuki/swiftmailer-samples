<?php
/**
 * 210-transport-smtp-auth.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

// POINT of this sample
$transport = Swift_SmtpTransport::newInstance(SMTP_AUTH_HOST, SMTP_AUTH_PORT)
    ->setUsername(SMTP_AUTH_USER)
    ->setPassword(SMTP_AUTH_PASS)
    ->setEncryption('ssl')
;
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('SmtpTransport sample')
    ->setBody('This is a mail.')
;

$result = $mailer->send($message);
