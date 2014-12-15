<?php

namespace tests\codeception\unit\models\nerds;

use app\models\UsedItem;
use yii\codeception\DbTestCase;
use Codeception\Specify;
use Yii;

use app\tests\codeception\unit\fixtures\UsedItemFixture;

class UsedItemTest extends DbTestCase
{
    use Specify;

    public function fixtures()
    {
        return [
            'items' => UsedItemFixture::className(),
        ];
    }

    public function testGetCategory()
    {

    }
}
