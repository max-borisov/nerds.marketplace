<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\helpers\VarDumper;

class Utility extends Component
{
    public static function end()
    {
        Yii::$app->end();
    }

    public static function dump($data, $terminate = false)
    {
        echo '<pre>';
        VarDumper::dump($data, 10, true);
        echo '</pre>';

        if (true === $terminate) {
            self::end();
        }
    }
}