<?php
/**
 * 200-transport.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('Transport sample')
    ->setBody('This is a mail.')
;

$failedRecipients = [];
$sentCount = $mailer->send($message, $failedRecipients);

// $sentCount : sum(To, Cc, Bcc)
// $failedRecipients : array of failed address (option)
