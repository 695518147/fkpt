<?php
if(!defined('IN_CRONLITE'))exit();

$my=isset($_GET['my'])?$_GET['my']:null;

$clientip=real_ip();

foreach ($_COOKIE as $key => $val){
    wsyslog("cookie的值".$key , $val);
}

if(isset($_COOKIE["admin_token"]))
{
	$token=authcode(daddslashes($_COOKIE['admin_token']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$session=md5($conf['admin'].$conf['pwd'].$password_hash);
//	此处代码有疑问。。。。。   无法解密。
    $islogin=1;
	if($session==$sid) {
		$islogin=1;
	}
}

