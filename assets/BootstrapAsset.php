<?php

namespace app\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap';
    public $baseUrl = '@web';
    public $css = [
        'dist/css/bootstrap.min.css',
    ];
    public $js = [
        'dist/js/bootstrap.min.js',
    ];
}
