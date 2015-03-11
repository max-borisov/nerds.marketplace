<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
//    'enableStrictParsing' => true,
    'rules' => [
        '/signup' => 'session/signup',
        '/signin' => 'session/signin',
        '/logout' => 'session/logout',
        '/update-password' => 'session/updatepassword',
        '/confirm-email/<hash:[a-z\d]+>' => 'session/confirmemail',

        'category/update/<id:\d+>'  => 'category/update',
        'category/delete/<id:\d+>'  => 'category/delete',

        'item/create'           => 'items/create',
        'item/view/<id:\d+>'    => 'items/view',
        'item/delete/<id:\d+>'  => 'items/delete',
        'item/edit/<id:\d+>'    => 'items/edit',
        'item/upload'           => 'items/upload',
        'item/preview/delete/<id:\d+>' => 'items/deletepreview',

        'items' => 'items/items',

        '/news/view/<id:\d+>'       => 'news/view',
        '/reviews/view/<id:\d+>'    => 'reviews/view',
        '/games/view/<id:\d+>'      => 'games/view',
        '/tv/view/<id:\d+>'         => 'tv/view',
        '/music/view/<id:\d+>'      => 'music/view',
        '/movies/view/<id:\d+>'     => 'movies/view',
    ],
];