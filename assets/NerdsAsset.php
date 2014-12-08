<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class NerdsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/application.css',
        'css/ekko-lightbox.min.css',
    ];
    public $js = [
        'js/ekko-lightbox.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',

        // include original file
         'yii\bootstrap\BootstrapAsset',

        // include min file
//        '\app\components\NrdBootstrapAsset',
    ];
}
