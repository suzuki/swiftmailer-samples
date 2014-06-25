<?php
/**
 * 260-transport-null.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

// POINT of this sample
$transport = Swift_NullTransport::newInstance();
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('NullTransport sample')
    ->setBody('This is a mail, but this is not send.')
;

$result = $mailer->send($message);
