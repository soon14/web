<?php
session_start();
header("Content-Type:text/html; charset=utf-8");
$C_Patch = $_SERVER['DOCUMENT_ROOT'];
include_once ("../include/function.php");
include_once $C_Patch."/class/user.php";

$callback = $_GET['callback'];
if(!empty($_SESSION['adminid']) && !empty($_REQUEST["uid"])){
  $uid = (int)$_REQUEST["uid"];
}else{
  $uid = $_SESSION["uid"];
}
$typeName = '新PT电子';
$data = array();
if(!check_game('PT2')){
    die($callback.'('.json_encode(['info'=>'no','msg'=>'<font color=red>维护中</font>']).')');
}
if(!empty($uid)){
  $userinfo = user::getinfo($uid);
  $client = new rpcclient($cj_url);

  $session = '';
  $account = '';
  if($userinfo['ispt2'] != 1){//如果没有注册
    $arr = $client->liveregpt($site_id,$userinfo['username']);
    if(is_array($arr) and $arr){
      if($arr['info']=='ok'){
        $params = array(':username'=>$userinfo['username'],':pt2UserName'=>$arr['username'],':pt2PassWord'=>$arr['password'],':uid'=>$uid);
        $sql = 'update  mydata1_db.k_user set pt2UserName=:pt2UserName,pt2Addtime=now(),ispt2=1,pt2PassWord=:pt2PassWord where ispt2=0 and username = :username and uid=:uid';
        $stmt = $mydata1_db->prepare($sql);
        $stmt -> execute($params);

        $userinfo = user::getinfo($uid);
      }else{
        $data['info'] = 'no';
        $data['msg']  = '<font color=red>&nbsp;--&nbsp;</font>';

        echo $callback.'('.json_encode($data).')';
        exit;
      }
    }else{
      $data['info'] = 'no';
      $data['msg']  = '<font color=red>&nbsp;---&nbsp;</font>';
      echo $callback.'('.json_encode($data).')';
      exit;
    }
  }
  

  $arrUrl = $client->livebalancept($site_id,$userinfo['pt2UserName']);
  if(is_array($arrUrl) and $arrUrl){

    if($arrUrl['info'] == 'ok'){
      $data['info'] = 'ok';
      $data['msg']  = sprintf("%.2f",$arrUrl['money']);
      $data['name']  = $userinfo['pt2UserName'];
      $params = array();
      $params[':uid']=$userinfo['uid'];
      $params[':pt2money'] = $data['msg'];
      $sql = 'update  mydata1_db.k_user set pt2money=:pt2money,pt2Addtime=now() where ispt2=1 and uid=:uid';
      $stmt = $mydata1_db->prepare($sql);
      $stmt -> execute($params);
      echo $callback.'('.json_encode($data).')';
      exit;
    }else{
      $data['info'] = 'no';
      $data['msg']  = $arrUrl['msg'];//'<font color=red>&nbsp;-a&nbsp;</font>';
      echo $callback.'('.json_encode($data).')';
      exit;
    }

  }else{
    $data['info'] = 'no';
    $data['msg']  = '<font color=red>&nbsp;--&nbsp;</font>';
    echo $callback.'('.json_encode($data).')';
    exit;
  }

}else{
  $data['info'] = 'no';
  $data['msg'] = '<font color=red>&nbsp;--&nbsp;</font>';

  echo $callback.'('.json_encode($data).')';
  exit;
}


?>