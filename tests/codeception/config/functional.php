<?php
$_SERVER['SCRIPT_FILENAME'] = YII_TEST_ENTRY_FILE;
$_SERVER['SCRIPT_NAME'] = YII_TEST_ENTRY_URL;

require_once Yii::getAlias('@tests') . '/codeception/common/TestCommon.php';

/**
 * Application configuration for functional tests
 */
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../../config/web.php'),
    require(__DIR__ . '/config.php'),
    [
        'params' => [
            'hosts' => 'http://local.marketplace.nerds/index-test.php',
        ]
    ]
);
