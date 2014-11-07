<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\helpers\VarDumper;

class HelperBase extends Component
{
    /**
     * Terminate app
     */
    public static function end()
    {
        Yii::$app->end();
    }

    /**
     * Print variable
     * @param mixed $data Number/string/array/object to be printed
     * @param bool $terminate Whether terminate app or not
     */
    public static function dump($data, $terminate = false)
    {
        echo '<pre>';
        VarDumper::dump($data, 10, true);
        echo '</pre>';

        if (true === $terminate) {
            self::end();
        }
    }

    /**
     * Get specified app parameter
     * @param $key Param name
     * @return mixed
     */
    public static function getParam($key)
    {
        return Yii::$app->params[$key];
    }
}