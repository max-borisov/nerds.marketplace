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
    // Data for sort drop down list
    public static $sortOptions = [
        ['label' => 'Cheap first'   ,   'value' => 'cheap-first'    ,   'order' => 'price ASC'],
        ['label' => 'Cheap last'    ,   'value' => 'cheap-last'     ,   'order' => 'price DESC'],
        ['label' => 'New first'     ,   'value' => 'new-first'      ,   'order' => 'created_at DESC'],
        ['label' => 'New last'      ,   'value' => 'new-last'       ,   'order' => 'created_at ASC'],
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

    /**
     * Get drop down html code
     * @param $view Web view
     * @return string
     */
    public static function generateSortDropDown($view)
    {
        $selected = '';
        $queryParams = Yii::$app->request->queryParams;
        // If there are GET params
        if ($queryParams) {
            if (isset($queryParams['sort'])) {
                $selected = $queryParams['sort'];
                unset($queryParams['sort']);
            }
            $queryParams = str_replace(['/', '?'], '', $queryParams);
            $queryParams = '?' . http_build_query($queryParams);
        } else {
            $queryParams = '?';
        }
        // Pass JS variable to view
        $view->registerJs("var siteUrl = '" . $queryParams . "';", View::POS_HEAD, 'site-url');
        return $dropDown = Html::dropDownList(
            '',
            $selected,
            ArrayHelper::map(self::$sortOptions, 'value', 'label'),
            ['prompt' => '', 'class' => 'form-control', 'id' => 'sort']
        );
    }

    public static function getSortParamForItemsList()
    {
        // default order
        $defaultSort    = 'id DESC';
        $queryParam     = Yii::$app->request->get('sort');
        // Get order types
        $sortOptions    = ArrayHelper::map(self::$sortOptions, 'value', 'order');
        if ($queryParam && isset($sortOptions[$queryParam])) {
            // Get specified order
            return $sortOptions[$queryParam];
        } else {
            return $defaultSort;
        }
    }
}