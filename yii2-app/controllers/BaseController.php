<?php

namespace app\controllers;

use yii\web\Controller;
use app\common\helper\response\ResponseHelper;

class BaseController extends Controller
{
    public $res;
    public function init()
    {
        parent::init();
        $this->res = new ResponseHelper();
    }
}
