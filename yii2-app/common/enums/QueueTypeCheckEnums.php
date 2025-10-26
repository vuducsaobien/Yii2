<?php

namespace app\common\enums;

use yii\base\BaseObject;

/**
 * class QueueTypeCheckEnums
 */
class QueueTypeCheckEnums extends BaseObject
{
    const IS_WAITING = 'isWaiting';
    const IS_RESERVED = 'isReserved';
    const IS_DONE = 'isDone';
}