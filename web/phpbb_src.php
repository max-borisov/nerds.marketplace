<?php

define('IN_PHPBB', true);
echo $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../../../forum.nerds.dk/phpBB3/';


//print_r(realpath(HelperBase::getParam('phpBBForumPath')));
//return;

//$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : HelperBase::getParam('phpBBForumPath');

$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_user.' . $phpEx);

//echo 234;

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
$user_id = user_add($user_row);

echo "<pre>";
print_r($user_id);
echo "</pre>";
