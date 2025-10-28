https://www.yiiframework.com/extension/yiisoft/yii2-queue/doc/guide/2.3/en/debug

    Debugging
    During development you may want to add a panel for the Yii2 debug module. The panel displays a counter and a list of queued tasks.
    The yiisoft/yii2-debug module should be installed in your application for the panel to be displayed.
    Configure your application like the following:

    ```php config/web.php || config/console.php
        return [
            'modules' => [
                'debug' => [
                    'class' => \yii\debug\Module::class,
                    'panels' => [
                        'queue' => \yii\queue\debug\Panel::class,
                    ],
                ],
            ],
        ];
    ```

    => Vào http://localhost:8080/debug/default/index hoặc http://localhost:8080/debug/default/view?panel=queue&tag=6900e50abf32e
    Sẽ có thêm menu dành riêng cho Queue để debug
