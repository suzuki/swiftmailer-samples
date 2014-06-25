<?php
/**
 * 510-thirdparty-plugin-filter.php
 */

use Openbuildings\Swiftmailer\FilterPlugin;

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

// POINT of this sample
// set email address or domain
$whiteList = [MAIL_TO];
$blackList = [MAIL_TO2];
$mailer->registerPlugin(new FilterPlugin($whiteList, $blackList));

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setSubject('Filter sample')
    ->setBody('Hello, Swift Mailer.')
;

$recipients = [MAIL_TO, MAIL_TO2];
foreach ($recipients as $recipient) {
    $message->setTo($recipient);
    $result = $mailer->send($message);
}
