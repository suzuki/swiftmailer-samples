<?php
/**
 * 370-plugin-reporter-hit.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

// POINT of this sample
$reporter = new Swift_Plugins_Reporters_HitReporter();
$mailer->registerPlugin(
    new Swift_Plugins_ReporterPlugin($reporter)
);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setSubject('Reporter Plugin sample')
    ->setBody('This is a mail.')
;

$recipients = [MAIL_TO, MAIL_FAILED_ADDRESS];
foreach ($recipients as $recipient) {
    $message->setTo($recipient);
    $result = $mailer->send($message);
}

$failedRecipients = $reporter->getFailedRecipients();

// output failed recipients
array_walk($failedRecipients, function($failedRecipient) {
    echo "$failedRecipient\n";
});
