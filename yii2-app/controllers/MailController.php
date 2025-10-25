<?php

namespace app\controllers;

use app\common\helper\response\ApiConstant;
use app\controllers\BaseController;
use Exception;
class MailController extends BaseController
{
    public $to = 'vuducsaobien95@gmail.com';

    public function actionSend()
    {
        try {
            $result = $this->mailService->sendMail($this->to);
            if ($result) {
                $this->res->message = 'Email sent successfully';
                $this->res->status = ApiConstant::STATUS_OK;
            } else {
                $this->res->message = 'Email sent failed';
                $this->res->status = ApiConstant::STATUS_FAIL;
            }
            return $this->res->build();
        } catch (Exception $e) {
            $this->res->message = 'Error Email: ' . $e->getMessage();
            $this->res->error = $e->getTraceAsString();
            $this->res->status = ApiConstant::STATUS_FAIL;
            return $this->res->build();
        }
    }
}
