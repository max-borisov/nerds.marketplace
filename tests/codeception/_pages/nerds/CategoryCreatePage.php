<?php

namespace tests\codeception\_pages\nerds;

use yii\codeception\BasePage;
use tests\commons\TestCommons;

/**
 * Represents create category page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class CategoryCreatePage extends BasePage
{
    public $route = '/category/create';

    /**
     * @param string $categoryTitle
     */
    public function sendForm($categoryTitle)
    {
        TestCommons::categoryForm($this->actor, $categoryTitle);
    }
}
