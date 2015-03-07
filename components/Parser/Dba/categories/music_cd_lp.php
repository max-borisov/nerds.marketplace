<?php

use app\models\Category;
use app\models\AdType;

return [
    Category::LP => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/musik-cd-lp-og-baand/lp/',
        'types' => [
            AdType::SELL      => 192,
            AdType::BUY       => 7,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::MUSIC_CD => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/musik-cd-lp-og-baand/musik-cd/',
        'types' => [
            AdType::SELL      => 192,
            AdType::BUY       => 3,
            AdType::EXCHANGE  => 0,
        ]
    ]
];

?>