<?php

namespace app\assets;

use yii\web\AssetBundle;

class LightBoxAsset extends AssetBundle
{
    public $sourcePath = '@bower/ekko-lightbox';
    public $baseUrl = '@web';
    public $css = [
        'dist/ekko-lightbox.min.css',
    ];
    public $js = [
        'dist/ekko-lightbox.min.js',
    ];
}
