<?php

use app\models\Category;
use app\models\AdType;

return [
    Category::DIGITAL_RECEIVERS => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/paraboler-antenner-og-tilbehoer/digitale-receivere/',
        'types' => [
            AdType::SELL      => 37,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::OTHER_EQUIPMENT => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/paraboler-antenner-og-tilbehoer/andet-udstyr/',
        'types' => [
            AdType::SELL      => 18,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::SATELLITE_MONITORS_BOWLS => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/paraboler-antenner-og-tilbehoer/parabolskaerme-og-skaale/',
        'types' => [
            AdType::SELL      => 13,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::ANALOG_RECEIVERS => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/paraboler-antenner-og-tilbehoer/analoge-receivere/',
        'types' => [
            AdType::SELL      => 1,
            AdType::BUY       => 0,
            AdType::EXCHANGE  => 0,
        ]
    ],
];

?>