<?php
namespace app\tests\codeception\unit\fixtures;

use yii\test\ActiveFixture;

class UsedItemFixture extends ActiveFixture
{
    public $modelClass = 'app\models\UsedItem';

//    public $dataFile = '@tests/unit/fixtures/data/used_item.php';
//    public $dataFile = './data/used_item.php';

    public function init()
    {
        $this->dataFile = __DIR__ . '/data/used_item.php';

        parent::init();
    }
}