<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\components\parser\hifi\HiFiItems;
use app\components\parser\hifi\HiFiNews;
use app\components\parser\hifi\HiFiReviews;

class ParserhifiController extends Controller
{
    public function actionItems()
    {
        $this->_checkEnv();
        require_once Yii::getAlias('@app') . '/components/Parser/HiFi4All/HiFiItems.php';
        (new HiFiItems())->run();
    }

    public function actionNews()
    {
        $this->_checkEnv();
        require_once Yii::getAlias('@app') . '/components/Parser/HiFi4All//HiFiNews.php';
        (new HiFiNews())->run();
    }

    public function actionReviews()
    {
        $this->_checkEnv();
        require_once Yii::getAlias('@app') . '/components/Parser/HiFi4All//HiFiReviews.php';
        (new HiFiReviews())->run();
    }

    private function _checkEnv()
    {
        if (YII_ENV_DEV) {
            echo "Command does not work under DEV environment.\r\n";
            exit(0);
        }
    }
}
