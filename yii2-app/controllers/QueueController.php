<?php

namespace app\controllers;

use app\common\helper\response\ApiConstant;
use app\controllers\BaseController;
use Exception;
use app\common\enums\QueueDriverEnums;
use app\common\enums\QueueTypeCheckEnums;
class QueueController extends BaseController
{
    public function actionDriverSyncronous()
    {
        try {
            $now = date('Y-m-d H:i:s');
            writeLog('START at: ' . $now);
            $jobId = $this->queueService->driverSyncronous();
            $this->res->status = ApiConstant::STATUS_OK;
            $this->res->message = 'Queue driver syncronous - executed successfully';
            $this->res->data = ['now' => date('Y-m-d H:i:s'), 'jobId' => $jobId];
        } catch (Exception $e) {
            $this->res->message = 'Error Queue driver syncronous: ' . $e->getMessage();
            $this->res->error = $e->getTraceAsString();
            $this->res->status = ApiConstant::STATUS_FAIL;
        }
        return $this->res->build();
    }

    public function actionDriverFile()
    {
        try {
            $now = date('Y-m-d H:i:s');
            writeLog('START FILE QUEUE at: ' . $now);
            $jobId = $this->queueService->driverFile();
            $this->res->status = ApiConstant::STATUS_OK;
            $this->res->message = 'Queue driver file - executed successfully';
            $this->res->data = ['now' => date('Y-m-d H:i:s'), 'jobId' => $jobId];
        } catch (Exception $e) {
            $this->res->message = 'Error Queue driver file: ' . $e->getMessage();
            $this->res->error = $e->getTraceAsString();
            $this->res->status = ApiConstant::STATUS_FAIL;
        }
        return $this->res->build();
    }

    public function actionCheckStatus($jobId, $driver = QueueDriverEnums::SYNCHRONOUS, 
        $type = QueueTypeCheckEnums::IS_DONE)
    {
        try {
            $status = $this->queueService->checkStatus($jobId, $driver, $type);
            $this->res->status = ApiConstant::STATUS_OK;
            $this->res->message = 'Queue check status - executed successfully';
            $this->res->data = ['status' => $status];
        } catch (Exception $e) {
            $this->res->message = 'Error Queue check status: ' . $e->getMessage();
            $this->res->error = $e->getTraceAsString();
            $this->res->status = ApiConstant::STATUS_FAIL;
        }
        return $this->res->build();
    }
}
