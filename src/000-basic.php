<?php
/**
 * 000-basic.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

// create mailer
$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

// create message
$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('Hi !')
    ->setBody('Hello, Swift Mailer.')
;

// send message
$result = $mailer->send($message);
