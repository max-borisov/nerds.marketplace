<?php

use app\models\Category;
use app\models\AdType;

return [
    Category::CANON_DIGITAL => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/digitale-kameraer/canon/',
        'types' => [
            AdType::SELL      => 48,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::OTHER_DIGITAL_CAMERAS => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/digitale-kameraer/andre-digitale-kameraer/',
        'types' => [
            AdType::SELL      => 38,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::SONY_DIGITAL => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/digitale-kameraer/sony/',
        'types' => [
            AdType::SELL      => 21,
            AdType::BUY       => 0,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::OLYMPUS_DIGITAL => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/digitale-kameraer/olympus/',
        'types' => [
            AdType::SELL      => 11,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::HP_DIGITAL => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/digitale-kameraer/hp/',
        'types' => [
            AdType::SELL      => 3,
            AdType::BUY       => 0,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::MINOLTA_DIGITAL => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/digitale-kameraer/minolta/',
        'types' => [
            AdType::SELL      => 1,
            AdType::BUY       => 0,
            AdType::EXCHANGE  => 0,
        ]
    ],
];

?>