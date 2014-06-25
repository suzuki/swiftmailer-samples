<?php
/**
 * 280-transport-spool-memory.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

// POINT of this sample
$spool = new Swift_MemorySpool();
$transport = Swift_SpoolTransport::newInstance($spool);

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('SpoolTransport (memory) sample')
    ->setBody('This is a mail.')
;

// No send, but number of send is counted.
$result = $mailer->send($message);
