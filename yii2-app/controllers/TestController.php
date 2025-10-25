<?php

namespace app\controllers;

use app\common\helper\response\ApiConstant;
use app\controllers\BaseController;
use Exception;

class TestController extends BaseController
{
    public function actionTimeZone()
    {
        try {
            $now = date('Y-m-d H:i:s');
            $this->res->message = 'Current time: ' . $now;
            $this->res->status = ApiConstant::STATUS_OK;
            return $this->res->build();
        } catch (Exception $e) {
            $this->res->message = 'Error Email: ' . $e->getMessage();
            $this->res->error = $e->getTraceAsString();
            $this->res->status = ApiConstant::STATUS_FAIL;
            return $this->res->build();
        }
    }
}
