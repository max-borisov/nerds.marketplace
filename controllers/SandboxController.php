<?php

namespace app\controllers;

use app\models\PhpbbUser;
use app\models\UsedItem;
use app\models\UsedItemPhoto;
use app\models\UsedItemType;
use Yii;
use yii\web\Controller;
use yii\helpers;
use app\models\Category;
use app\components\HelperBase;
use app\components\HelperSignUp;
use app\components\HelperUser;

use yii\imagine\Image;

use yii\bootstrap\BootstrapAsset;

class SandboxController extends Controller
{
    public function actionIndex()
    {
//        HelperBase::dump(Yii::$app->user->identity->username);

//        HelperBase::dump(HelperUser::isGuest());
//        HelperBase::dump(HelperUser::uid());
//        HelperBase::dump(HelperUser::uIdentity());
//        HelperBase::dump(HelperUser::uIdentityParam('username'));

//        HelperBase::dump(PhpbbUser::find()->where('user_id = :uid', [':uid' => 48])->one()->items);

//        HelperBase::dump(PhpbbUser::find()->where('user_id = :uid', [':uid' => 1])->one());
//        HelperBase::dump((new PhpbbUsers)->hasItems(490));

//        HelperBase::dump((new UsedItemType)->prepareList());
//        HelperBase::dump(UsedItemType::find(1)->one()->items);
//        HelperBase::dump(UsedItem::find(2)->one()->type);

//            $boot = new BootstrapAsset();
//            HelperBase::dump($boot->css);

//        $photo = UsedItemPhoto::find('1')->one();
//        HelperBase::dump($photo);
//        HelperBase::dump($photo->thumb);
//        HelperBase::dump($photo->original);

        /*$_GET['UsedItem']['search_text'] = '';
        $_GET['UsedItem']['price_min'] = '10';
        $_GET['UsedItem']['price_max'] = '10000';
        HelperBase::dump(Yii::$app->request->get());
        HelperBase::dump((new UsedItem)->search(Yii::$app->request->get()));*/

//        $passw = 'max';
//        echo $hash = Yii::$app->security->generatePasswordHash($passw);

//        $h = '$2y$13$978qTmEzCMExd2gSbdZxZugncXai1Bs88MCbd/NhizAgWhY8UAxaW';
//        echo Yii::$app->security->validatePassword($passw, $h);*/


        /*$params = ['name' => 'max', 'email' => 'email'];
        $res = HelperBase::curl('http://local.marketplace.nerds/phpbb.php', [
            'method' => 'post',
            'post_fields' => $params,
        ]);
        HelperBase::dump($res);*/

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

    public function actionLogin()
    {
//        HelperBase::dump(Yii::$app->user->isGuest);
//        HelperBase::dump(Yii::$app->user->identity->user_permissions);
//        HelperBase::dump($this->goHome());
//        $this->redirect($this->goHome());
    }

    public function actionLog()
    {
//        Yii::warning('start calculating average revenue');
//        HelperBase::logger('Test msg', '', ['id' => 'name']);
    }

    public function actionModel()
    {
//        $model = new Category;
//        HelperBase::dump($model->validate());
//        HelperBase::dump($model->validate('title'));
//        HelperBase::dump($model->errors);
//        HelperBase::dump($model->prepareDropDown());
//        HelperBase::dump($model->attachedItems);

//        $items = Category::find(1)->attachedItems;
//        $item = UsedItem::findOne(2);
//        HelperBase::dump($item->attributes);
//        HelperBase::dump($item->preview);
    }
}