<?php

namespace tests\codeception\_pages\nerds;

use tests\codeception\_pages\nerds\ItemCreatePage;

/**
 * Represents add item
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class ItemEditPage extends ItemCreatePage
{
    public $route = '/item/edit/1';
}
