 ﻿<?php session_start();
include_once '../include/config.php';
include_once '../database/mysql.config.php';
include_once 'login_check.php';
if (@($_GET['action']) == 'save')
{
	$uid = $_SESSION['adminid'];
	$uid = intval($uid);
	$params = array(':uid' => $uid);
	$sql = 'select * from mydata3_db.sys_admin where is_login=1 and uid=:uid limit 1';
	$stmt = $mydata1_db->prepare($sql);
	$stmt->execute($params);
	$rs = $stmt->fetch();
	if (0 < $uid)
	{
		$params = array(':login_pwd' => md5(md5($_POST['password'])), ':uid' => $uid);
		$sql = 'update mydata3_db.sys_admin set login_pwd=:login_pwd where uid=:uid';
		$stmt = $mydata1_db->prepare($sql);
		$stmt->execute($params);
		include_once '../class/admin.php';
		admin::insert_log($uid, '修改了自己的密码');
		message('操作成功');
	}
}?> <HTML> 
  <HEAD> 
  <META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=utf-8" /> 
  <TITLE>修改密码</TITLE> 
  <script language="javascript"> 
  function check_sub(){ 
	  var p1 = document.getElementById("password").value;
	  var p2 = document.getElementById("password2").value;
	  if(p1.length < 1){ 
     		  alert('请输入密码');
		  document.getElementById("password").focus();
		  return false;
	  } 
    
	  if(p1 != p2){ 
     		  alert("两次密码输入不一致");
		  document.getElementById("password2").select();
     		  return false;
	  }  
	
	  return true;
  } 
   </script> 
  <style type="text/css"> 
  <STYLE> 
  BODY { 
  SCROLLBAR-FACE-COLOR: rgb(255,204,0);
   SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
   SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
   SCROLLBAR-BASE-COLOR: rgb(255,217,93) 
  } 
  .STYLE1 {font-size: 10px} 
  .STYLE2 {font-size: 12px} 
  body {  	  margin: 0px;} 
  td{font:13px/120% "宋体";padding:3px;} 
  a{color:#FFA93E;} 
  .t-title{background:url(/super/images/06.gif);height:24px;} 
  .t-tilte td{font-weight:800;} 
  </STYLE> 
  </HEAD> 

  <body> 
  <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse;color: #225d9c;" id=editProduct   idth="100%" > 
    <tr> 
      <td height="24" nowrap background="images/06.gif"><font >&nbsp;<span class="STYLE2">修改密码</span></font></td> 
    </tr> 
    <tr> 
      <td height="24" align="center" nowrap bgcolor="#FFFFFF"><form onSubmit="return check_sub();" action="set_pwd.php?action=save" method="post" name="form1"> 
        <p>&nbsp;</p> 
        <table width="661" border="1" align="center" bordercolor="#333333"  style="border-collapse:collapse;color:#000;"> 
    <tr> 
      <td bgcolor="#F0FFFF">管理员</td> 
      <td><?=$_SESSION['login_name'];?></td> 
    </tr> 
    <tr> 
      <td width="172" bgcolor="#F0FFFF">密码</td> 
      <td width="473"><input id="password" type="password" name="password" value=""/></td> 
    </tr> 
    <tr> 
      <td bgcolor="#F0FFFF">确认密码</td> 
      <td><input id="password2" type="password"  name="password2" value=""/></td> 
    </tr> 
      <tr> 
      <td bgcolor="#F0FFFF">操作</td> 
      <td><input name="s" type="submit" id="s" value="提交"/></td> 
    </tr> 
  </table> 
  </form></td> 
    </tr> 
  </table> 
  </body> 
  </html>