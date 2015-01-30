<?php

namespace app\controllers;

use app\components\FeedParser;
use app\components\HelperMarketPlace;
use app\components\hifi4all\HiFi4AllItems;
use app\components\hifi4all\HiFi4AllNews;
use app\components\hifi4all\HiFi4AllReviews;
use app\models\News;
use app\models\PhpbbUser;
use app\models\SignInForm;
use app\models\UsedItem;
use app\models\UsedItemPhoto;
use app\models\UsedItemType;
use Yii;
use yii\base\Exception;
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

//        HelperBase::dump(HelperBase::getParam('thumb'));


//        $user = new SignInForm();
//        $user->email = 'user12345@bk.ru';
//        $user->email = 'new_max@bk.ru';
//        $user->password = '111111';
//        HelperBase::dump($user->validate());
//        HelperBase::dump($user->errors);

//        $user = PhpbbUser::findOne(48);
//        HelperUser::sendConfirmationEmail($user);


//        PhpbbUser::confirmEmail('8080e376ee5fa73ab6ecc6417bee51be');

//        HelperBase::dump(md5(uniqid()));

//        HelperBase::dump(HelperBase::curl('http://google.com'));

//        $_GET['sort'] = 'cheap-first';
//        HelperBase::dump(HelperMarketPlace::makeShortDescription('hello', 10));

//        HelperBase::dump(HelperUser::uid());
//        (new PhpbbUser)->hasItems(HelperUser::uid())

//        $user = new SignInForm();
//        $user->email = 'max.borisov@yahoo.com';
//        HelperBase::dump($user->login());
//        HelperBase::dump(Yii::$app->user->identity);

//        $user = PhpbbUser::findOne(48);
//        HelperBase::dump($user->validatePassword('111111'));

//        $photoModel = UsedItemPhoto::findOne('20');
//        HelperBase::dump($photoModel->delete());

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

//        $passw = '111111';
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

    public function actionDeletecategory()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = Category::findOne(6);
            if ($model->delete()) {
                $transaction->commit();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    public function actionMailer()
    {
        $params = [
            'html' => '<h2>Hello, boy!</h2>',
            'text' => 'hello Boy',
            'subject' => 'mandrill subject',
            'to' => [
                [
                    'email' => 'max.borisov@yahoo.com',
                    'name' => 'max borisov',
                    'type' => 'to'
                ]
            ],
        ];
        HelperBase::dump(Yii::$app->mailer->send($params));
    }

    public function actionFeed()
    {
        HelperBase::dump((new FeedParser())->addFeed('http://www.hifi4all.dk/ksb/rss.xml')->parse());
    }

    public function actionHifi4all()
    {
        $actions = ['items', 'news', 'review'];
        if (isset($_GET['action'])) {
            if (!in_array($_GET['action'], $actions)) {
                exit('Unknown action.');
            }
            $action = $_GET['action'];

            if ($action === 'items') {
                require_once Yii::getAlias('@app') . '/components/HiFi4AllParser/HiFi4AllItems.php';
                $parser = new HiFi4AllItems();
                $parser->run();
            }

            if ($action === 'news') {
                require_once Yii::getAlias('@app') . '/components/HiFi4AllParser/HiFi4AllNews.php';
                $parser = new HiFi4AllNews();
                $parser->run();
                return false;
            }

            if ($action === 'review') {
                require_once Yii::getAlias('@app') . '/components/HiFi4AllParser/HiFi4AllReviews.php';
                $parser = new HiFi4AllReviews();
                $parser->run();
                return true;
            }
        }


//        $id = isset($_GET['id']) ? $_GET['id'] : '284516';
//        $data = HiFi4AllParser::parsePage($id);
//        HelperBase::dump($data);
//        HiFi4AllParser::saveItem($data);
//        $data = HiFi4AllParser::getLinks(0);

//        HiFi4AllParser::copyData();

//        require_once Yii::getAlias('@app') . '/components/HiFi4AllParser/HiFi4AllMarket.php';
//        $parser = new HiFi4AllMarket();
//        $parser->run();

//        $page = HiFi4AllParser::parsePage(285048);
//        HelperBase::dump($page);
//        $res = HiFi4AllParser::saveItem($page);
//        HelperBase::dump($res);

    }

    public function actionTest()
    {
        $m = new News();
        $m->af = '11212';
        $m->title = '11212_t';
        $m->notice = 'scdscds';
        $m->post = 'saasxs';

        HelperBase::dump($m->validate());
        HelperBase::dump($m->save(false));
    }

    public function actionTime()
    {
        $t = '2015-01-18';
        echo strtotime($t);
        echo date('M d, Y');
    }
}