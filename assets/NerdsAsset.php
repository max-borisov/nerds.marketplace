<?php

namespace app\assets;

use yii\web\AssetBundle;

class NerdsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/application.css',
        'css/jquery.fileupload-ui.css',
    ];
    public $js = [
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        '\app\assets\BootstrapAsset',
        '\app\assets\LightBoxAsset',
    ];
}
