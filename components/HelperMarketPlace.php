<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\imagine\Image;
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\components\HelperBase;

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
     * @throws \yii\base\Exception
     */
    public static function saveItemPhoto($model)
    {
        if (!($model instanceof \app\models\ItemPhoto)) {
            throw new Exception('Incorrect instance passed');
        }
        $thumbParams    = HelperBase::getParam('thumb');
        // name shipped with extension
        $original       = Yii::getAlias('@photo_original_path')  . '/' . $model->name;
        $thumb          = Yii::getAlias('@photo_thumb_path')     . '/' . $model->name;
        if ($model->file->saveAs($original)) {
            Image::thumbnail($original, $thumbParams['width'], $thumbParams['height'])
                ->save($thumb, ['quality' => $thumbParams['quality']]);
        } else {
            HelperBase::logger('Uploaded file could not be saved', null, ['filename' => $model->name]);
        }
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

    /**
     * Make long description shorter
     * @param $description Description text
     * @param $maxLen max text length
     * @return string
     */
    public static function makeShortDescription($description, $maxLen)
    {
        if (strlen($description) <= $maxLen) return $description;

        // Get first several sentences
        $split = explode('.', substr($description, 0, $maxLen));
        array_pop($split);
        return implode('.', $split) . '.';
    }
}