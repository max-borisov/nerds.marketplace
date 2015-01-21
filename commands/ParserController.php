<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\components\HiFi4AllParser;

class ParserController extends Controller
{
    public function actionHifi4all()
    {
        if (YII_ENV_DEV) {
            echo "Command does not work under DEV environment.\r\n";
        } else {
            HiFi4AllParser::copyData();
        }
//        print_r(get_loaded_extensions());
    }
}
