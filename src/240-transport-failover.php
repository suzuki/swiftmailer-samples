<?php
/**
 * 240-transport-failover.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

// POINT of this sample
$transport1 = Swift_SmtpTransport::newInstance(SMTP_HOST,  SMTP_PORT);
$transport2 = Swift_SmtpTransport::newInstance(SMTP_HOST2, SMTP_PORT2);

$transport = Swift_FailoverTransport::newInstance([
    $transport1,
    $transport2,
]);
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setSubject('FailoverTransport sample')
    ->setBody('This is a mail.')
;

$recipients = [MAIL_TO, MAIL_TO2];
$total = 0;
foreach ($recipients as $recipient) {
    $message->setTo($recipient);

    $result = $mailer->send($message);
    $total += $result;
}
