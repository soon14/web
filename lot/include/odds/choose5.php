<?php
!defined('IN_LOT') && die('Access Denied');
/* 11选5投注信息 */
$return    = [];
$return[6] = [
    '总和',
    [
        1 => '总和大',
        2 => '总和小',
        3 => '总和单',
        4 => '总和双'
    ],
];
$return[1] = [
    '正码一',
    [
        1  => '大',
        2  => '小',
        3  => '单',
        4  => '双',
        5  => '1',
        6  => '2',
        7  => '3',
        8  => '4',
        9  => '5',
        10 => '6',
        11 => '7',
        12 => '8',
        13 => '9',
        14 => '10',
        15 => '11',
    ],
];
$a=3;
$b=3;
$c= $a.$b;
$return[2] = $return[3] = $return[4] = $return[5] = $return[1];

$return[2][0] = '正码二';
$return[3][0] = '正码三';
$return[4][0] = '正码四';
$return[5][0] = '正码五';
$return[7]    = [
    '全五中一',
    [
        1  => '1',
        2  => '2',
        3  => '3',
        4  => '4',
        5  => '5',
        6  => '6',
        7  => '7',
        8  => '8',
        9  => '9',
        10 => '10',
        11 => '11',
        12 => '大',
        13 => '小',
        14 => '单',
        15 => '双',
    ]
];
$return[8]    = [
    '正码一VS正码二',
    [
        1 => '龙',
        2 => '虎'
    ]
];
$return[9]    = [
    '正码一VS正码三',
    [
        1 => '龙',
        2 => '虎'
    ]
];
$return[10]   = [
    '正码一VS正码四',
    [
        1 => '龙',
        2 => '虎'
    ]
];
$return[11]   = [
    '正码一VS正码五',
    [
        1 => '龙',
        2 => '虎'
    ]
];
$return[12]   = [
    '正码二VS正码三',
    [
        1 => '龙',
        2 => '虎'
    ]
];
$return[13]   = [
    '正码二VS正码四',
    [
        1 => '龙',
        2 => '虎'
    ]
];
$return[14]   = [
    '正码二VS正码五',
    [
        1 => '龙',
        2 => '虎'
    ]
];
$return[15]   = [
    '正码三VS正码四',
    [
        1 => '龙',
        2 => '虎'
    ]
];
$return[16]   = [
    '正码三VS正码五',
    [
        1 => '龙',
        2 => '虎'
    ]
];
$return[17]   = [
    '正码四VS正码五',
    [
        1 => '龙',
        2 => '虎'
    ]
];

return $return;