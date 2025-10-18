<?php

namespace app\controllers;

use app\common\helper\response\ApiConstant;
use app\controllers\BaseController;

class CustomerController extends BaseController
{
    public function actionIndex()
    {
        $data = $this->customerService->getListWithRelations(['orders'], true);
        $this->res->data = $data;
        $this->res->message = 'Customers fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }
    
    public function actionWithCustomRelations()
    {
        // Có thể config bất kỳ combination nào
        $relations = ['orders']; // Hoặc ['orders'], ['country'], ['orders', 'items'], etc.
        $data = $this->customerService->getListWithCustomRelations($relations);
        $this->res->data = $data;
        $this->res->message = 'Customers with custom relations fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }
}
