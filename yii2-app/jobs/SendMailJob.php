<?php

namespace app\jobs;

use yii\base\BaseObject;
use Yii;
use yii\queue\JobInterface;
use Exception;
use app\services\MailService;

class SendMailJob extends BaseObject implements JobInterface
{
    /**
     * @var MailService
     */
    protected $mailService;

    public $to;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->mailService = Yii::$app->mailService;
    }

    public function execute($queue)
    {
        try {
            // $now = date('Y-m-d H:i:s');
            // writeLog('SendMailJob execute at ' . $now);
            $result = $this->mailService->sendMail($this->to);
            // if ($result) {
            //     writeLog('Email sent successfully at ' . $now);
            // } else {
            //     writeLog('Email sent failed at ' . $now);
            // }
        } catch (Exception $e) {
            // writeLog('Error send mail - job: at: ' . $now);
            writeLog('Error send mail - job: getMessage() - ' . $e->getMessage());
            writeLog('Error send mail - job: getTraceAsString() - ' . $e->getTraceAsString());
        }
    }
}