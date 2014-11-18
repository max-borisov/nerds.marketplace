<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\helpers\FileHelper;
use app\components\HelperBase;

class HelperSignUp extends Component
{
    /*$user_row = array(
        'username'              => $username,
        'user_password'         => phpbb_hash($password),
        'user_email'            => $email_address,
        'group_id'              => (int) $group_id,
        'user_timezone'         => (float) $timezone,
        'user_dst'              => $is_dst,
        'user_lang'             => $language,
        'user_type'             => $user_type,
        'user_actkey'           => $user_actkey,
        'user_ip'               => $user_ip,
        'user_regdate'          => $registration_time,
        'user_inactive_reason'  => $user_inactive_reason,
        'user_inactive_time'    => $user_inactive_time,
    );*/

// Custom Profile fields, this will be covered in another article.
// for now this is just a stub
// all the information has been compiled, add the user
// the user_add() function will automatically add the user to the correct groups
// and adding the appropriate database entries for this user...
// tables affected: users table, profile_fields_data table, groups table, and config table.
//$user_id = user_add($user_row);


    public static function addUser()
    {

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : HelperBase::getParam('phpBBForumPath');
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_user.' . $phpEx);

//echo 234;

        return;
$group_id = 1;
$user_row = array(
    'username'              => '$username' . rand(1, 1000),
    'user_password'         => phpbb_hash('$password'),
    'user_email'            => '$email_address',
    'group_id'              => (int) $group_id,
    'user_timezone'         => (float) $timezone,
//    'user_dst'              => '$is_dst',
    'user_lang'             => '$language',
    'user_type'             => 1,
    'user_actkey'           => '$user_actkey',
    'user_ip'               => 0,
    'user_regdate'          => 0,
    'user_inactive_reason'  => 0,
    'user_inactive_time'    => 0,
);

echo "<pre>";
print_r($user_row);
echo "</pre>";

// all the information has been compiled, add the user
// tables affected: users table, profile_fields_data table, groups table, and config table.
/*$user_id = user_add($user_row);

echo "<pre>";
print_r($user_id);
echo "</pre>";*/

    }


    public static function addUser2()
    {

//        HelperBase::dump('1234');


        global $phpbb_root_path;

        $phpbb_root_path = HelperBase::getParam('phpBBForumPath');
//        $file = HelperBase::getParam('phpBBForumPath') . 'includes/functions.php';
//
//        HelperBase::dump(pathinfo($file));
//
//        echo FileHelper::normalizePath($file);
//
//        include HelperBase::getParam('phpBBForumPath') . 'includes/functions_user.php';

        define('IN_PHPBB', true);

        global $phpEx;
        global $db;
        global $config;
        global $user;
        global $auth;
        global $cache;
        global $template;

        # your php extension
//        $phpEx = substr(strrchr(__FILE__, '.'), 1);
        $phpEx = 'php';
//        $phpbb_root_path = ;

        /* includes all the libraries etc. required */
        require($phpbb_root_path . 'common.php');

//        HelperBase::dump($user);

//        $user->session_begin();

//        $auth->acl($user->data);



        /* the file with the actual goodies */
        require($phpbb_root_path . 'includes/functions_user.php');

        /* All the user data (I think you can set other database fields aswell, these seem to be required )*/
        $user_row = array(
            'username' => 'Username',
            'user_password' => md5('Password'),
            'user_email' => 'Email',
            'group_id' => 1,
//            'group_id' => $default_group_id,
            'user_timezone' => '1.00',
            'user_dst' => 0,
            'user_lang' => 'en',
            'user_type' => '0',
            'user_actkey' => '',
            'user_dateformat' => 'd M Y H:i',
//            'user_style' => $not_sure_what_this_is,
            'user_style' => '',
            'user_regdate' => time(),
        );

//        HelperBase::dump(defined('IN_PHPBB'));
//        echo 1234667;

        /* Now Register user */
        HelperBase::dump(user_add($user_row));
//        return false;

        /*$user_row = array(
            'username'              => '$username',
            'user_password'         => '$password)',
            'user_email'            => '$email_address',
            'group_id'              => 0,
            'user_timezone'         => 0,
            'user_dst'              => '',
            'user_lang'             => '',
            'user_type'             => 1,
            'user_actkey'           => 1,
            'user_ip'               => 1,
            'user_regdate'          => 1,
            'user_inactive_reason'  => 1,
            'user_inactive_time'    => 1,
        );
        $user_id = user_add($user_row);*/

    }


}