<?php
/**
 * 530-thirdparty-plugin-google-campaign.php
 */

use Openbuildings\Swiftmailer\GoogleCampaignPlugin;

require_once '../vendor/autoload.php';
require_once './config.php';

$transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT);
$mailer = Swift_Mailer::newInstance($transport);

// POINT of this sample
$mailer->registerPlugin(new GoogleCampaignPlugin([
    'utm_source' => 'source',
    'utm_campaign' => 'email',
    'utm_medium' => 'email',
]));

$htmlBody =<<<EOH
<html>
  <head>
  </head>
  <body>
    <div class="main">
      <h1>Hi, This is Google Campaign sample</h1>
      <div>
        <a href="http://example.com/">example.com</a>
      </div>
    </div>
  </body>
</html>
EOH;

$message = Swift_Message::newInstance();
$message
    ->setFrom(MAIL_FROM)
    ->setTo(MAIL_TO)
    ->setSubject('Google Campaign plugin sample')
    ->setContentType('text/html')
    ->setBody($htmlBody)
;

$result = $mailer->send($message);
