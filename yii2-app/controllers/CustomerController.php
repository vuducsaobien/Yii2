<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\models\Customer;
use app\common\helper\response\ApiConstant;

class CustomerController extends BaseController
{
    public function actionIndex()
    {
        $customers = Customer::find()->all();
        
        $this->res->data = $customers;
        $this->res->message = 'Customers fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }
}
