<?php session_start();
include_once 'include/config.php';
include_once 'database/mysql.config.php';
include_once 'common/logintu.php';
$uid = $_SESSION['uid'];
logintu($uid);
$_SESSION = array();
if (isset($_COOKIE[session_name()]))
{
	setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();?><script>window.open('/','_top')</script>