<?php

namespace app\controllers;

use app\models\UsedItem;
use Yii;
use yii\web\Controller;
use yii\helpers;
use app\models\Category;
use app\components\HelperBase;
use app\components\HelperSignUp;

use yii\imagine\Image;

class SandboxController extends Controller
{
    public function actionIndex()
    {
        HelperSignUp::addUser();


//        $category = Category::find()->where('id = 3')->one();
//        $category = Category::findOne(3);
//        Utility::dump($category->attributes);

//        $items = $category->attachedItems;
//        Utility::dump($items);

//        Utility::dump((new Category())->prepareDropDown());

//        HelperBase::dump(HelperBase::getParam('thumb12')['width']);

//        $model = UsedItem::find()->where(['id' => 4])->count();
//        $model = UsedItem::find()->where(['id' => 17])->one();
//        HelperBase::dump($model->photos);

    }

    public function actionPhoto()
    {
        // frame, rotate and save an image
        /*Image::frame(Yii::getAlias('@webroot') . '/images/wall.jpg', 5, '666', 0)
            ->rotate(-8)
            ->save(Yii::getAlias('@thumbs') . '/wall_new.jpg', ['quality' => 50]);*/

//        Image::thumbnail(Yii::getAlias('@webroot') . '/images/wall.jpg', 150, 100)
//            ->rotate(-8)
//            ->save(Yii::getAlias('@thumbs') . '/wall_thumb.jpg', ['quality' => 50]);
    }
}
