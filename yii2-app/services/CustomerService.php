<?php

namespace app\services;

class CustomerService extends BaseService
{
    public function getCustomers(): array
    {
        $data = $this->customerModel::find()->all();
        return $data;
    }
}
