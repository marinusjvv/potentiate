<?php

define('MAX_VALUE', 250);

define(
    'COST_LIST',
    json_encode(
        array(
            0 => array(
                'charge' => 5,
                'low_weight' => 0,
                'high_weight' => 199,
            ),
            1 => array(
                'charge' => 10,
                'low_weight' => 200,
                'high_weight' => 499,
            ),
            2 => array(
                'charge' => 15,
                'low_weight' => 500,
                'high_weight' => 999,
            ),
            3 => array(
                'charge' => 20,
                'low_weight' => 1000,
                'high_weight' => 5000,
            ),
        )
    )
);

define(
    'ITEM_LIST',
    json_encode(
        array(
            1 => array(
                'name' => 'Item 1',
                'price' => 10,
                'weight' => 200,
            ),
            2 => array(
                'name' => 'Item 2',
                'price' => 100,
                'weight' => 20,
            ),
            3 => array(
                'name' => 'Item 3',
                'price' => 30,
                'weight' => 300,
            ),
            4 => array(
                'name' => 'Item 4',
                'price' => 20,
                'weight' => 500,
            ),
            5 => array(
                'name' => 'Item 5',
                'price' => 30,
                'weight' => 250,
            ),
            6 => array(
                'name' => 'Item 6',
                'price' => 40,
                'weight' => 10,
            ),
            7 => array(
                'name' => 'Item 7',
                'price' => 200,
                'weight' => 10,
            ),
            8 => array(
                'name' => 'Item 8',
                'price' => 120,
                'weight' => 500,
            ),
            9 => array(
                'name' => 'Item 9',
                'price' => 130,
                'weight' => 790,
            ),
            10 => array(
                'name' => 'Item 10',
                'price' => 20,
                'weight' => 100,
            ),
            11 => array(
                'name' => 'Item 11',
                'price' => 10,
                'weight' => 340,
            ),
            12 => array(
                'name' => 'Item 12',
                'price' => 4,
                'weight' => 800,
            ),
            13 => array(
                'name' => 'Item 13',
                'price' => 5,
                'weight' => 200,
            ),
            14 => array(
                'name' => 'Item 14',
                'price' => 240,
                'weight' => 20,
            ),
            15 => array(
                'name' => 'Item 15',
                'price' => 123,
                'weight' => 700,
            ),
            16 => array(
                'name' => 'Item 16',
                'price' => 245,
                'weight' => 10,
            ),
            17 => array(
                'name' => 'Item 17',
                'price' => 230,
                'weight' => 20,
            ),
            18 => array(
                'name' => 'Item 18',
                'price' => 110,
                'weight' => 200,
            ),
            19 => array(
                'name' => 'Item 19',
                'price' => 45,
                'weight' => 200,
            ),
            20 => array(
                'name' => 'Item 20',
                'price' => 67,
                'weight' => 20,
            ),
            21 => array(
                'name' => 'Item 21',
                'price' => 88,
                'weight' => 300,
            ),
            22 => array(
                'name' => 'Item 22',
                'price' => 10,
                'weight' => 500,
            ),
            23 => array(
                'name' => 'Item 23',
                'price' => 17,
                'weight' => 250,
            ),
            24 => array(
                'name' => 'Item 24',
                'price' => 19,
                'weight' => 10,
            ),
            25 => array(
                'name' => 'Item 25',
                'price' => 89,
                'weight' => 10,
            ),
            26 => array(
                'name' => 'Item 26',
                'price' => 45,
                'weight' => 500,
            ),
            27 => array(
                'name' => 'Item 27',
                'price' => 99,
                'weight' => 790,
            ),
            28 => array(
                'name' => 'Item 28',
                'price' => 125,
                'weight' => 100,
            ),
            29 => array(
                'name' => 'Item 29',
                'price' => 198,
                'weight' => 340,
            ),
            30 => array(
                'name' => 'Item 30',
                'price' => 220,
                'weight' => 800,
            ),
            31 => array(
                'name' => 'Item 31',
                'price' => 249,
                'weight' => 200,
            ),
            32 => array(
                'name' => 'Item 32',
                'price' => 230,
                'weight' => 20,
            ),
            33 => array(
                'name' => 'Item 33',
                'price' => 190,
                'weight' => 700,
            ),
            34 => array(
                'name' => 'Item 34',
                'price' => 45,
                'weight' => 10,
            ),
            35 => array(
                'name' => 'Item 35',
                'price' => 12,
                'weight' => 20,
            ),
            36 => array(
                'name' => 'Item 36',
                'price' => 5,
                'weight' => 200,
            ),
            37 => array(
                'name' => 'Item 37',
                'price' => 2,
                'weight' => 200,
            ),
            38 => array(
                'name' => 'Item 38',
                'price' => 90,
                'weight' => 20,
            ),
            39 => array(
                'name' => 'Item 39',
                'price' => 12,
                'weight' => 300,
            ),
            40 => array(
                'name' => 'Item 40',
                'price' => 167,
                'weight' => 500,
            ),
            41 => array(
                'name' => 'Item 41',
                'price' => 12,
                'weight' => 250,
            ),
            42 => array(
                'name' => 'Item 42',
                'price' => 8,
                'weight' => 10,
            ),
            43 => array(
                'name' => 'Item 43',
                'price' => 2,
                'weight' => 10,
            ),
            44 => array(
                'name' => 'Item 44',
                'price' => 9,
                'weight' => 500,
            ),
            45 => array(
                'name' => 'Item 45',
                'price' => 210,
                'weight' => 790,
            ),
            46 => array(
                'name' => 'Item 46',
                'price' => 167,
                'weight' => 100,
            ),
            47 => array(
                'name' => 'Item 47',
                'price' => 23,
                'weight' => 340,
            ),
            48 => array(
                'name' => 'Item 48',
                'price' => 190,
                'weight' => 800,
            ),
            49 => array(
                'name' => 'Item 49',
                'price' => 199,
                'weight' => 200,
            ),
            50 => array(
                'name' => 'Item 50',
                'price' => 12,
                'weight' => 20,
            ),
        )
    )
);