<?php

return [
    'components' => [
        'db' => [
            'class'     => 'yii\db\Connection',
            'dsn'       => 'mysql:host=localhost:3306;dbname=nerds_test',
            'username'  => 'root',
            'password'  => 'root',
            'charset'   => 'utf8',
        ],
    ]
];
