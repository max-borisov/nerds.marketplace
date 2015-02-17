<?php
/**
 * Application configuration shared by all test types
 */
return [
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost:3306;dbname=nerds_test',
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];
