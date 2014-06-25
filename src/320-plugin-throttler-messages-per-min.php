<?php
/**
 * 320-plugin-throttler-messages-per-min.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

// POINT of this sample
// 1 send per minute
$mailer->registerPlugin(new Swift_Plugins_ThrottlerPlugin(
    1, Swift_Plugins_ThrottlerPlugin::MESSAGES_PER_MINUTE
));

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setSubject('Throttler Plugin sample')
    ->setBody('This is a mail.')
;

$recipients = [MAIL_TO, MAIL_TO2];
foreach ($recipients as $recipient) {
    $message->setTo($recipient);
    $result = $mailer->send($message);
}
