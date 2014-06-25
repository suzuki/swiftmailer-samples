<?php
/**
 * 220-transport-sendmail.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

// POINT of this sample
$transport = Swift_SendmailTransport::newInstance(
    '/usr/sbin/sendmail -bs'
);
// -bs means 'Stand-alone SMTP server mode'

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('SendmailTransport sample')
    ->setBody('This is a mail.')
;

$result = $mailer->send($message);
