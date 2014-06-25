<?php
/**
 * 300-plugin.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('Plugin sample')
    ->setBody('This is a mail.')
;

// POINT of this sample
// Register plugin to mailer
$mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100));

$result = $mailer->send($message);
