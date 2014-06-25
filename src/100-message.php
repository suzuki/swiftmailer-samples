<?php
/**
 * 100-message.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setCc(MAIL_TO2)
    ->setBcc(MAIL_TO3)
    ->setReplyTo(MAIL_TO3)
    ->setContentType('text/plain')
    ->setSubject('Subject')
    ->setBody('Massage body')
;

$result = $mailer->send($message);
