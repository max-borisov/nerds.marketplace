<?php

namespace tests\codeception\unit\models\nerds;

use app\models\User;
use yii\codeception\DbTestCase;
use Codeception\Specify;
use app\tests\codeception\unit\fixtures\UserFixture;

class UserTest extends DbTestCase
{
    use Specify;

    public function fixtures()
    {
        return [
            'user' => UserFixture::className(),
        ];
    }

    private $_userMax;

    private $_fakeUid = 250;

    protected function setUp()
    {
        parent::setUp();
        $this->_userMax = $this->user('max');
    }

    public function testGetItems()
    {
        $this->specify('user has posted some items', function () {
            $uid = $this->_userMax->id;
            expect(
                'user items list is not empty',
                User::find()->where('id = :uid', [':uid' => $uid])->one()->items
            )->notEmpty();
        });

        $this->specify('user does not have any items', function () {
            $uid = $this->user('has_no_items')->id;
            expect(
                'user items list is empty',
                User::find()->where('id = :uid', [':uid' => $uid])->one()->items
            )->isEmpty();
        });
    }

    public function testHasItems()
    {
        $this->specify('there are items related to a user', function () {
            expect(
                'items exist (boolean)',
                (new User)->hasItems($this->_userMax->id)
            )->true();
        });

        $this->specify('there are no items related to a user', function () {
            expect(
                'items not exist (boolen)',
                (new User)->hasItems($this->user('has_no_items')->id)
            )->false();
        });
    }

    public function testFindUser()
    {
        $this->specify('find existing user', function () {
            expect('user record is not null', User::findUser($this->_userMax->id))->notNull();
        });

        $this->specify('find not existing user', function () {
            expect('user record is null', User::findUser($this->_fakeUid))->null();
        });
    }

    public function testFindIdentity()
    {
        $this->specify('get identity data for existing user', function () {
            expect('user identity is not null', User::findIdentity($this->user('max')->id))->notNull();
        });

        $this->specify('get identity data for not existing user', function () {
            expect('user identity is null', User::findIdentity($this->_fakeUid))->null();
        });
    }

    public function testGetId()
    {
        $this->specify('use getId() method to get user id', function () {
            $uid = $this->_userMax->id;
            expect('getId() returns correct value.', User::findOne($uid)->getId())->equals($uid);
        });
    }

    public function testValidatePassword()
    {
        $uid = $this->_userMax->id;
        $this->specify('test real password', function ()  use ($uid) {
            $password = '111111';
            expect('password is correct', User::findOne($uid)->validatePassword($password))->true();
        });

        $this->specify('test fake password', function () use ($uid) {
            $password = '22';
            expect('password not equals 111111', User::findOne($uid)->validatePassword($password))->false();
        });
    }

    public function testFindByUsername()
    {
        $this->specify('find user by real name', function () {
            $name = $this->_userMax->name;
            expect('user record is not null', User::findByUsername($name))->notNull();
        });

        $this->specify('find user by fake name', function () {
            $fakeName = 'Max 123--';
            expect('user record is null', User::findByUsername($fakeName))->null();
        });
    }

    public function testFindByEmail()
    {
        $this->specify('find existing user by email', function () {
            $email = $this->_userMax->email;
            expect('user record is not null', User::findByEmail($email))->notNull();
        });

        $this->specify('find not existing user by email', function () {
            $fakeEmail = 'new_max_1234@bk.ru';
            expect('user record is null', User::findByEmail($fakeEmail))->null();
        });
    }
}
