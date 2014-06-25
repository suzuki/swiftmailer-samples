<?php
/**
 * 360-plugin-redirecting.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

// POINT of this sample
// All recipients are replace to $recipient.
// Except a pattern in whitelist.
$recipient = MAIL_REDIRECT_TO;
$whiteList = [WHITE_LIST_PCRE_PATTERN];

$mailer->registerPlugin(
    new Swift_Plugins_RedirectingPlugin(
        $recipient,
        $whiteList
    )
);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setSubject('Redirecting Plugin sample')
    ->setBody('This is a mail.')
;

$recipients = [MAIL_TO, MAIL_TO2];
foreach ($recipients as $recipient) {
    $message->setTo($recipient);
    $result = $mailer->send($message);
}
