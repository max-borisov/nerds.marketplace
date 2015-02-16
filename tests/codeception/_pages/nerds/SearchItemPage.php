<?php

namespace tests\codeception\_pages\nerds;

use yii\codeception\BasePage;

/**
 * Represents search item page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class SearchItemPage extends BasePage
{
    public $route = '/';

    /**
     * @param array $params
     */
    public function search($params = [])
    {
        if (isset($params['warranty'])) {
            $this->actor->fillField('input[name="Item[warranty]"]', $params['warranty']);
        }
        if (isset($params['packaging'])) {
            $this->actor->fillField('input[name="Item[packaging]"]', $params['packaging']);
        }
        if (isset($params['manual'])) {
            $this->actor->fillField('input[name="Item[manual]"]', $params['manual']);
        }
        if (isset($params['search_text'])) {
            $this->actor->fillField('input[name="Item[search_text]"]', $params['search_text']);
        }
        if (isset($params['price_min'])) {
            $this->actor->fillField('input[name="Item[price_min]"]', $params['price_min']);
        }
        if (isset($params['price_max'])) {
            $this->actor->fillField('input[name="Item[price_max]"]', $params['price_max']);
        }
        $this->actor->click('input[type="submit"]');
    }
}
