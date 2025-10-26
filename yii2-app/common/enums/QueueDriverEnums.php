<?php

namespace app\common\enums;

use yii\base\BaseObject;

/**
 * class QueueDriverEnums
 */
class QueueDriverEnums extends BaseObject
{
    const SYNCHRONOUS = 'sync';
    const FILE = 'file';
    const DB = 'db';
    const REDIS = 'redis';
    const RABBIT_MQ = 'rabbitmq';
    const AMQP_INTERROP = 'ampq';
    const BEANSTALK = 'beanstalk';
    const GEARMAN = 'gearman';
    const AWS_SQS = 'aws_sqs';
    const STOMP = 'stomp';
}