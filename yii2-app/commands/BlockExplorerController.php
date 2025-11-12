<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\ExitCode;
use Yii;
use app\common\helper\response\ApiConstant;
use app\commands\BaseCommand;

class BlockExplorerController extends BaseCommand
{
    /**
     * php yii block-explorer/index
     * This command echoes what you have entered as the message.
     */
    public function actionIndex()
    {
        $timeStart = microtime(true);
        // $address = '3Pja5FPK1wFB9LkWWJai8XYL1qjbqqT9Ye';
        // $address = 'bc1q6kf7mzagkxk537lr8x2y9majjalng9tfvz8mcm';
        $address = 'bc1q5ncqdn3za2s26awd9ewcqtuep40r7lcmzuad8r';
        $detail = $this->blockExplorerComponent->getAllEvents($address, 'bitcoin', 1000);
        // $data['duplicate_addresses'] = $this->blockExplorerComponent->countDuplicateAddresses($detail);
        // $data['total_detail'] = count($detail);
        // $data['total_duplicate_addresses'] = count($data['duplicate_addresses']);
        // $data['total_duplicate_addresses_BTC'] = array_sum(array_column($data['duplicate_addresses'], 'amount_btc'));
        $timeEnd = microtime(true);
        $time = $timeEnd - $timeStart;
        $data['time'] = $time;
        writeLog($detail, 'block_explorer.log');
    }
}
