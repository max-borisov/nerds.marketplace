<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\components\parser\dba\DbaItems;

class ParserdbaController extends Controller
{
    public function actionItems()
    {
        $this->_checkEnv();
        require_once Yii::getAlias('@app') . '/components/Parser/Dba/DbaItems.php';
        (new DbaItems())->run();
    }

    private function _checkEnv()
    {
        if (YII_ENV_DEV) {
            echo "Command does not work under DEV environment.\r\n";
            exit(0);
        }
    }
}
