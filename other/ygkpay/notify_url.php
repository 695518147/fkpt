<?php
/*
此文件仅供商户参考使用，实际应用可自行编写
编辑时间：2018-2-19
By Junjie
*/
define('SYSTEM_ROOT_E', dirname(__FILE__).'/');
include '../../ayangw/common.php';
include('lib.php');
//商户订单号
$out_trade_no = $_GET['out_trade_no'];

//支付宝交易号
$trade_no = $_GET['trade_no'];

//交易状态
$trade_status = $_GET['trade_status'];

//商品名称
$subject = $_GET['subject'];

//订单金额
$total_amount = $_GET['total_amount'];

/*
验证商户订单是否成功支付
但商户仍需进一步验证
*/
$result=check($out_trade_no,$trade_no,$subject,$total_amount);
$sign=getSign($out_trade_no,$trade_no,$total_amount,$trade_status);
if($result == true && $sign == $_GET['sign']){
	if($trade_status == "TRADE_SUCCESS"){
		/*
		以下为商户业务程序代码
		建议商户增添以下验证
		1、判断商户业务程序是否已经执行过。
		**************************************************************************************
		注意：我们的程序会向商户发送四次请求(10秒一次)，如商户未做判断，会导致商户程序执行四次
		**************************************************************************************
		2、验证商户订单号$out_trade_no和商户数据库订单号是否一致
		3、判断$total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）
		如以上判断已经完成，则执行商户业务程序（也可无需以上判断）
		*/
		$sql = "SELECT * FROM ayangw_order WHERE out_trade_no='{$out_trade_no}' limit 1";
		$res = $DB->query($sql);
		$srow = $DB->fetch($res);
        if($srow['sta']==0){
            if(!srow || $srow['money'] != $_GET['total_amount']){
                showalert('验证失败！',4,'订单回调验证失败！');
            }
            $number = $srow['number'];
            $ok = 0;
            for($i=1;$i<=$number;$i++){
                $sql2 = "UPDATE ayangw_km "
                        . "set endTime = now(),out_trade_no = '{$out_trade_no}',trade_no='{$trade_no}',rel ='{$srow['rel']}',stat = 1
                           where gid = {$srow['gid']} and stat = 0
                           limit  1";
                if($DB->query($sql2)){
                    $ok++; 
                }
            }
            $sql = "update ayangw_order set sta = 1, trade_no = '{$trade_no}' ,endTime = now() where out_trade_no = '{$out_trade_no}'";
                  
            $DB->query($sql);
            wsyslog("交易成功！[异步处理]","订单编号：".$out_trade_no.";数量：".$number.";成功提取数量：".$ok."");
            /*
            $sql2 = "UPDATE ayangw_km set endTime = now(),out_trade_no = '{$out_trade_no}',trade_no='{$trade_no}',rel ='{$srow['rel']}',stat = 1
            where gid = {$srow['gid']} and stat = 0
            limit  $number";
             if($DB->query($sql2) > 0){
                 $sql = "update ayangw_order set sta = 1, trade_no = '{$trade_no}' ,endTime = now() where out_trade_no = '{$out_trade_no}'";
                  
                 $DB->query($sql);
             }*/
          
        }
		echo "success";
	}
}else{
	echo "fail";
}
?>