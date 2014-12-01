<?php

namespace tests\codeception\_pages\nerds;

use yii\codeception\BasePage;

/**
 * Represents category page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class CategoryPage extends BasePage
{
    public $route = '/category';
}
