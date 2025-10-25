<?php

namespace app\services;

use Yii;
use Exception;
class MailService extends BaseService
{
    public function sendMail($to)
    {
        $now = date('Y-m-d H:i:s');
        try {
            $message = Yii::$app->mailer->compose(
                ['html' => 'layouts/html', 'text' => 'layouts/text'],
                ['content' => '1 - This is a test email sent at ' . $now]
            )
            ->setFrom([env('MAILER_USERNAME') => env('MAILER_FROM_NAME')])
            ->setTo($to)
            ->setSubject('Test Email from System');
            // ->setTextBody('This is a test email sent at ' . $now);

            if ($message->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception('Error send mail - service: ' . $e->getMessage());
        }
    }
}
