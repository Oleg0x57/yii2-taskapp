<?php
return [
    'id' => 'taskapp',
    'basePath' => dirname(__DIR__),
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'defaultRoute' => 'task/task',
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1',],
        ],
        'task' => ['class' => 'app\modules\task\Module', 'defaultRoute' => 'task'],
        'user' => ['class' => 'app\modules\user\Module'],
        'api' => ['class' => 'app\modules\api\Module'],
        'post' => ['class' => 'app\modules\post\Module', 'defaultRoute' => 'post'],
        'spa' => ['class' => 'app\modules\spa\Module',],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'request' => [
            'cookieValidationKey' => 'yourSecretKeyHere',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => ['class' => 'yii\rest\UrlRule', 'controller' => 'api/task'],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'log' => [
            'class' => 'yii\log\Dispatcher',
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
    ],
];
