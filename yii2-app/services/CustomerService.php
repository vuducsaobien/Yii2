<?php

namespace app\services;

class CustomerService extends BaseService
{
    public function getCustomers(): array
    {
        $data = $this->customerModel::find()->all();
        return $data;
    }

    public function getCustomersWithOrders(): array
    {
        $data = $this->customerModel::find()->with('orders', 'country')->all();
        /*
            Các câu query:
            SELECT * FROM customer
            Has many : SELECT * FROM `order` WHERE `customer_id` IN (1, 2, 3, 4, 5) (Tất cả Customer hiện có trong table Customer)
            Has one: SELECT * FROM `country` WHERE `id` IN (1, 2, 3) (Tất cả country_id trong table Customer)

            hasOne (1-1):
                Đảm bảo: Mỗi Customer chỉ có 1 Country
                Tối ưu: Chỉ cần lấy các Country record cần thiết

            hasMany (1-n):
                Không đảm bảo: Mỗi Customer có bao nhiêu Orders
                An toàn: Lấy tất cả để đảm bảo không thiếu data
        */
        return $data;
    }
}
