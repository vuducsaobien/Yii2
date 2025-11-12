<?php

namespace app\controllers;

use Yii;
use app\common\helper\response\ApiConstant;
use app\controllers\BaseController;

class BlockExplorerController extends BaseController
{
    /**
     * Lấy tất cả các sự kiện của một địa chỉ
     *
     * @return array
     */
    public function actionGetAllEvents()
    {
        $address = Yii::$app->request->get('address');
        // $data['detail'] = $this->blockExplorerComponent->getAllEvents($address, 'bitcoin', 1000);
        $data['detail'] = $this->blockExplorerComponent->getAllEvents($address, 'bitcoin', 1000);
        // $data['duplicate_addresses'] = $this->blockExplorerComponent->countDuplicateAddresses($detail);
        // $data['total_detail'] = count($detail);
        // $data['total_duplicate_addresses'] = count($data['duplicate_addresses']);
        // $data['total_duplicate_addresses_BTC'] = array_sum(array_column($data['duplicate_addresses'], 'amount_btc'));
        $this->res->data = $data;
        $this->res->message = 'All events - fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }
}
