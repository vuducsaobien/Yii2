2. File
    https://www.yiiframework.com/extension/yiisoft/yii2-queue/doc/guide/2.3/en/driver-file
        The file driver uses files to store queue data.
        Configuration example:

    ```php config/web.php || config/console.php
        return [
            'bootstrap' => [
                'queue', // The component registers its own console commands
            ],
            'components' => [
                'queue' => [
                    'class' => \yii\queue\file\Queue::class,
                    'path' => '@runtime/queue',
                ],
            ],
        ];
    ```
    - Console
    Console commands are used to execute and manage queued jobs
        - `yii queue/listen [timeout]`

    The `listen` command launches a daemon which infinitely queries the queue. 
    If there are new tasks they're immediately obtained and executed. 
    The `timeout` parameter specifies the number of seconds to sleep between querying the queue. 
    This method is most efficient when the command is properly daemonized via `supervisor` or `systemd`.
        - `yii queue/run`

    The `run` command obtains and executes tasks in a loop until the queue is empty. This works well with `cron`.
    The `run` and `listen` commands have options:
        `--verbose`, `-v`: print execution statuses to console.
        `--isolate`: each task is executed in a separate child process.
        `--color`: enable highlighting for verbose mode.

        - `yii queue/info`

    The `info` command prints out information about the queue status.
        - `yii queue/clear`
    The clear command clears the queue.
        - `yii queue/remove [id]`
    The `remove` command removes a job from the queue.

Link:
    `supervisor`
        https://www.yiiframework.com/extension/yiisoft/yii2-queue/doc/guide/2.3/en/worker#supervisor
    `systemd`
        https://www.yiiframework.com/extension/yiisoft/yii2-queue/doc/guide/2.3/en/worker#systemd
    `cron`
        https://www.yiiframework.com/extension/yiisoft/yii2-queue/doc/guide/2.3/en/worker#cron

=> http://localhost:8080/queue/driver-file
=> trong /runtime xuất hiện 2 file index.data & job1.data
    docker exec yii2-learning php /var/www/html/yii2-app/yii queue/info
        Jobs
        - waiting: 1
        - delayed: 0
        - reserved: 0
        - done: 0