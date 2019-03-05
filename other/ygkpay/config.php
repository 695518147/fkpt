<?php
/*
此文件用于存放商户信息
编辑时间：2018-4-11
By Junjie
*/
include '../../ayangw/common.php';
//商户key_id
$key_id=$conf['epay_id'];//请填写您入网后获得的key_id值

//商户key_token
$key_token=$conf['epay_key'];//请填写您入网后获得的key_token值

//支付网关
$apiUrl="https://pay.ygkpay.com/";//请勿修改此值。

//获取异步地址文件目录
$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
$url=$http_type .$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
$url_all=dirname($url);

//商户异步通知地址
$notify_url=$url_all . "/notify_url.php";

//商户同步通知地址
$return_url=$url_all . "/return_url.php";
?>