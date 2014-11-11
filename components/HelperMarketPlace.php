<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\imagine\Image;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class HelperMarketPlace extends Component
{
    public static $sortOptions = [
        ['label' => 'Price Up'      ,   'value' => 'price-up'   ,   'order' => 'price ASC'],
        ['label' => 'Price down'    ,   'value' => 'price-down' ,   'order' => 'price DESC'],
        ['label' => 'New first'     ,   'value' => 'new-first'  ,   'order' => 'created_at DESC'],
        ['label' => 'New last'      ,   'value' => 'new-last'   ,   'order' => 'created_at ASC'],
    ];

    /**
     * Process uploaded item photo
     * @param $model
     */
    public static function saveItemPhoto($model)
    {
        $thumbParams    = HelperBase::getParam('thumb');
        $original       = Yii::getAlias('@photo_original_path')  . '/' . $model->preview . $thumbParams['extension'];
        $thumb          = Yii::getAlias('@photo_thumb_path')     . '/' . $model->preview . $thumbParams['extension'];
        $model->file->saveAs($original);
        Image::thumbnail($original, $thumbParams['width'], $thumbParams['height'])
            ->save($thumb, ['quality' => $thumbParams['quality']]);
    }

    public static function generateSortDropDown($view)
    {
        $queryParams = Yii::$app->request->queryParams;
        $selected = '';

        if ($queryParams) {
            if (isset($queryParams['sort'])) {
                unset($queryParams['sort']);
            }
            $queryParams = str_replace(['/', '?'], '', $queryParams);
            $queryParams = '?' . http_build_query($queryParams);
        } else {
            $queryParams = '?';
        }
        $view->registerJs("var siteUrl = '" . $queryParams . "';", View::POS_HEAD, 'site-url');
        return $dropDown = Html::dropDownList('', $selected, ArrayHelper::map(self::$sortOptions, 'value', 'label'), ['prompt' => '', 'class' => 'form-control', 'id' => 'sort']);
    }

    public static function getSortParamForItemsList()
    {
        $defaultSort = 'id DESC';
        $queryParam = Yii::$app->request->get('sort');
        $sortOptions = ArrayHelper::map(self::$sortOptions, 'value', 'order');
        if ($queryParam && isset($sortOptions[$queryParam])) {
            return $sortOptions[$queryParam];
        } else {
            return $defaultSort;
        }
    }
}