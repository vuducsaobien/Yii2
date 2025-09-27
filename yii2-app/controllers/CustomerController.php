<?php

namespace app\controllers;

use app\common\helper\response\ApiConstant;
use app\controllers\BaseController;

class CustomerController extends BaseController
{
    public function actionIndex()
    {
        $data = $this->customerService->getCustomers();
        $this->res->data = $data;
        $this->res->message = 'Customers fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }
}
