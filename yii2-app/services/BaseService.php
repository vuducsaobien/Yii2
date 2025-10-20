<?php

namespace app\services;

use app\models\Customer;
use app\models\Country;
use app\models\Order;
use app\models\Item;
class BaseService
{
    protected $customerModel;
    protected $countryModel;
    protected $orderModel;
    protected $itemModel;
    
    public function __construct()
    {
        $this->customerModel = new Customer();
        $this->countryModel = new Country();
        $this->orderModel = new Order();
        $this->itemModel = new Item();
    }
}
