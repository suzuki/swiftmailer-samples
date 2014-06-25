<?php
/**
 * 520-thirdparty-plugin-css-inliner.php
 */

use Openbuildings\Swiftmailer\CssInlinerPlugin;

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

// POINT of this sample
$mailer->registerPlugin(new CssInlinerPlugin());

$htmlBody =<<<EOH
<html>
  <head>
    <style>
      .main {
        background-color: #f9ba34;
        text-align: center;
        height: 200px;
        line-height: 200px;
      }
    </style>
  </head>
  <body>
    <div class="main">
      <h1>Hi, This is CSS Inliner sample</h1>
    </div>
  </body>
</html>
EOH;

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('CSS Inliner sample')
    ->setContentType('text/html')
    ->setBody($htmlBody)
;

$result = $mailer->send($message);
