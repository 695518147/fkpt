<?php

//监控订单
require './common.php';
$count=1; 
$interval=50; 

$today=date("Y-m-d ").'00:00:00';
$nowdate = date("Y-m-d H:i:s");
if (function_exists("set_time_limit"))
{
	@set_time_limit(0);
}
if (function_exists("ignore_user_abort"))
{
	@ignore_user_abort(true);
}
//
$rs=$DB->query("SELECT * FROM ayangw_order WHERE sta = 1 and sendE = 0 and LENGTH(rel)>=5 order by id desc  limit $count");
while($row = $DB->fetch($rs))
{
    
    //$rr = $DB->get_row("select * from ayangw_km where trade_no = '".$row['trade_no']."' limit 1");

    $km = "";
    $res2 = $DB->query("select * from ayangw_km where trade_no = '".$row['trade_no']."' ");
    while ($rr = $DB->fetch($res2)){
        if($km != ""){
            $km .= ",";
        }
        $km .= $rr['km'];
    }
    $rw = $DB->get_row("select * from ayangw_goods where id = '".$row['gid']."' limit 1");
   
    $bh = $row['out_trade_no'];//订单编号
    $mc = $rw['gName'];//名称
    $time = $row['endTime'];//时间
    $goal =  $row['rel']."@qq.com";//目标邮箱
    $content = "<br>　　您购买的商品：".$mc."<br>　　订单编号：".$bh."<br>　　购买时间为：".$time."<br>　　您的卡密为：".$km;
    sendemail($goal,getMd_df(get_qqnick($row['rel']),$content,$conf['title'],""));
	$DB->query("update ayangw_order set sendE = 1 where id='{$row['id']}'");
	@usleep($interval*1000);
}
echo 'OK!订单监控：'.$nowdate;