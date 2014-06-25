<?php
/**
 * 230-transport-mail.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

// POINT of this sample
$transport = Swift_MailTransport::newInstance();
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('MailTransport sample')
    ->setBody('This is a mail.')
;

$result = $mailer->send($message);
