<?php

use app\components\HelperMarketPlace;
use yii\codeception\TestCase;
use Codeception\Specify;

class HelperMarketplaceTest extends TestCase
{
    use Specify;

    public function testGenerateSortDropDown()
    {
        $dropDown = HelperMarketPlace::generateSortDropDown(new \yii\web\View);
        $this->specify('generate dropdown list', function() use ($dropDown) {
            expect('html code has select element', $dropDown)->contains('select');
            expect('html code has option element', $dropDown)->contains('option');
        });
    }

    public function testGetSortParamForItemsList()
    {
        $this->specify('No sort parameters', function() {
            expect('sort by id DESC', HelperMarketPlace::getSortParamForItemsList())->equals('id DESC');
        });

        $this->specify('With cheap-first get parameter', function() {
            $_GET['sort'] = 'cheap-first';
            expect('sort by price ASC', HelperMarketPlace::getSortParamForItemsList())->equals('price ASC');
        });

        $this->specify('With cheap-last get parameter', function() {
            $_GET['sort'] = 'cheap-last';
            expect('sort by price DESC', HelperMarketPlace::getSortParamForItemsList())->equals('price DESC');
        });

        $this->specify('With new-first get parameter', function() {
            $_GET['sort'] = 'new-first';
            expect('sort by created_at DESC', HelperMarketPlace::getSortParamForItemsList())->equals('created_at DESC');
        });

        $this->specify('With new-last get parameter', function() {
            $_GET['sort'] = 'new-last';
            expect('sort by created_at ASC', HelperMarketPlace::getSortParamForItemsList())->equals('created_at ASC');
        });
    }

    public function testMakeShortDescription()
    {
        $this->specify('Description is shorten than max limit', function() {
            $description = 'hello';
            $limit = 10;
            expect($description, HelperMarketPlace::makeShortDescription($description, $limit))->equals($description);
        });

        $this->specify('Description is longer than max limit', function() {
            $description = 'Hello, guys. It is nice to meet you.';
            $limit = 15;
            expect('First description sentence.', HelperMarketPlace::makeShortDescription($description, $limit))->equals('Hello, guys.');
        });

        $this->specify('Description is longer than max limit', function() {
            $description = 'Hello, guys. It is nice to meet you. The site is awesome.';
            $limit = 45;
            expect('Two first description sentences', HelperMarketPlace::makeShortDescription($description, $limit))->equals('Hello, guys. It is nice to meet you.');
        });
    }
}
