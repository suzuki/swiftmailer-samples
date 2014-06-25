<?php
/**
 * 310-plugin-antiflood.php
 *
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

// POINT of this sample
// re-connect by 1 send, and 10 sec sleep (option)
$mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(1, 10));

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setSubject('AntiFlood Plugin sample')
    ->setBody('This is a mail.')
;

$recipients = [MAIL_TO, MAIL_TO2];
foreach ($recipients as $recipient) {
    $message->setTo($recipient);
    $result = $mailer->send($message);
}
