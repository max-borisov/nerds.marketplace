<?php

use app\models\Category;
use app\models\AdType;

return [
    Category::SPEAKERS_HIFI => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/hoejttalere-hi-fi/',
        'types' => [
            AdType::SELL      => 96,
            AdType::BUY       => 3,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::STEREO => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/stereoanlaeg/',
        'types' => [
            AdType::SELL      => 131,
            AdType::BUY       => 2,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::HEADPHONES => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/hovedtelefoner/',
        'types' => [
            AdType::SELL      => 83,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::RADIO => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/radioer/',
        'types' => [
            AdType::SELL      => 82,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::AMPLIFIERS_HIFI => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/forstaerkere-hi-fi/',
        'types' => [
            AdType::SELL      => 70,
            AdType::BUY       => 3,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::TURNTABLE => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/pladespillere/',
        'types' => [
            AdType::SELL      => 37,
            AdType::BUY       => 2,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::CD_PLAYER => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/cd-afspillere/',
        'types' => [
            AdType::SELL      => 32,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::MP3_MP4_PLAYERS => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/mp3-mp4-afspillere/',
        'types' => [
            AdType::SELL      => 28,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::RECORDERS => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/baandoptagere/',
        'types' => [
            AdType::SELL      => 25,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::MP3_ACCESSORIES => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/tilbehoer-til-mp3-afspilllere/',
        'types' => [
            AdType::SELL      => 8,
            AdType::BUY       => 0,
            AdType::EXCHANGE  => 0,
        ]
    ],
    Category::MINI_DISC_PLAYER => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/minidisc-afspillere/',
        'types' => [
            AdType::SELL      => 6,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
];

?>