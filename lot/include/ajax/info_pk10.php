<?php
!defined('IN_LOT')&&die('Access Denied');
$LOT['output']['Success'] = 1;
$LOT['output']['Msg'] = '';
$LOT['output']['Obj']['CurrentPeriod'] = 0; //当前期号
$LOT['output']['Obj']['CloseCount'] = 0; //剩余封盘时间，单位：秒
$LOT['output']['Obj']['OpenCount'] = 0; //剩余开奖时间，单位：秒
$LOT['output']['Obj']['PrePeriodNumber'] = 0; //最近开奖期号
$LOT['output']['Obj']['PreResult'] = ''; //最近开奖结果
$LOT['output']['Obj']['PreResultData'] = ''; //最近开奖结果对应中文
$LOT['output']['Obj']['WinLoss'] = '0.00'; //会员盈亏
$LOT['output']['Obj']['NotCountSum'] = '0.00'; //未结算金额
$LOT['output']['Obj']['ChangLong'] = array(); //两面长龙
$LOT['output']['Obj']['Lines'] = array(); //赔率
$LOT['output']['Obj']['LuZhu'] = array();
// $LOT['output']['Obj']['LuZhu'][] = array('c' => '', 'n' => '冠亚和', 'p' => 0);
// $LOT['output']['Obj']['LuZhu'][] = array('c' => '', 'n' => '冠亚和大小', 'p' => 0);
// $LOT['output']['Obj']['LuZhu'][] = array('c' => '', 'n' => '冠亚和单双', 'p' => 0);
/* 查询盘口信息 */
$LOT['output']['Obj']['ZongchuYilou'] = array('miss' => array(), 'hit' => array());
$params = array(':kaipan' => date('H:i:s', $LOT['bjtime']), ':kaijiang' => date('H:i:s', $LOT['bjtime']));
$sql = 'SELECT `qishu`, `kaipan`, `fengpan`, `kaijiang` FROM `c_opentime_4` WHERE `kaipan`<=:kaipan AND `kaijiang`>=:kaijiang ORDER BY `kaijiang` ASC';
$stmt = $mydata1_db->prepare($sql);
$stmt->execute($params);
$daynum = floor(($LOT['bjtime']-strtotime($web_site['pk10_ktime'].' 00:00:00'))/3600/24)-1;
//echo $daynum;
if($stmt->rowCount()>0){
    $rows = $stmt->fetch();
    $LOT['output']['Obj']['CurrentPeriod']+= $web_site['pk10_knum'];
    $LOT['output']['Obj']['CurrentPeriod']+= $rows['qishu'];
    $LOT['output']['Obj']['CurrentPeriod']+= $daynum*179;
    $LOT['output']['Obj']['CloseCount'] = strtotime(date('Y-m-d', $LOT['bjtime']).' '.$rows['fengpan']);
    $LOT['output']['Obj']['OpenCount'] = strtotime(date('Y-m-d', $LOT['bjtime']).' '.$rows['kaijiang']);
    // if(strtotime(date('Y-m-d', $LOT['bjtime']).' '.$rows['kaipan'])>$LOT['output']['Obj']['OpenCount']){
    //     /* 隔日开奖，加一天 */
    //     $LOT['output']['Obj']['CloseCount']+= 86400;
    //     $LOT['output']['Obj']['OpenCount']+= 86400;
    // }
    $LOT['output']['Obj']['CloseCount']-= $LOT['bjtime'];
    $LOT['output']['Obj']['OpenCount']-= $LOT['bjtime'];
    $web_site['pk10']!=0&&$LOT['output']['Obj']['CloseCount'] = 0;
    /* 加载赔率信息 */
    $sql = 'SELECT * FROM `c_odds_4` ORDER BY `id` ASC';
    $query = $mydata1_db->query($sql);
    while($rows = $query->fetch()){
        $id1 = substr($rows['type'], 5);
        if(isset($LOT['odds'][$id1])){
            foreach($rows as $key=>$val){
                if(substr($key, 0, 1)=='h'){
                    $id2 = substr($key, 1);
                    $key = 'j'.show_id($id1, $id2);
                    isset($LOT['odds'][$id1][1][$id2])&&$LOT['output']['Obj']['Lines'][$key] = floatval($val);
                    // isset($LOT['odds'][$id1][1][$id2])&&$LOT['output']['Obj']['Lines'][$key] = sprintf('%.2f', $val);
                }
            }
        }
    }
}else{
    $sql = 'SELECT `qishu`, `kaijiang` FROM `c_opentime_4` ORDER BY `kaijiang` ASC LIMIT 1';
    $query = $mydata1_db->query($sql);
    if($query->rowCount()>0){
        $rows = $query->fetch();
        $LOT['output']['Obj']['CurrentPeriod']+= $web_site['pk10_knum'];
        $LOT['output']['Obj']['CurrentPeriod']+= $rows['qishu'];
        $LOT['output']['Obj']['CurrentPeriod']+= ($daynum+1)*179-20;
        $LOT['output']['Obj']['OpenCount'] = strtotime(date('Y-m-d', $LOT['bjtime']+86400).' '.$rows['kaijiang']);
        $LOT['output']['Obj']['OpenCount']-= $LOT['bjtime'];
    }else{
        $LOT['output']['Success'] = 0;
        $LOT['output']['Msg'] = '已封盘，请稍后尝试';
    }
}
/* 加载长龙信息 */
$cache_pk10 = IN_LOT.'../cache/lot_pk10.php';
if($LOT['more']&&file_exists($cache_pk10)){
    $cache_pk10 = include($cache_pk10);
    if(isset($cache_pk10['output'])){
        if(isset($LOT['input']['numberPostion'])&&intval($LOT['input']['numberPostion'])==0){
            $LOT['output']['Obj']['LuZhu'] = $cache_pk10['output']['LuZhu'];
        }
        $LOT['output']['Obj']['ChangLong'] = $cache_pk10['output']['ChangLong'];
    }
}
/* 查询开奖信息 */
$query = $mydata1_db->query('SELECT `qishu`, `ball_1`, `ball_2`, `ball_3`, `ball_4`, `ball_5`, `ball_6`, `ball_7`, `ball_8`, `ball_9`, `ball_10` FROM `c_auto_4` ORDER BY `qishu` DESC LIMIT 1');
if($query->rowCount()>0){
    $rows = $query->fetch();
    $LOT['output']['Obj']['PrePeriodNumber'] = $rows['qishu'];
    $rows['data'] = $rows['list'] = array();
    foreach($rows as $key=>$val){
        substr($key, 0, 4)=='ball'&&$rows['list'][] = $val;
    }
    $rows['data'][] = $rows['list'][0]+$rows['list'][1];
    $rows['data'][] = $rows['data'][0]==11?'和':(fmod($rows['data'][0], 2)==0?'双':'单');
    $rows['data'][] = $rows['data'][0]==11?'和':($rows['data'][0]>11?'大':'小');
    for($i=0;$i<5;$i++){
        $rows['data'][] = $rows['list'][$i]>$rows['list'][9-$i]?'龙':'虎';
    }
    $LOT['output']['Obj']['PreResult'] = implode(',', $rows['list']);
    $LOT['output']['Obj']['PreResultData'] = implode(',', $rows['data']);
}
/* 查询用户数据 */
if($LOT['user']['login']){
    $params = array(':time' => date('Y-m-d 12:00:00', $LOT['mdtime']-43200), ':type' => '北京赛车PK拾', ':uid' => $LOT['user']['uid']);
    $sql = 'SELECT SUM(IF(`js`=0, `money`, 0)) AS `bet_money`, SUM(IF(`js`=0, 0, CASE WHEN `win`>0 THEN `win`-`money` ELSE `win` END)) AS `win_money` FROM `c_bet_3` WHERE `addtime`>=:time AND `type`=:type AND `uid`=:uid';
    $stmt = $mydata1_db->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetch();
    $LOT['output']['Obj']['WinLoss'] = sprintf('%.2f', $rows['win_money']);
    $LOT['output']['Obj']['NotCountSum'] = sprintf('%.2f', $rows['bet_money']);
}