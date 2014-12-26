<?php

use app\components\HelperBase;
use yii\codeception\TestCase;
use Codeception\Specify;

class HelperBaseTest extends TestCase
{
    use Specify;

    public function testGetParam()
    {
        $this->specify('method returns correct value if existing config key was specified', function() {
            expect('Admin email is max.borisov@yahoo.com', HelperBase::getParam('adminEmail'))->equals('max.borisov@yahoo.com');
        });

        $this->specify('method returns null if invalid config key was specified', function() {
            expect('null value', HelperBase::getParam('user123'))->null();
        });
    }

    public function testLogger()
    {
        $fileName = '/tmp/nrdTestLogFile_' . time() . 'txt';
        $this->assertFalse(file_exists($fileName));
        $this->assertTrue(touch($fileName));
        $this->assertTrue(HelperBase::logger('test', $fileName));
        $this->assertTrue(HelperBase::logger('test', $fileName, ['a' => 1, 'b' => 2]));
        $this->assertTrue(unlink($fileName));
    }

    public function testGetForumProfileLink()
    {
        $this->specify('pass user id to get forum profile link', function() {
            $uid = 123;
            expect('correct link', HelperBase::getForumProfileLink($uid))->contains('mode=viewprofile&u=' . $uid);
        });

        $this->specify('do not pass any user id', function() {
            expect('# sign', HelperBase::getForumProfileLink())->equals('#');
        });
    }
}
