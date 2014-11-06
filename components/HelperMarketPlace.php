<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\imagine\Image;
use app\components\HelperBase;

class HelperMarketPlace extends Component
{
    public static function saveItemPhoto($model)
    {
        $thumbParams    = HelperBase::getParam('thumb');
        $original       = Yii::getAlias('@photo_original_path')  . '/' . $model->preview . $thumbParams['extension'];
        $thumb          = Yii::getAlias('@photo_thumb_path')     . '/' . $model->preview . $thumbParams['extension'];
        $model->file->saveAs($original);
        Image::thumbnail($original, $thumbParams['width'], $thumbParams['height'])
            ->save($thumb, ['quality' => $thumbParams['quality']]);
    }
}