<?php

namespace tests\codeception\unit\models\nerds;

use app\models\UsedItemType;
use yii\codeception\DbTestCase;
use Codeception\Specify;
use Yii;

class UsedItemTypeTest extends DbTestCase
{
    use Specify;

    public function testPrepareList()
    {
        $this->specify('organize item types into array', function () {
            expect('types list is not empty', (new UsedItemType())->prepareList())->notEmpty();
        });
    }

    public function testGetItems()
    {
        $this->specify('test specific type has many items belong to it', function () {
            expect('items list is not empty', UsedItemType::findOne(1)->items)->notEmpty();
        });
    }
}
