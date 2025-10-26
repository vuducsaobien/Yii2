https://www.yiiframework.com/extension/yiisoft/yii2-queue/doc/guide/2.3/en/usage
https://www.yiiframework.com/extension/yiisoft/yii2-queue/doc/guide/2.0/en/driver-sync
Các queue drive cung cấp trong Yii:
    1. Syncronous: Thực hiện ngay lập tức
        Runs tasks syncronously in the same process if handle property is turned on. Could be used when developing and debugging application.
        Configuration example:

        ```php config/web.php || config/console.php
            return [
                'components' => [
                    'queue' => [
                        'class' => \yii\queue\sync\Queue::class,
                        'handle' => true, // if tasks should be executed immediately
                        // 'handle' => false, // không chạy ngay lập tức
                    ],
                ],
            ];

            Làm:
            $jobId = Yii::$app->queue->push(new SendMailJob([
                'to' => env('MAILER_TO')
            ]));
        ```
        Đối với setting Driver Syncronous trong commit này, thì checkStatus Queue (isWaiting, isReserved, isDone) không được.
        Vì Driver này phải có chỗ để lưu Status

        ```php config/web.php || config/console.php
            Debug: email_log.log
            {
                "message": "START at: 2025-10-26 11:36:46"
            }
            {
                "message": "Email sent successfully at 2025-10-26 11:36:46"
            }
        ```
        => Kiểm tra 2 biến now, thấy gần như ngay lập tức (hoặc Queue thực hiện ngay lập tức)

        ```php config/web.php || config/console.php
            return [
                'components' => [
                    'queue' => [
                        'class' => \yii\queue\sync\Queue::class,
                        'handle' => false, // không chạy ngay lập tức
                    ],
                ],
            ];
        ```
        => Mail chưa được gửi ngay lập tức, không thể dùng các hàm checkStatus để kiểm tra queue này được.
        => Driver này thích hợp dùng để debug code (Vì nó chạy ngay lặp tức, không cần dùng file, db hay Redis gì cả)



