<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\services\CustomerService;
use app\services\OrderService;
use app\services\ItemService;
use app\services\MailService;
use app\common\helper\response\ResponseHelper;
class BaseController extends Controller
{
    /**
     * @var CustomerService
     */
    protected $customerService;
    
    /**
     * @var OrderService
     */
    protected $orderService;

    /**
     * @var ItemService
     */
    protected $itemService;

    /**
     * @var MailService
     */
    protected $mailService;

    /**
     * @var ResponseHelper
     */
    protected $res;

    public function init()
    {
        parent::init();
        $this->res = new ResponseHelper();
        $this->customerService = Yii::$app->customerService;
        $this->orderService = Yii::$app->orderService;
        $this->itemService = Yii::$app->itemService;
        $this->mailService = Yii::$app->mailService;
    }
}
