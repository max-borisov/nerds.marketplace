<?php

use app\models\Category;
use app\models\AdType;

return [
    Category::TV_ACCESSSORIES => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/tv-og-tilbehoer/tilbehoer-til-tv/',
        'types' => [
            AdType::SELL      => 167,
            AdType::BUY       => 2,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::TV_22_28 => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/tv-og-tilbehoer/tv-22-28/',
        'types' => [
            AdType::SELL      => 75,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::TV_29_41 => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/tv-og-tilbehoer/tv-29-41/',
        'types' => [
            AdType::SELL      => 72,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::TV_OVER_41 => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/tv-og-tilbehoer/tv-over-41/',
        'types' => [
            AdType::SELL      => 31,
            AdType::BUY       => 2,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::TV_OTHER => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/tv-og-tilbehoer/andre-tv/',
        'types' => [
            AdType::SELL      => 8,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::TV_UNDER_15 => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/tv-og-tilbehoer/tv-under-15/',
        'types' => [
            AdType::SELL      => 4,
            AdType::BUY       => 0,
            AdType::EXCHANGE  => 0,
        ]
    ],
];

?>