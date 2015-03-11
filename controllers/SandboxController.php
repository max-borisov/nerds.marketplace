<?php

namespace app\controllers;

use app\components\FeedParser;
use app\components\HelperMarketPlace;

use app\components\parser\hifi\HiFiItems;
use app\components\parser\hifi\HiFiNews;
use app\components\parser\hifi\HiFiReviews;
use app\components\parser\dba\DbaItems;
use app\components\parser\recordere\RecGames;
use app\components\parser\recordere\RecNews;
use app\components\parser\recordere\RecTv;
use app\components\parser\recordere\RecMusic;
use app\components\parser\recordere\RecMovies;

use app\components\parser\recordere\RecReviews;
use app\models\ItemCatalog;
use app\models\ItemDba;
use app\models\News;
use app\models\User;
use app\models\SignInForm;
use app\models\Item;
use app\models\ItemPhoto;
use app\models\AdType;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\helpers;

use app\models\Category;
use app\components\HelperBase;
use app\components\HelperSignUp;
use app\components\HelperUser;
use app\components\parser\dba;

use yii\imagine\Image;
use yii\bootstrap\BootstrapAsset;

class SandboxController extends Controller
{
    public function actionIndex()
    {
//        HelperBase::dump(Yii::$app->user->identity->username);

//        HelperBase::dump(HelperBase::getParam('thumb'));

//        HelperBase::logger('homeUrl', null, ['url' => 'test']);
//        HelperBase::end();

//        HelperBase::dump(Yii::$app->host);
//        HelperBase::dump(Yii::$app->homeUrl);


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
        $actions = ['items', 'news', 'reviews'];
        if (isset($_GET['action'])) {
            if (!in_array($_GET['action'], $actions)) {
                exit('Unknown action.');
            }
            $action = $_GET['action'];

            if ($action === 'items') {
                require_once Yii::getAlias('@app') . '/components/Parser/HiFi4All/HiFiItems.php';
                (new HiFiItems())->run();
                return false;
            }

            if ($action === 'news') {
                require_once Yii::getAlias('@app') . '/components/Parser/HiFi4All//HiFiNews.php';
                if (isset($_GET['id'])) {
                    $id = isset($_GET['id']) ? $_GET['id'] : 12234;
                    (new HiFiNews())->parsePageTest($id);
                } else {
                    (new HiFiNews())->run();
                }
                return false;
            }

            if ($action === 'reviews') {
                require_once Yii::getAlias('@app') . '/components/Parser/HiFi4All//HiFiReviews.php';
                if (isset($_GET['id'])) {
                    $id = isset($_GET['id']) ? $_GET['id'] : 12234;
                    (new HiFiReviews())->parsePageTest($id);
                } else {
                    (new HiFiReviews())->run();
                }
                return false;
            }
        }
    }

    public function actionParserall()
    {
        set_time_limit(0);

        require_once Yii::getAlias('@app') . '/components/Parser/HiFi4All/HiFiItems.php';
        (new HiFiItems())->run();

        require_once Yii::getAlias('@app') . '/components/Parser/HiFi4All//HiFiNews.php';
        (new HiFiNews())->run();

        require_once Yii::getAlias('@app') . '/components/Parser/HiFi4All//HiFiReviews.php';
        (new HiFiReviews())->run();

        require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecNews.php';
        (new RecNews())->run();

        require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecReviews.php';
        (new RecReviews())->run();
    }

