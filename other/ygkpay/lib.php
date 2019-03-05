<?php
/*
此文件用于存放函数，如不懂编写，请勿修改
编辑时间：2018-2-19
By Junjie
*/

/*
验证数据是否正常
notify_url.php
*/
function check($out_trade_no,$trade_no,$subject,$total_amount){
	include('config.php');
	$api_name="api/api.php";
	$action="?action=query";
	$key_id="&key_id=$key_id";
	$sha256_key_token=hash("sha256",$key_token);
	$key_token="&key_token=$sha256_key_token";
	$out_trade_no="&out_trade_no=$out_trade_no";
	$all_url=$apiUrl . $api_name . $action . $key_id . $key_token . $out_trade_no;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $all_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT , 30);
	$output = curl_exec($ch);
	curl_close($ch);
	$json=json_decode($output,false);
	if($json->if_success == 1){
		if($json->trade_no == $trade_no){
			if($json->goods_name == $subject){
				if($json->money == $total_amount){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}else{
		return false;
	}
}
/*
验证数据是否正常
return_url.php
*/
function check_return($out_trade_no,$trade_no,$total_amount){
	include('config.php');
	$api_name="api/api.php";
	$action="?action=query";
	$key_id="&key_id=$key_id";
	$sha256_key_token=hash("sha256",$key_token);
	$key_token="&key_token=$sha256_key_token";
	$out_trade_no="&out_trade_no=$out_trade_no";
	$all_url=$apiUrl . $api_name . $action . $key_id . $key_token . $out_trade_no;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $all_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT , 30);
	$output = curl_exec($ch);
	curl_close($ch);
	$json=json_decode($output,false);
	if($json->if_success == 1){
		if($json->trade_no == $trade_no){
			if($json->money == $total_amount){
					return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}else{
		return false;
	}
}
/*
拼接支付请求链接
*/
function setPayUrl($out_trade_no,$goods_name,$money,$type){
	include('config.php');
	$api_name="pay.php";
	$action="?action=pay";
	$key_id="&key_id=$key_id";
	$out_trade_no="&out_trade_no=$out_trade_no";
	$goods_name="&goods_name=$goods_name";
	$money="&money=$money";
	$pp_notify_url="&notify_url=$notify_url";
	$pp_return_url="&return_url=$return_url";
	$type="&type=$type";
	//拼接链接
	$all_url=$apiUrl . $api_name . $action . $key_id . $out_trade_no . $goods_name . $money . $pp_notify_url . $pp_return_url . $type;
	return $all_url;
}
/*
签名验证sign
*/
function getSign($out_trade_no,$trade_no,$money,$trade_status){
	include('config.php');
	$security  = array();
	$security['out_trade_no']      = $out_trade_no;
	$security['trade_no']    = $trade_no;
	$security['money']        = $money;
	$security['trade_status']       = $trade_status;
	foreach ($security as $k=>$v)
	{
		$o.= "$k=".urlencode($v)."&";
	}
	$sign = md5(substr($o,0,-1).$key_token);
	//$key是你的商户密钥
	return $sign;
}
?>