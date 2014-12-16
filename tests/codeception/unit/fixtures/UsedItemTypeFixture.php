<?php
namespace app\tests\codeception\unit\fixtures;

use Yii;
use yii\test\ActiveFixture;

class UsedItemTypeFixture extends ActiveFixture
{
    public $modelClass = 'app\models\UsedItemType';

    public function init()
    {
        $this->dataFile = Yii::getAlias('@fixtures') . '/data/models/used_item_type.php';
        parent::init();
    }
}