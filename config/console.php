<?php

Yii::setAlias('@tests', __DIR__ . '/tests');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db-local.php');

return [
    'id' => 'basic-console',
    'basePath' => __DIR__,
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];
