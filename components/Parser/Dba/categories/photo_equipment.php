<?php

use app\models\Category;
use app\models\AdType;

return [
    Category::EQUIPMENT_ACCESSORIES => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/fotoudstyr/andet-fotoudstyr-og-tilbehoer/',
        'types' => [
            AdType::SELL      => 146,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::LENSES => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/fotoudstyr/objektiver-linser/',
        'types' => [
            AdType::SELL      => 71,
            AdType::BUY       => 2,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::BLITZ => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/fotoudstyr/blitz/',
        'types' => [
            AdType::SELL      => 12,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::MEMORY_CARDS => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/fotoudstyr/hukommelseskort/',
        'types' => [
            AdType::SELL      => 5,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::DARKROOM_EQUIPMENT => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/fotoudstyr/moerkekammerudstyr/',
        'types' => [
            AdType::SELL      => 4,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
];

?>