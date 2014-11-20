<?php

return [
    'adminEmail' => 'admin@example.com',

    'host' => 'http://local.marketplace.nerds',
    // Script name for users registration
    'phpBBExternalRegistrationScriptName' => 'phpbb.php',
    'phpBBExternalRegistrationSecret' => 'H4bN@#5n~b$bNMlOMapo',

    // Item thumb params
    'thumb' => [
        'width'         => 250,
        'height'        => 200,
        'quality'       => 50,
        'extension'     => '.jpg',
        'placeholder'   => 'http://placehold.it/250x200',
    ],

    // Max amount of images could be added to one item
    'maxUploadImages' => 5,

    'phpBBForumPath' => __DIR__. '/../../../forum.nerds.dk/phpBB3/',
];
