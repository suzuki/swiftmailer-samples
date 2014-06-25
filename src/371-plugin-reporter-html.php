<?php
/**
 * 371-plugin-reporter-html.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setSubject('Reporter Plugin sample')
    ->setBody('This is a mail.')
;

// POINT of this sample
$reporter = new Swift_Plugins_Reporters_HtmlReporter();
$mailer->registerPlugin(
    new Swift_Plugins_ReporterPlugin($reporter)
);

$recipients = [MAIL_TO, MAIL_FAILED_ADDRESS];
foreach ($recipients as $recipient) {
    $message->setTo($recipient);
    $result = $mailer->send($message);
}
