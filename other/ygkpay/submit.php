<?php
/*
此文件用于发起支付
编辑时间：2018-2-19
By Junjie
*/
include('lib.php');
if(isset($_GET['out_trade_no'])){
	$payurl=setPayUrl($_GET['out_trade_no'],$_GET['goods_name'],$_GET['money'],$_GET['type']);
	echo "<script>window.location.href='$payurl';</script>";
}
?>
<title>正在转跳充值中心</title>