<?php

namespace tests\codeception\unit\models\nerds;

use app\models\Category;
use tests\codeception\common\fixtures\CategoryFixture;
use tests\codeception\common\fixtures\UsedItemFixture;
use yii\codeception\DbTestCase;

class CategoryTest extends DbTestCase
{
    protected function setUp()
    {
        parent::setUp();
        // uncomment the following to load fixtures for user table
//        $this->loadFixtures(['category']);
    }

    public function testValidation()
    {
        $category = new Category();
        $this->assertFalse($category->validate());

        $category->title = 'New category title';
        $this->assertTrue($category->validate());

//        $this->getFixture('category');
//        \Codeception\Util\Debug::debug($this->getFixture('category')['tools']);
    }

    public function testPrepareDropDown()
    {
        $this->assertNotEmpty((new Category)->prepareDropDown());
    }

    public function testGetAttachedItems()
    {
        $items = Category::findOne(1)->attachedItems;
        $this->assertNotEmpty($items);
        // There are attached items
        $this->assertEquals(2, count($items));
    }

    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'category' => [
                'class' => CategoryFixture::className(),
                'dataFile' => '@tests/codeception/unit/fixtures/data/models/category.php'
            ],
            'used_item' => [
                'class' => UsedItemFixture::className(),
                'dataFile' => '@tests/codeception/unit/fixtures/data/models/used_item.php'
            ],
        ];
    }
}
