<?php
/**
 * 331-plugin-logger-echo.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setSubject('Logger Plugin sample')
    ->setBody('This is a mail.')
;

// POINT of this sample
// echo, not store log
$logger = new Swift_Plugins_Loggers_EchoLogger();
$mailer->registerPlugin(
    new Swift_Plugins_LoggerPlugin($logger)
);

$recipients = [MAIL_TO, MAIL_TO2];
foreach ($recipients as $recipient) {
    $message->setTo($recipient);
    $result = $mailer->send($message);
}
