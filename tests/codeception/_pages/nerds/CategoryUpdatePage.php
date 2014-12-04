<?php

namespace tests\codeception\_pages\nerds;

use yii\codeception\BasePage;
use tests\common\TestCommon;

/**
 * Represents update category page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class CategoryUpdatePage extends BasePage
{
    public $route = '/category/update/1';

    /**
     * @param string $categoryTitle
     */
    public function sendForm($categoryTitle)
    {
        TestCommon::categoryForm($this->actor, $categoryTitle);
    }
}
