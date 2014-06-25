<?php
/**
 * 150-message-dkim.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('DKIM signed mail')
    ->setBody('This is a DKIM mail.')
;

// POINT of this sample
$privateKey = file_get_contents(DKIM_PRIVATE_KEY);
$dkimSigner = Swift_Signers_DKIMSigner::newInstance(
    $privateKey,
    DKIM_DOMAIN,
    DKIM_SELECTOR
);
$message->attachSigner($dkimSigner);

$result = $mailer->send($message);
