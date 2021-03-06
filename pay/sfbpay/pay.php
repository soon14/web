<?php 
  if(
    $_SERVER['REQUEST_METHOD']!='POST'||
    (!isset($_POST['S_Name'])||empty($_POST['S_Name']))
){
    exit('Access Denied1');
}

$pay_online = $_POST['pay_online'];
//include('./config.php'); 
include("../moneyconfig.php");
include("../../../cache/website.php");
include("../../../database/mysql.config.php");
include_once '../moneyfunc.php';
$query = $mydata1_db->prepare('SELECT uid,username FROM `k_user` WHERE `username`=:username');
$query->execute(array(':username' => $_POST['S_Name']));
if($query->rowCount()>0){
    $rows = $query->fetch();
}else{
    exit('Access Denied');
}

(!isset($_POST['MOAmount'])||!preg_match('/^\d+(\.\d+)?$/', $_POST['MOAmount']))&&$_POST['MOAmount'] = $web_site['ck_limit'];
$_POST['MOAmount'] = number_format($_POST['MOAmount']<$web_site['ck_limit']?$web_site['ck_limit']:$_POST['MOAmount'], 2, '.', '');
  //定义
  $merchantCode = $pay_mid;
  $md5Key = $pay_mkey;
  $noticeUrl = $notice_url;
  $amount = $_POST['MOAmount'] * 100;
  $ext = $rows['uid']."||".$_REQUEST['pay_online'];
  
  //echo $ext;
  if($_REQUEST['S_Type']=='WECHAT'){
      $payChannel='902';
  }
  if($_REQUEST['S_Type']=='WXWAP'){
      $payChannel='913';
  }  
  if($_REQUEST['S_Type']=='ALIPAY'){
      $payChannel='903';
  }
  if($_REQUEST['S_Type']=='ALIWAP'){
      $payChannel='904';
  }  
  if($_REQUEST['S_Type']=='QQPAY'){
      $payChannel='908';
  }
  if($_REQUEST['S_Type']=='UNIONPAY'){
      $payChannel='914';
  }
  if($_REQUEST['S_Type']=='JDPAY'){
      $payChannel='910';
  }
  //增加 订单
  $_payId = time().rand(10000,99999);
  $stmt = $mydata1_db->prepare('INSERT INTO `k_money_order` (`uid`, `username`, `mid`, `did`, `pay_online`, `amount`, `status`) VALUES (:uid, :username, :mid, :did, :pay_online, :amount, 0)');
  $stmt->execute(array(
      ':uid' => $rows['uid'],
      ':username' => $rows['username'],
      ':mid' => $_payId,
      ':did' => '',
      ':pay_online' => $pay_online,
      ':amount' => $_POST['MOAmount'] / 100,
  ));
  
  
  require 'get.php';
  $res = json_decode($res_json,true);
if($res['returncode']=='00'){
    $data = array();
    $data['status'] = 1;
    $data['message'] = $res['url'];
   
    
}else{
    $data['status'] ='error';
    $data['message'] = $res['msg'];
}

if(strpos($_SERVER['HTTP_REFERER'],'mobilePay.php?')){
       $qrcode= $res['url'];
      $qrcode = base64_encode($qrcode);
      $url = "/member/pay/qrcodex.php?s={$qrcode}&k=2";
      echo "<div align='center'><img  src='{$url}' width='320'/></div>";
}else{
   $jsonCallback = htmlspecialchars($_REQUEST ['callback']);
   echo $jsonCallback.'('.json_encode($data).')';
   
}

?>