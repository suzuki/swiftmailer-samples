<?php
/**
 * 500-thirdparty-transport-amazon-ses.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

// POINT of this sample
$transport = Swift_AWSTransport::newInstance(
    AWS_ACCESS_KEY,
    AWS_SECRET_KEY
);
$transport->setEndpoint(AWS_ENDPOINT);
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setSubject('Amazon SES sample')
    ->setBody('This is a mail.')
;

$recipients = [MAIL_TO, MAIL_TO2];
foreach ($recipients as $recipient) {
    $message->setTo($recipient);
    $result = $mailer->send($message);
}
