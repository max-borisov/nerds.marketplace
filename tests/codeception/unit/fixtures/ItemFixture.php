<?php
namespace app\tests\codeception\unit\fixtures;

use Yii;
use yii\test\ActiveFixture;

class ItemFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Item';

    public function init()
    {
        $this->dataFile = Yii::getAlias('@fixtures') . '/data/models/item.php';
        parent::init();
    }
}