<?php

// Include ENV constants
$envConfigFile = __DIR__ . '/../config/env-local.php';
if (!file_exists($envConfigFile)) {
    exit("config/env-local.php does not exists.\r\n");
}
require($envConfigFile);

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
