<?php

namespace tests\codeception\unit\models\nerds;

use app\models\UsedItem;
use yii\codeception\DbTestCase;
use Codeception\Specify;

class UsedItemTest extends DbTestCase
{
    use Specify;

    /*public function testValidation()
    {
        $category = new Category();

        $this->specify('category title is required', function () use ($category) {
            $category->title = '';
            expect('model should return validation error', $category->validate())->false();
        });

        $this->specify('category title is ok', function () use ($category) {
            $category->title = 'New category title';
            expect('model validation is successful', $category->validate())->true();
        });
    }

    public function testPrepareDropDown()
    {
        $this->specify('organize categories into array', function () {
            expect('categories list is not empty', (new Category)->prepareDropDown())->notEmpty();
        });
    }

    public function testGetAttachedItems()
    {
        $this->specify('test items attached to the category', function () {
            expect('category has attached items', Category::findOne(1)->attachedItems)->notEmpty();
        });
    }*/

    public function testGetCategory()
    {
        $this->specify('test specific item belongs to category', function () {
            expect('item category is not empty', UsedItem::findOne(1)->category)->notEmpty();
        });
    }

    public function testGetPhotos()
    {
        $this->specify('test specific item has attached photos', function () {
            expect('item photos list is not empty', UsedItem::findOne(1)->photos)->notEmpty();
        });

        $this->specify('test specific item does not have photos', function () {
            expect('item photos list is empty', UsedItem::findOne(2)->photos)->isEmpty();
        });
    }

    public function testGetUser()
    {
        $this->specify('test specific item belongs to a user', function () {
            expect('item belongs to a user', UsedItem::findOne(1)->user)->notNull();
        });
    }

    public function testItemPreview()
    {
        $this->specify('item has a preview', function () {
            expect('item preview', UsedItem::findOne(1)->preview)->equals('http://placehold.it/250x200');
        });
    }
}
