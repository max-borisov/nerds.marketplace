<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\components\parser\recordere\RecNews;
use app\components\parser\recordere\RecReviews;
use app\components\parser\recordere\RecGames;
use app\components\parser\recordere\RecTv;
use app\components\parser\recordere\RecMusic;
use app\components\parser\recordere\RecMovies;
use app\components\parser\recordere\RecMedia;
use app\components\parser\recordere\RecRadio;

class ParserrecController extends Controller
{
    public function actionNews()
    {
        $this->_checkEnv();
        require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecNews.php';
        (new RecNews())->run();
    }

    public function actionReviews()
    {
        $this->_checkEnv();
        require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecReviews.php';
        (new RecReviews())->run();
    }

    public function actionMedia()
    {
        $this->_checkEnv();
        require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecGames.php';
        (new RecGames())->run();

        require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecTv.php';
        (new RecTv())->run();

        require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecMusic.php';
        (new RecMusic())->run();

        require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecMovies.php';
        (new RecMovies())->run();

        require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecMedia.php';
        (new RecMedia())->run();

        require_once Yii::getAlias('@app') . '/components/Parser/Recordere/RecRadio.php';
        (new RecRadio())->run();
    }

    private function _checkEnv()
    {
        if (YII_ENV_DEV) {
            echo "Command does not work under DEV environment.\r\n";
            exit(0);
        }
    }
}
