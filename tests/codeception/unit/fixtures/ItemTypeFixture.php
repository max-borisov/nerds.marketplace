<?php
namespace app\tests\codeception\unit\fixtures;

use Yii;
use yii\test\ActiveFixture;

class ItemTypeFixture extends ActiveFixture
{
    public $modelClass = 'app\models\ItemType';

    public function init()
    {
        $this->dataFile = Yii::getAlias('@fixtures') . '/data/models/item_type.php';
        parent::init();
    }
}