<?php

namespace app\controllers;

use app\common\helper\response\ApiConstant;
use app\controllers\BaseController;

class OrderController extends BaseController
{
    public function actionViaTable()
    {
        $data = $this->orderService->getListViaTable();
        $this->res->data = $data;
        $this->res->message = 'Orders with via table - fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }

    public function actionVia()
    {
        $data = $this->orderService->getListVia();
        $this->res->data = $data;
        $this->res->message = 'Orders with via - fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }
}
