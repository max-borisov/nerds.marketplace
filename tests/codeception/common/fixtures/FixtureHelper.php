<?php

namespace tests\codeception\common\fixtures;

use tests\codeception\common\fixtures\CategoryFixture;
use tests\codeception\common\fixtures\ItemFixture;
use tests\codeception\common\fixtures\ItemPhotoFixture;
use Codeception\Module;
use yii\test\FixtureTrait;

/**
 * This helper is used to populate database with needed fixtures before any tests should be run.
 * For example - populate database with demo login user that should be used in acceptance and functional tests.
 * All fixtures will be loaded before suite will be starded and unloaded after it.
 */
class FixtureHelper extends Module
{

    /**
     * Redeclare visibility because codeception includes all public methods that not starts from "_"
     * and not excluded by module settings, in actor class.
     */
    use FixtureTrait {
        loadFixtures as protected;
        fixtures as protected;
        globalFixtures as protected;
        unloadFixtures as protected;
        getFixtures as protected;
        getFixture as protected;
    }

    /**
     * Method called before any suite tests run. Loads User fixture login user
     * to use in acceptance and functional tests.
     * @param array $settings
     */
    public function _beforeSuite($settings = [])
    {
        $this->loadFixtures();
    }

    /**
     * Method is called after all suite tests run
     */
    public function _afterSuite()
    {
        $this->unloadFixtures();
    }

    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'category' => [
                'class' => CategoryFixture::className(),
                'dataFile' => '@tests/codeception/fixtures/data/models/category.php'
            ],
            'item' => [
                'class' => ItemFixture::className(),
                'dataFile' => '@tests/codeception/fixtures/data/models/item.php'
            ],
            'item_photo' => [
                'class' => ItemPhotoFixture::className(),
                'dataFile' => '@tests/codeception/fixtures/data/models/item_photo.php'
            ],
            'news' => [
                'class' => NewsFixture::className(),
                'dataFile' => '@tests/codeception/fixtures/data/models/news.php'
            ],
            'review' => [
                'class' => ReviewFixture::className(),
                'dataFile' => '@tests/codeception/fixtures/data/models/review.php'
            ],
        ];
    }
}
