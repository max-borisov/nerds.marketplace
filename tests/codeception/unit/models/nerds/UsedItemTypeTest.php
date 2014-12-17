<?php

namespace tests\codeception\unit\models\nerds;

use Yii;
use app\models\UsedItemType;
use yii\codeception\DbTestCase;
use Codeception\Specify;
use app\tests\codeception\unit\fixtures\UsedItemTypeFixture;

class UsedItemTypeTest extends DbTestCase
{
    use Specify;

    public function fixtures()
    {
        return [
            'type' => UsedItemTypeFixture::className(),
        ];
    }

    public function testValidation()
    {
        $this->specify('validate item with empty title', function () {
            $type = new UsedItemType();
            $type->title = null;
            expect('validation error', $type->validate())->false();
        });

        $this->specify('item title should be unique', function () {
            $type = new UsedItemType();
            $type->title = $this->type('sale')->title;
            expect('validation error', $type->validate())->false();
        });

        $this->specify('set correct item title', function () {
            $type = new UsedItemType();
            $type->title = 'brand new title';
            expect('validation success', $type->validate())->true();
        });
    }

    public function testSave()
    {
        $this->specify('create new type', function () {
            $type = new UsedItemType();
            $type->title = 'brand new title';
            expect('save success', $type->save(true))->true();
        });
    }

    public function testEdit()
    {
        $this->specify('edit type', function () {
            $type = UsedItemType::findOne($this->type('edit')->id);
            $type->title = 'edited title';
            expect('save success', $type->save(true))->true();
        });
    }

    public function testPrepareList()
    {
        $this->specify('organize item types into array', function () {
            expect('types list is not empty', (new UsedItemType())->prepareList())->notEmpty();
        });
    }

    public function testGetItems()
    {
        $this->specify('test specific type has many items belong to it', function () {
            expect('items list is not empty', UsedItemType::findOne($this->type('sale')->id)->items)->notEmpty();
        });
    }
}
