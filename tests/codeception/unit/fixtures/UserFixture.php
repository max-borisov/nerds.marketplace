<?php
namespace app\tests\codeception\unit\fixtures;

use Yii;
use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = 'app\models\User';

    public function init()
    {
        $this->dataFile = Yii::getAlias('@fixtures') . '/data/models/user.php';
        parent::init();
    }
}