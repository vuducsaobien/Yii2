<?php

namespace app\services;

use Yii;
use app\models\Customer;
use app\models\Country;
use app\models\Order;
use app\models\Item;
use app\components\BlockExplorerComponent;

class BaseService
{
    /**
     * @var BlockExplorerComponent
     */
    protected $blockExplorerComponent;

    // public function init()
    // {
    //     parent::init();
    //     $this->blockExplorerComponent = Yii::$app->blockExplorerComponent;
    // }

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
        $this->blockExplorerComponent = Yii::$app->blockExplorerComponent;
    }
}