    public function actionRecordere()
    {
        $actions = ['news', 'reviews', 'games', 'tv', 'music', 'movies'];
        if (isset($_GET['action'])) {
            if (!in_array($_GET['action'], $actions)) {
                exit('Unknown action.');
            }
            $action = $_GET['action'];

            if ($action === 'news') {
                require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecNews.php';
                if (isset($_GET['id'])) {
                    $id = isset($_GET['id']) ? $_GET['id'] : 12234;
                    (new RecNews())->parsePageTest($id);
                } else {
                    (new RecNews())->run();
                }
                return false;
            }

            if ($action === 'reviews') {
                require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecReviews.php';
                if (isset($_GET['id'])) {
                    $id = isset($_GET['id']) ? $_GET['id'] : 12234;
                    (new RecReviews())->parsePageTest($id);
                } else {
                    (new RecReviews())->run();
                }
                return false;
            }

            if ($action === 'games') {
                require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecGames.php';
                if (isset($_GET['id'])) {
                    $id = isset($_GET['id']) ? $_GET['id'] : 12234;
                    (new RecGames())->parsePageTest($id);
                } else {
                    (new RecGames())->run();
                }
                return false;
            }

            if ($action === 'tv') {
                require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecTv.php';
                if (isset($_GET['id'])) {
                    $id = isset($_GET['id']) ? $_GET['id'] : 12234;
                    (new RecTv())->parsePageTest($id);
                } else {
                    (new RecTv())->run();
                }
                return false;
            }

            if ($action === 'music') {
                require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecMusic.php';
                if (isset($_GET['id'])) {
                    $id = isset($_GET['id']) ? $_GET['id'] : 12234;
                    (new RecMusic())->parsePageTest($id);
                } else {
                    (new RecMusic())->run();
                }
                return false;
            }

            if ($action === 'movies') {
                require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecMovies.php';
                if (isset($_GET['id'])) {
                    $id = isset($_GET['id']) ? $_GET['id'] : 12234;
                    (new RecMovies())->parsePageTest($id);
                } else {
                    (new RecMovies())->run();
                }
                return false;
            }
        }
    }

    public function actionDba()
    {
        require_once Yii::getAlias('@app') . '/components/Parser/Dba/DbaItems.php';
        if (isset($_GET['id'])) {
            $id = isset($_GET['id']) ? $_GET['id'] : 12234;
            (new DbaItems())->parsePageTest($id);
        } else {
            (new DbaItems())->run();
        }
        return true;
    }

    public function actionParsecatalog()
    {

        echo $this->renderPartial('parser');

        require_once Yii::getAlias('@app') . '/components/Parser/Dba/DbaItems.php';
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = 'http://www.dba.dk/billede-og-lyd/film/dvd-film-og-blu-ray/side-15/';
        }
        $dba = new DbaItems();
        $links = $dba->getLinksFromCatalog($url);
        foreach ($links as $itemId) {
            HelperBase::dump($dba->parsePage($itemId));
            echo "<hr>";
        }
    }

    public function actionTest()
    {

        $query = Item::find();
        $query->where('title LIKE "%:search_text%" OR description LIKE "%:search_text%"', [':search_text' => 'Defekt']);
//        $query->where('id > 10 AND id < 15');
        HelperBase::dump($query->sql);
        HelperBase::dump($query->all());

//        require_once Yii::getAlias('@app') . '/components/Parser/Dba/DbaItems.php';

//        $url = 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer//side-7/';
//        echo HelperBase::dump($url);
//        echo $html = (new DbaItems())->tidy($url, 'utf8');
//        $html = file_get_contents($url);
//        HelperBase::dump($html);
//        HelperBase::end();


//        $pattern = '|<a\s+class="link-to-listing"\s+href="(http://www\.dba\.dk/[^/]+/id-\d+/)">[^<]+</a>|is';
//        $pattern = '|<a\s+class="link-to-listing"\s+href="(http://www\.dba\.dk/[^/]+/id-\d+/)"\s*>[^<]+</a>|is';
//        $pattern = '|<a\s+class="link-to-listing"\s+href="(http://www\.dba\.dk/(.*?)/)">(.*?)</a>|is';
//        $html = '<a class="link-to-listing" href="http://www.dba.dk/anden-radio-phillips-roerra/id-1013857887/">Se hele annoncen</a>';
//        preg_match_all($pattern, $html, $matches);
//        HelperBase::dump($matches);
    }

    public function actionTime()
    {
        $t = '2015-01-18';
        echo strtotime($t);
        $t = 1423567378;
        echo date('M d, Y', $t);
    }
}