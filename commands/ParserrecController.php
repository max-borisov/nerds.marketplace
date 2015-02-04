<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\components\parser\recordere\RecNews;

class ParserrecController extends Controller
{
    public function actionNews()
    {
        $this->_checkEnv();
        require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecNews.php';
        (new RecNews())->run();
    }

    public function actionReviews()
    {
        echo "Rec reviews\r\n";

        /*$this->_checkEnv();
        require_once Yii::getAlias('@app') . '/components/Parser/Recordere//RecReviews.php';
        (new RecReviews())->run();*/
    }

    private function _checkEnv()
    {
        if (YII_ENV_DEV) {
            echo "Command does not work under DEV environment.\r\n";
            exit(0);
        }
    }
}
