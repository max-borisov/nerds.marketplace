<?php

namespace tests\codeception\_pages\nerds;

use yii\codeception\BasePage;
use tests\commons\TestCommons;

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
        TestCommons::categoryForm($this->actor, $categoryTitle);
    }
}
