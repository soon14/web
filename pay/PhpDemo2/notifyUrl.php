<?php/** * 异步通知demo */error_reporting(E_ALL);header("Content-type: text/html; charset=utf-8");require_once('yidao.php');$ydpay = new yidao();//验证签名$str = json_decode(stripslashes($_REQUEST['reqJson']));//验证签名if ($data = $ydpay->VerifySign($str->transData)){    if($data['isClearOrCancel']=="0"){        echo order_paid($data["reqMsgId"],2);        die("SUCCESS");        return true;    }}die("ERROR");