<?php

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'marketplace/index',

    'components' => [
        'urlManager' => require(__DIR__ . '/routes.php'),
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            /*'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,*/
            'identityClass' => 'app\models\PhpbbUser',
            'enableAutoLogin' => false,
            'loginUrl' => ['session/signin'],
            'returnUrl' => '/',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db-local.php'),
    ],
    'params' => require(__DIR__ . '/params.php'),
    'aliases' => [
        '@photo_thumb_path'     => __DIR__ . "/../web/thumb",
        '@photo_thumb_url'      => '/thumb',
        '@photo_original_path'  => __DIR__ . "/../web/original",
        '@photo_original_url'   => '/original',
    ],
];

$config = array_merge_recursive(
    $config,
    require(__DIR__ . '/web-local.php')
);

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
