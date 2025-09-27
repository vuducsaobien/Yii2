<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\models\Customer;
use app\common\helper\response\ApiConstant;

class CustomerController extends BaseController
{
    public function actionIndex()
    {
        /*
            A. N+1 problem (Lazy loading)
                $customers = Customer::find()->all();
                Với trường hợp này:
                    1. SELECT * FROM customer
                    2. SELECT * FROM country WHERE id = 1
                    3. SELECT * FROM `country` WHERE `id`=1
                    4. SELECT * FROM `country` WHERE `id`=2
                - Khi query tất cả các customer, nó sẽ sinh ra 1 query để lấy tất cả các customer
                - và 1 query để lấy thông tin của từng country của từng customer
                - => Tổng cộng 4 query => N+1 problem

            B. Eager loading
            $customers = Customer::find()->with('country')->all();
            Với trường hợp này:
                1. SELECT * FROM customer
                2. SELECT * FROM country WHERE id IN (1, 2)
            - => Tổng cộng 2 query => N+1 problem đã giải quyết

            C. Eager loading với nhiều mối quan hệ
            $customers = Customer::find()->with('country', 'city')->all();
        */
        
        // $customers = Customer::find()->all();
        $customers = Customer::find()->with('country')->all();

        $this->res->data = $customers;
        $this->res->message = 'Customers fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }
}
