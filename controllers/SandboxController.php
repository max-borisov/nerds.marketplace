<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers;
use app\models\Category;
use app\components\Utility;

class SandboxController extends Controller
{
    public function actionIndex()
    {
//        $category = Category::find()->where('id = 3')->one();
//        $category = Category::findOne(3);
//        Utility::dump($category->attributes);

//        $items = $category->attachedItems;
//        Utility::dump($items);


        Utility::dump((new Category())->prepareDropDown());

    }
}
