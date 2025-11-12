<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\services\CustomerService;
use app\services\OrderService;
use app\services\ItemService;
use app\services\MailService;
use app\services\QueueService;
use app\services\BlockExplorerService;
use app\common\helper\response\ResponseHelper;
use app\components\BlockExplorerComponent;

class BaseCommand extends Controller
{
    // /**
    //  * @var CustomerService
    //  */
    // protected $customerService;
    
    // /**
    //  * @var OrderService
    //  */
    // protected $orderService;

    // /**
    //  * @var ItemService
    //  */
    // protected $itemService;

    // /**
    //  * @var MailService
    //  */
    // protected $mailService;

    // /**
    //  * @var QueueService
    //  */
    // protected $queueService;

    /**
     * @var BlockExplorerService
     */
    protected $blockExplorerService;

    /**
     * @var BlockExplorerComponent
     */
    protected $blockExplorerComponent;

    /**
     * @var ResponseHelper
     */
    protected $res;

    public function init()
    {
        parent::init();
        $this->res = new ResponseHelper();
        // $this->customerService = Yii::$app->customerService;
        // $this->orderService = Yii::$app->orderService;
        // $this->itemService = Yii::$app->itemService;
        // $this->mailService = Yii::$app->mailService;
        // $this->queueService = Yii::$app->queueService;
        $this->blockExplorerService = Yii::$app->blockExplorerService;

        $this->blockExplorerComponent = Yii::$app->blockExplorerComponent;
    }
}
