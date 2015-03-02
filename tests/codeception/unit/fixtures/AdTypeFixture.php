<?php
namespace app\tests\codeception\unit\fixtures;

use Yii;
use yii\test\ActiveFixture;

class AdTypeFixture extends ActiveFixture
{
    public $modelClass = 'app\models\AdType';

    public function init()
    {
        $this->dataFile = Yii::getAlias('@fixtures') . '/data/models/ad_type.php';
        parent::init();
    }
}