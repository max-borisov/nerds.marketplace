<?php

namespace tests\codeception\unit\models\nerds;

use app\models\Category;
use tests\codeception\common\fixtures\CategoryFixture;
use tests\codeception\common\fixtures\UsedItemFixture;
use yii\codeception\DbTestCase;
use Codeception\Specify;

class CategoryTest extends DbTestCase
{
    use Specify;

    public function testValidation()
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
