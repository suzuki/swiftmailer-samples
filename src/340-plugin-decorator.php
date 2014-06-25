<?php
/**
 * 340-plugin-decorator.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

// POINT of this sample
$replacements = [
    MAIL_TO => [
        '{username}' => 'USER NAME1',
    ],
    MAIL_TO2 => [
        '{username}' => 'USER NAME2',
    ],
];
$decorator = new Swift_Plugins_DecoratorPlugin($replacements);
$mailer->registerPlugin($decorator);

// replace {username} to above definitions at sending
$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setSubject('Info for {username}, Decorator Plugin sample')
    ->setBody('Hi, {username}. This is a mail.')
;

$recipients = [MAIL_TO, MAIL_TO2];
foreach ($recipients as $recipient) {
    $message->setTo($recipient);
    $result = $mailer->send($message);
}
