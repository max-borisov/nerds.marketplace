<?php

require_once 'phpBBRegClass.php';

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../../../forum.nerds.dk/phpBB3/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_user.' . $phpEx);

$phpBB = new PhpBBRegClass();
//$phpBB->username    = 'max ' . rand(1, 100);
$phpBB->username    = 'max 9612';
$phpBB->password    = phpbb_hash('12345');
$phpBB->email       = 'max.bor@yahoo.com ';
$user_row = $phpBB->addUser();
echo "<pre>";
print_r($user_row);
echo "</pre>";
