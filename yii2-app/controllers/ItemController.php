<?php

namespace app\controllers;

use app\common\helper\response\ApiConstant;
use app\controllers\BaseController;

class ItemController extends BaseController
{
    public function actionList()
    {
        $data = $this->itemService->getList();
        $this->res->data = $data;
        $this->res->message = 'Items with list - fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }
}
