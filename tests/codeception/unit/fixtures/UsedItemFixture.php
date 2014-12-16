<?php
namespace app\tests\codeception\unit\fixtures;

use Yii;
use yii\test\ActiveFixture;

class UsedItemFixture extends ActiveFixture
{
    public $modelClass = 'app\models\UsedItem';

    public function init()
    {
        $this->dataFile = Yii::getAlias('@fixtures') . '/data/used_item.php';
        parent::init();
    }
}