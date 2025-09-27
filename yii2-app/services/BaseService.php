<?php

namespace app\services;

use app\models\Customer;

class BaseService
{
    public $customerModel;
    
    public function __construct()
    {
        $this->customerModel = new Customer();
    }
}
