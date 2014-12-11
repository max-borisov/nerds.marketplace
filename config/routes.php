<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
//    'enableStrictParsing' => true,
    'rules' => [
        '/signup' => 'session/signup',
        '/signin' => 'session/signin',
        '/logout' => 'session/logout',
        'category/update/<id:\d+>' => 'category/update',
        'category/delete/<id:\d+>' => 'category/delete',
        'item/view/<id:\d+>' => 'marketplace/view',
        'item/delete/<id:\d+>' => 'marketplace/delete',
        'items' => 'marketplace/items',
    ],
];