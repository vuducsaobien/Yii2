<?php

namespace app\services;

use Yii;
use Exception;
use app\jobs\SendMailJob;
use app\common\enums\QueueDriverEnums;
use app\common\enums\QueueTypeCheckEnums;
class QueueService extends BaseService
{
    public function driverSyncronous()
    {
        try {
            $jobId = Yii::$app->queue->push(new SendMailJob([
                'to' => env('MAILER_TO')
            ]));
            return $jobId;
        } catch (Exception $e) {
            throw new Exception('Error driver syncronous - service: ' . $e->getMessage());
        }
    }

    // Check whether a worker has executed the job.
    public function checkStatus($jobId, $driver, $type)
    {
        try {
            return Yii::$app->queue->{$type}($jobId);
        } catch (Exception $e) {
            throw new Exception('Error check status - service: ' . $e->getMessage());
        }
    }
}
