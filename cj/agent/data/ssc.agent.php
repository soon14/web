<?php
/* 时时彩数据统计 */
defined('IN_AGENT')||exit('Access Denied');

$return = [];

$params = [
    ':id' => 0,
    ':uid' => $uid,
    ':stime' => 0,
    ':etime' => 0,
    ':type' => '重庆时时彩',
];

foreach($time_list as $time){
    $params[':id'] = 0;
    $params[':stime'] = date('Y-m-d 00:00:00', $time);
    $params[':etime'] = date('Y-m-d 23:59:59', $time);

    $stmt = $mydata1_db->prepare('SELECT COUNT(*) AS `count` FROM `c_bet` WHERE `id`>:id AND `uid`=:uid AND `addtime` BETWEEN :stime AND :etime AND `js`=1 AND `type`=:type');
    $stmt->execute($params);
    $rows = $stmt->fetch();
    $count = $rows['count'];

    $bet_amount = 0;
    $net_amount = 0;
    $valid_amount = 0;
    $rows_num = $count;
    while ($count>0) {
        $stmt = $mydata1_db->prepare('SELECT `id`, `money`, `win` FROM `c_bet` WHERE `id`>:id AND `uid`=:uid AND `addtime` BETWEEN :stime AND :etime AND `js`=1 AND `type`=:type ORDER BY `id` ASC LIMIT 5000');
        $stmt->execute($params);
        while ($rows = $stmt->fetch()) {
            $params[':id'] = $rows['id'];
            $bet_amount+= $rows['money']*100;
            $net_amount+= ($rows['win']>0?$rows['win']-$rows['money']:$rows['win'])*100;
            $valid_amount+= $rows['win']==0?0:$rows['money']*100;
        }
        $count-= 5000;
    }
    if($bet_amount>0||$net_amount>0||$valid_amount>0){
        $return[$time] = [
            'ssc' => [
                'name' => '时时彩',
                'data' => [
                    'bet_amount' => $bet_amount,
                    'net_amount' => $net_amount,
                    'valid_amount' => $valid_amount,
                    'rows_num' => $rows_num,
                ]
            ]
        ];
    }
}

return $return;
