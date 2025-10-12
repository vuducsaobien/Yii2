<?php

namespace app\controllers;

use app\common\helper\response\ApiConstant;
use app\controllers\BaseController;

class CustomerController extends BaseController
{
    public function actionIndex()
    {
        // /*
            $data = $this->customerService->getList();
            /*

                --- Customer table ---
                | customer_Id | customer_Country_id |
                |-------------|---------------------|
                | 1           | 1                   |
                | 2           | 1                   |
                | 3           | 1                   |
                | 4           | 2                   |
                | 5           | 3                   |       

                --- Order table ---
                | order_Id | order_Customer_id |
                |----------|-------------------|
                | 1        | 1                 |
                | 2        | 2                 |
                | 3        | 2                 |
                | 4        | 3                 |
                | 5        | 3                 |
                
                SELECT * FROM `customer`
                SELECT * FROM `country` WHERE `country_Id`=1
                SELECT * FROM `order` WHERE `order_Customer_id`=1

                SELECT * FROM `country` WHERE `country_Id`=1
                SELECT * FROM `order` WHERE `order_Customer_id`=2

                SELECT * FROM `country` WHERE `country_Id`=1
                SELECT * FROM `order` WHERE `order_Customer_id`=3

                SELECT * FROM `country` WHERE `country_Id`=2
                SELECT * FROM `order` WHERE `order_Customer_id`=4

                SELECT * FROM `country` WHERE `country_Id`=3
                SELECT * FROM `order` WHERE `order_Customer_id`=5
        // */

        /*
            Customer table
            | customer_Id | customer_Country_id |
            |-------------|---------------------|
            | 1           | 1                   |
            | 2           | 1                   |
            | 3           | 1                   |
            | 4           | 2                   |
            | 5           | 3                   |       
        // /*

        /*
        // /*
        
        /*
            $data = $this->customerService->getListWithRelations(['orders', 'country']);

            /*
        // */

        /*
            $data = $this->customerService->getListWithRelations(['orders']);
        // */

        $this->res->data = $data;
        $this->res->message = 'Customers fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }

    public function actionViaRelation()
    {
        $data = $this->customerService->getOrdersWithItemsViaRelation();
        $this->res->data = $data;
        $this->res->message = 'Orders with items via() relation fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }

    public function actionCustomerItemsViaRelation()
    {
        $data = $this->customerService->getCustomersWithItemsViaRelation();
        $this->res->data = $data;
        $this->res->message = 'Customers with items via() relation fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }

    public function actionWithCountry()
    {
        $data = $this->customerService->getCustomersWithCountry();
        $this->res->data = $data;
        $this->res->message = 'Customers with country (hasOne) relation fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }

    public function actionCountryInfo($id)
    {
        $data = $this->customerService->getCustomerWithCountryInfo($id);
        $this->res->data = $data;
        $this->res->message = 'Customer with country info (hasOne) fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }

    public function actionCountryCustomers($id)
    {
        $data = $this->customerService->getCountryWithCustomers($id);
        $this->res->data = $data;
        $this->res->message = 'Country with customers (hasMany) fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }
}
