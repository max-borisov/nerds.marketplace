<?php
namespace app\tests\codeception\unit\fixtures;

use Yii;
use yii\test\ActiveFixture;

class CategoryFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Category';
    public $depends = ['app\tests\codeception\unit\fixtures\UsedItemFixture'];

    public function init()
    {
        $this->dataFile = Yii::getAlias('@fixtures') . '/data/models/category.php';
        parent::init();
    }
}