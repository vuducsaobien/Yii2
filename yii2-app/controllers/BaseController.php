<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\services\CustomerService;
use app\common\helper\response\ResponseHelper;

class BaseController extends Controller
{
    /**
     * @var CustomerService
     */
    protected $customerService;

    /**
     * @var ResponseHelper
     */
    protected $res;

    public function init()
    {
        parent::init();
        $this->res = new ResponseHelper();
        $this->customerService = Yii::$app->customerService;
    }
}
