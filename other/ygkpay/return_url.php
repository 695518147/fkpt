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

//订单金额
$total_amount = $_GET['total_amount'];

/*
验证商户订单是否成功支付
建议商户进一步验证
*/
$result=check_return($out_trade_no,$trade_no,$total_amount);
$sign=getSign($out_trade_no,$trade_no,$total_amount,$trade_status);
echo $result."\n=============";
echo $sign."\n----------";
echo $_GET['sign']."\n++++++++";
foreach ($_GET as $key => $val) {
    echo $key."llllllll";
    echo $val."pppppppp";
}
if($result == true && $sign == $_GET['sign']){
		/*
		以下为商户业务程序代码
		*/
		
		if($trade_status == "TRADE_SUCCESS"){
			$sql = "SELECT * FROM ayangw_order WHERE out_trade_no='{$out_trade_no}' limit 1";
			$res = $DB->query($sql);
			$srow = $DB->fetch($res);
			if($srow['sta']==0){
				if(!srow || $srow['money'] != $_GET['total_amount']){
				   showalert('验证失败！',4,'订单回调验证失败！');
				}
				$number = $srow['number'];
			   /*
				$sql2 = "UPDATE ayangw_km set endTime = now(),out_trade_no = '{$out_trade_no}',trade_no='{$trade_no}',rel ='{$srow['rel']}',stat = 1
				where gid = {$srow['gid']} and stat = 0
				limit  $number";
				 if($DB->query($sql2) > 0){
					 $sql = "update ayangw_order set sta = 1, trade_no = '{$trade_no}' ,endTime = now() where out_trade_no = '{$out_trade_no}'";
						
					 $DB->query($sql);
				 }*/
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
							  wsyslog("交易成功！[回调处理]","订单编号：".$out_trade_no.";数量：".$number.";成功提取数量：".$ok."");
				//showalert('您所购买的商品已付款成功，感谢购买！',1,$out_trade_no);
				echo "<script>alert('购买成功！请到发卡功能->卡密查询里面获取卡密');window.location.href='../../index.php';</script>";
			}else{
				//showalert('您所购买的商品已付款成功，感谢购买！',1,$out_trade_no);
				echo "<script>alert('购买成功！请到发卡功能->卡密查询里面获取卡密');window.location.href='../../index.php';</script>";
				
			}
		}else{
			echo "fail-2";
		}
}else{
	echo "fail";
}
