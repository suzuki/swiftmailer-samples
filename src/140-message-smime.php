<?php
/**
 * 140-message-smime.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('S/MIME signed mail')
    ->setBody('This is a S/MIME mail')
;

// POINT of this sample
$smimeSigner = Swift_Signers_SMimeSigner::newInstance();
$smimeSigner->setSignCertificate(
    SMIME_CERT_FILE,
    [SMIME_SECRET_FILE, SMIME_SECRET_PASSPHRASE]
);
$message->attachSigner($smimeSigner);

$result = $mailer->send($message);
