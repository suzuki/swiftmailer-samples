<?php
/**
 * 400-validate.php
 */

require_once '../vendor/autoload.php';
require_once './config.php';

$recipients = [
    'ok@example.com',
    'bad.@example.com',
    '"ok."@example.com'
];

foreach ($recipients as $recipient) {
    if (Swift_Validate::email($recipient)) {
        echo $recipient . " is OK\n";
    } else {
        echo $recipient . " is BAD\n";
    }
}
