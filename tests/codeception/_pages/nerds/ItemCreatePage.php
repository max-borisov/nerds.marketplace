<?php

namespace tests\codeception\_pages\nerds;

use yii\codeception\BasePage;

/**
 * Represents add item
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class ItemCreatePage extends BasePage
{
    public $route = '/items/create';

    /**
     * @param array $params array $params List of form fields params
     */
    public function fillForm($params = [])
    {
        if (isset($params['warranty'])) {
            $this->actor->fillField('input[name="Item[warranty]"]', $params['warranty']);
        }
        if (isset($params['invoice'])) {
            $this->actor->fillField('input[name="Item[invoice]"]', $params['invoice']);
        }
        if (isset($params['packaging'])) {
            $this->actor->fillField('input[name="Item[packaging]"]', $params['packaging']);
        }
        if (isset($params['manual'])) {
            $this->actor->fillField('input[name="Item[manual]"]', $params['manual']);
        }
        if (isset($params['price'])) {
            $this->actor->fillField('input[name="Item[price]"]', $params['price']);
        }
        if (isset($params['category_id'])) {
            $this->actor->selectOption('form select[name="Item[category_id]"]', $params['category_id']);
        }
        if (isset($params['title'])) {
            $this->actor->fillField('input[name="Item[title]"]', $params['title']);
        }
        if (isset($params['ad_type_id'])) {
            $this->actor->fillField('input[name="Item[ad_type_id]"]', $params['ad_type_id']);
        }
        if (isset($params['description'])) {
            $this->actor->fillField('textarea[name="Item[description]"]', $params['description']);
        }
    }
}
