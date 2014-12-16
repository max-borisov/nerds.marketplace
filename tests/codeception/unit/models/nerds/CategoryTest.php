<?php

namespace tests\codeception\unit\models\nerds;

use app\models\Category;
use yii\codeception\DbTestCase;
use Codeception\Specify;
use app\tests\codeception\unit\fixtures\CategoryFixture;

class CategoryTest extends DbTestCase
{
    use Specify;

    public function fixtures()
    {
        return [
            'category' => CategoryFixture::className(),
        ];
    }

    public function testValidation()
    {
        $category = new Category();

        $this->specify('category title is required', function () use ($category) {
            $category->title = '';
            expect('validation error. category title cannot be blank.', $category->validate())->false();
        });

        $this->specify('category is unique', function () use ($category) {
            $category->title = $this->category('accessories')->title;
            expect('validation error. category title should be unique.', $category->validate())->false();
        });

        $this->specify('category title is ok', function () use ($category) {
            $category->title = 'New category title';
            expect('model validation is successful', $category->validate())->true();
        });
    }

    public function testPrepareDropDown()
    {
        $this->specify('get list of all available categories', function () {
            expect('categories list is not empty', (new Category)->prepareDropDown())->notEmpty();
        });
    }

    public function testGetAttachedItems()
    {
        $this->specify('get category`s attached items (items exist)', function () {
            $categoryId = $this->category('accessories')->id;
            expect('items list is not empty', Category::findOne($categoryId)->attachedItems)->notEmpty();
        });

        $this->specify('get category`s attached items (items not exist)', function () {
            $categoryId = $this->category('empty')->id;
            expect('items list is empty', Category::findOne($categoryId)->attachedItems)->isEmpty();
        });
    }
}
