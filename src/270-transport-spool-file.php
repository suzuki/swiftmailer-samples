<?php
/**
 * 270-transport-spool-file.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

// POINT of this sample
$path = FILE_SPOOL_PATH;
$spool = new Swift_FileSpool($path);
$transport = Swift_SpoolTransport::newInstance($spool);

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('SpoolTransport (file) sample')
    ->setBody('This is a mail.')
;

// Serialized Swift_Message objects were spooled to $path
$result = $mailer->send($message);
