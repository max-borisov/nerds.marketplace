<?php
namespace app\tests\codeception\unit\fixtures;

use Yii;
use yii\test\ActiveFixture;

class PhpbbUserFixture extends ActiveFixture
{
    public $modelClass = 'app\models\PhpbbUser';

    public function init()
    {
        $this->dataFile = Yii::getAlias('@fixtures') . '/data/models/phpbb_user.php';
        parent::init();
    }
}