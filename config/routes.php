<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
//    'enableStrictParsing' => true,
    'rules' => [
        'marketplace' => 'marketplace/index',
        'category/update/<id:\d+>' => 'category/update',
        'category/delete/<id:\d+>' => 'category/delete',
    ],
];