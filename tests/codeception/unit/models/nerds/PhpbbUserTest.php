<?php

namespace tests\codeception\unit\models\nerds;

use app\models\PhpbbUser;
use yii\codeception\DbTestCase;
use Codeception\Specify;
use Yii;

class PhpbbUserTest extends DbTestCase
{
    use Specify;

    public function testGetItems()
    {
        $this->specify('test specific user has posted some items', function () {
            $uid = 48;
            expect(
                'items list is not empty',
                PhpbbUser::find()->where('user_id = :uid', [':uid' => $uid])->one()->items
            )->notEmpty();
        });

        $this->specify('test specific used does not have any items', function () {
            $uid = 1;
            expect(
                'items list is empty',
                PhpbbUser::find()->where('user_id = :uid', [':uid' => $uid])->one()->items
            )->isEmpty();
        });
    }

    public function testHasItems()
    {
        $this->specify('test items existence', function () {
            $uid = 48;
            expect(
                'items exist (boolean)',
                (new PhpbbUser)->hasItems($uid)
            )->true();

            $uid = 1;
            expect(
                'items not exist (boolen)',
                (new PhpbbUser)->hasItems($uid)
            )->false();
        });
    }
}
