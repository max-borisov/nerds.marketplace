<?php

$config = [
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
];

return array_merge(
    $config,
    require __DIR__ . '/params-local.php'
);
