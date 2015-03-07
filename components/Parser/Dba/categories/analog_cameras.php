<?php

use app\models\Category;
use app\models\AdType;

return [
    Category::OTHER_ANALOG_CAMERAS => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/analoge-kameraer/andre-analoge-kameraer/',
        'types' => [
            AdType::SELL      => 36,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::CANON_ANALOG => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/analoge-kameraer/canon/',
        'types' => [
            AdType::SELL      => 11,
            AdType::BUY       => 0,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::NIKON_ANALOG => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/analoge-kameraer/nikon/',
        'types' => [
            AdType::SELL      => 9,
            AdType::BUY       => 0,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::MINOLTA_ANALOG => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/analoge-kameraer/minolta/',
        'types' => [
            AdType::SELL      => 8,
            AdType::BUY       => 0,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::OLYMPUS_ANALOG => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/analoge-kameraer/olympus/',
        'types' => [
            AdType::SELL      => 4,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::PENTAX_ANALOG => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/analoge-kameraer/pentax/',
        'types' => [
            AdType::SELL      => 4,
            AdType::BUY       => 0,
            AdType::EXCHANGE  => 0,
        ]
    ],
];

?>