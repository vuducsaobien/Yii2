<?php

namespace app\services;

use app\models\Customer;

class BaseService
{
    protected $customerModel;
    
    public function __construct()
    {
        $this->customerModel = new Customer();
    }
}
