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

    // Max amount of images could be uploaded for one item at one time
    'maxUploadImages' => 5,
    'siteName' => 'Nerds marketplace',
    // Shown on the catalog page
    'currency' => 'DKK',
    // Max length of the shown description text
    'itemDescriptionMaxLength' => 200,

    // Images base url
    'HiFi4AllPic' => 'http://www.hifi4all.dk/ksb',
];

return array_merge(
    $config,
    require __DIR__ . '/params-local.php'
);
