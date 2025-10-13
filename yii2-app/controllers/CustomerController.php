<?php

namespace app\controllers;

use app\common\helper\response\ApiConstant;
use app\controllers\BaseController;

class CustomerController extends BaseController
{
    public function actionIndex()
    {
        // /*
            // $data = $this->customerService->getList();
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
                | 6        | 3                 |
                | 7        | 3                 |

                --- Country table ---
                | country_Id | country_Name |
                |------------|--------------|
                | 1          | Vietnam      |
                | 2          | China        |
                | 3          | Lao          |
                | 4          | Cambodia     |
                | 5          | Thailand     |
                | 6          | Malaysia     |

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

                => SELECT * FROM `country` WHERE `country_Id`= 1,1,1,2,3
                Vì table Customer có customer_Country_id = 1,1,1,2,3
                nên nó sẽ query đúng.
                Hoặc SELECT * FROM `customer` => Nó sẽ biết phải query country_Id từ customer_Country_id
                nên sẽ lấy chính xác Country table

                Hoặc có 5 Customer record nhưng chỉ có 3 Country (country_Id = 1,2,3)

                => Còn SELECT * FROM `order` WHERE `order_Customer_id`=1,2,3,4,5
                mà không phải SELECT * FROM `order` WHERE `order_Id` =1,2,3,4,5,...
                vì order table có Foreign key là order_Customer_id 
                (Liên kết order_Customer_id - table Order với customer_Id - table Customer)
                Để làm rõ, sẽ tăng record bảng Order lên 6 record hoặc cao hơn

                => Vẫn chỉ lấy đến
                SELECT * FROM `order` WHERE `order_Customer_id`=5
                Vì customer_Id max là 5
                => Nên chỉ lấy SELECT * FROM `order` WHERE `order_Customer_id`=5 là tối đa
        // */

        
        // /*
            $data = $this->customerService->getListWithRelations(['orders', 'country']);

            /*
                SELECT * FROM `customer` (customer_Id = 1, 2, 3, 4, 5)
                SELECT * FROM `order` WHERE `order_Customer_id` IN (1, 2, 3, 4, 5)
                SELECT * FROM `country` WHERE `country_Id` IN (1, 2, 3)
        // */

        /*
            $data = $this->customerService->getListWithRelations(['orders']);
        // */

        $this->res->data = $data;
        $this->res->message = 'Customers fetched successfully';
        $this->res->status = ApiConstant::STATUS_OK;
        return $this->res->build();
    }

}
