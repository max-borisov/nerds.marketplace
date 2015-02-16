<?php
/**
 * Application configuration for acceptance tests
 */

//$_SERVER['SCRIPT_FILENAME'] = YII_TEST_ENTRY_FILE;
//$_SERVER['SCRIPT_NAME'] = YII_TEST_ENTRY_URL;

//require_once Yii::getAlias('@tests') . '/codeception/common/TestCommon.php';

return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../../config/web.php'),
    require(__DIR__ . '/config.php'),
    [
        /*'params' => [
            'hosts' => 'http://local.marketplace.nerds/index-test.php',
        ]*/
    ]
);
