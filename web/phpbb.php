<?php
// Include app params
$yiiConfig = require __DIR__ . '/../config/params.php';

if ((int)checkAccess($yiiConfig)) {
    define('IN_PHPBB', true);
    $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : $yiiConfig['phpBBForumPath'];
    $phpEx = substr(strrchr(__FILE__, '.'), 1);
    include($phpbb_root_path . 'common.' . $phpEx);
    include($phpbb_root_path . 'includes/functions_user.' . $phpEx);

    require_once 'phpBBRegClass.php';

    $phpBB = new PhpBBRegClass();
    $phpBB->username    = $request->variable('name', '');
    $phpBB->password    = phpbb_hash($request->variable('password', ''));
    $phpBB->email       = $request->variable('email', '');
    echo $user_row = $phpBB->addUser();
} else {
    // @todo Log error
    echo 0;
}

function checkAccess($yiiParams) {
    // Host mismatch
    if (str_replace('http://', '', $yiiParams['host']) != $_SERVER['HTTP_HOST']) {
        // @todo Log error
        return false;
    }

    // Incorrect parameters
    if (!isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['secret'])) {
        // @todo Log error
        return false;
    }

    // Incorrect secret
    if ($yiiParams['phpBBExternalRegistrationSecret'] != $_POST['secret']) {
        // @todo Log error
        return false;
    }

    return true;
}

