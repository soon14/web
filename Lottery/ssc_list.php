<?php 
session_start();
include_once '../include/config.php';
website_close();
website_deny();
include_once '../database/mysql.config.php';
include_once '../common/logintu.php';
include_once '../common/function.php';
include_once '../include/lottery.inc.php';
include_once 'include/auto_class.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
  <html xmlns="http://www.w3.org/1999/xhtml"> 
  <head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
  <title>重庆时时彩开奖结果</title> 
  <link type="text/css" rel="stylesheet" href="css/ssc.css"/> 
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> 
  <style> 
      a:link, a:visited, a:active, a:hover { color: #F9E101;} 
  </style> 
  </head> 
  <body> 
  <div class="lottery_main" style="margin: 0px auto;"> 
  <div class="ssc_left"> 
      <div class="touzhu" style="margin: 0px;"> 
          <table class="bian" border="0" cellpadding="0" cellspacing="1"> 
              <tr class="bian_tr_title"> 
                  <td colspan="10">重庆时时彩开奖结果</td> 
              </tr> 
              <tr class="bian_tr_txt"> 
                  <td colspan="10">选择日期查看： 
                    <a href="ssc_list.php?t=1"><?=date("Y-m-d",$lottery_time);?></a>&nbsp;&nbsp;
                    <a href="ssc_list.php?t=2"><?=date("Y-m-d",$lottery_time-1*24*3600);?></a>&nbsp;&nbsp;
                    <a href="ssc_list.php?t=3"><?=date("Y-m-d",$lottery_time-2*24*3600);?></a>&nbsp;&nbsp;
                    <a href="ssc_list.php?t=4"><?=date("Y-m-d",$lottery_time-3*24*3600);?></a>&nbsp;&nbsp;
                    <a href="ssc_list.php?t=5"><?=date("Y-m-d",$lottery_time-4*24*3600);?></a>&nbsp;&nbsp;
                    <a href="ssc_list.php?t=6"><?=date("Y-m-d",$lottery_time-5*24*3600);?></a>&nbsp;&nbsp;
                    <a href="ssc_list.php?t=7"><?=date("Y-m-d",$lottery_time-6*24*3600);?></a>
                  </td> 
              </tr> 
              <tr class="bian_tr_title"> 
                  <td width="18%">开奖时间</td> 
                  <td width="13%">彩票期号</td> 
                  <td width="6%">一</td> 
                  <td width="6%">二</td> 
                  <td width="6%">三</td> 
                  <td width="6%">四</td> 
                  <td width="6%">五</td> 
                  <td width="14%">总和</td> 
                  <td width="8%">龙虎</td> 
                  <td width="19%">前三/中三/后三</td> 
              </tr>
<?php
 $t = $_GET['t'];
$t = intval($t);
if (($t <= 0) || (7 < $t)){
	$t = 1;
}
$tday = date('Y-m-d', $lottery_time - (($t - 1) * 24 * 3600));
$params = array(':datetime' => $tday);
$sql = 'select * from c_auto_2 where DATEDIFF(datetime,:datetime)=0 order by qishu desc';
$stmt = $mydata1_db->prepare($sql);
$stmt->execute($params);
while ($rows = $stmt->fetch()){
	$color = '#FFFFFF';
	$over = '#EBEBEB';
	$out = '#ffffff';
	$hm = array();
	$hm[] = $rows['ball_1'];
	$hm[] = $rows['ball_2'];
	$hm[] = $rows['ball_3'];
	$hm[] = $rows['ball_4'];
	$hm[] = $rows['ball_5'];
?>
	            <tr class="bian_tr_txt"> 
                  <td><?=$rows['datetime'];?></td> 
                  <td><?=$rows['qishu'];?></td> 
                  <td><img src="/Lottery/Images/Ball_2/<?=$rows['ball_1'];?>.png"></td> 
                  <td><img src="/Lottery/Images/Ball_2/<?=$rows['ball_2'];?>.png"></td> 
                  <td><img src="/Lottery/Images/Ball_2/<?=$rows['ball_3'];?>.png"></td> 
                  <td><img src="/Lottery/Images/Ball_2/<?=$rows['ball_4'];?>.png"></td> 
                  <td><img src="/Lottery/Images/Ball_2/<?=$rows['ball_5'];?>.png"></td> 
                  <td><?=Ssc_Auto($hm, 1);?> /<?=Ssc_Auto($hm, 2);?> /<?=Ssc_Auto($hm, 3);?></td> 
                  <td><?=Ssc_Auto($hm, 4);?></td> 
                  <td><?=Ssc_Auto($hm, 5);?> /<?=Ssc_Auto($hm, 6);?> /<?=Ssc_Auto($hm, 7);?></td> 
              </tr><?php }?>       </table> 
      </div> 
  </div> 
  </div> 
  </body> 
  </html>