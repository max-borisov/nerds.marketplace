<?php

namespace tests\codeception\_pages\nerds;

use yii\codeception\BasePage;

/**
 * Represents add item
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class ItemCreatePage extends BasePage
{
    public $route = '/marketplace/create';

    /**
     * @param array $params array $params List of form fields params
     */
    public function fillForm($params = [])
    {
        if (isset($params['warranty'])) {
            $this->actor->fillField('input[name="UsedItem[warranty]"]', $params['warranty']);
        }
        if (isset($params['invoice'])) {
            $this->actor->fillField('input[name="UsedItem[invoice]"]', $params['invoice']);
        }
        if (isset($params['packaging'])) {
            $this->actor->fillField('input[name="UsedItem[packaging]"]', $params['packaging']);
        }
        if (isset($params['manual'])) {
            $this->actor->fillField('input[name="UsedItem[manual]"]', $params['manual']);
        }
        if (isset($params['price'])) {
            $this->actor->fillField('input[name="UsedItem[price]"]', $params['price']);
        }
        if (isset($params['category_id'])) {
            $this->actor->selectOption('form select[name="UsedItem[category_id]"]', $params['category_id']);
        }
        if (isset($params['title'])) {
            $this->actor->fillField('input[name="UsedItem[title]"]', $params['title']);
        }
        if (isset($params['type_id'])) {
            $this->actor->fillField('input[name="UsedItem[type_id]"]', $params['type_id']);
        }
        if (isset($params['description'])) {
            $this->actor->fillField('textarea[name="UsedItem[description]"]', $params['description']);
        }
    }
}
