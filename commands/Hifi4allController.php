<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use app\components\hifi4all\HiFi4AllMarket;
use app\components\hifi4all\HiFi4AllNews;
use yii\console\Controller;
use app\components\HiFi4AllParser;

class Hifi4allController extends Controller
{
    public function actionItems()
    {
        $this->_checkEnv();
        require_once Yii::getAlias('@app') . '/components/HiFi4AllParser/HiFi4AllMarket.php';
        (new HiFi4AllMarket())->run();
    }

    public function actionNews()
    {
        $this->_checkEnv();
        require_once Yii::getAlias('@app') . '/components/HiFi4AllParser/HiFi4AllNews.php';
        (new HiFi4AllNews())->run();
    }

    private function _checkEnv()
    {
        if (YII_ENV_DEV) {
            echo "Command does not work under DEV environment.\r\n";
            exit(0);
        }
    }
}
