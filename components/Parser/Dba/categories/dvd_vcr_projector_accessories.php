<?php

use app\models\Category;
use app\models\AdType;

return [
    Category::DVD_PLAYERS => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/dvd-afspillere-videomaskiner-projektorer-og-tilbehoer/dvd-afspillere-mm/',
        'types' => [
            AdType::SELL      => 64,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::PROJECTOR_ACCESSORIES => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/dvd-afspillere-videomaskiner-projektorer-og-tilbehoer/projektorer-og-tilbehoer/',
        'types' => [
            AdType::SELL      => 25,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::DVD_HARD_DISK_RECORDERS => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/dvd-afspillere-videomaskiner-projektorer-og-tilbehoer/dvd-og-harddiskoptagere/',
        'types' => [
            AdType::SELL      => 16,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::VIDEO_MACHINES => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/dvd-afspillere-videomaskiner-projektorer-og-tilbehoer/videomaskiner/',
        'types' => [
            AdType::SELL      => 8,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
];

?>