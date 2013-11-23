<?php
define('Copyright', '作者QQ：，唯一聯繫電話：');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$db = new DB();
include_once (dirname(__FILE__)."/config.php");
 
	$hao_customerid=$MerId;//  '获取星点支付返回商户ID
	$hao_state=$_REQUEST["state"] ;//    '获取星点支付返回支付状态  1为成功,2为失败
	$hao_sdpayno=$_REQUEST["sdpayno"];//   '获取星点支付返回星点支付平台订单号
	$hao_sdcustomno=$_REQUEST["sdcustomno"];//  '获取星点支付返回商户流水号
	$hao_ordermoney=$_REQUEST["ordermoney"];//  '获取星点支付返回订单金额
	$hao_cardno=$_REQUEST["cardno"];//    '获取星点支付返回支付方式
	$hao_mark=$_REQUEST["mark"]  ;//     '获取星点支付返回商户自定义信息
	$hao_reMarks=$_REQUEST["reMarks"] ;// '获取星点支付返回商户备注
	$hao_des=$_REQUEST["des"];//    '返回充值备注
	$hao_sign =$_REQUEST["sign"] ; 
	
	$sign_str = "customerid=$hao_customerid&sdpayno=$hao_sdpayno&sdcustomno=$hao_sdcustomno&key=$merchantKey";
	$mySign = strtoupper(md5($sign_str)); 
	
	//判断返回参数是否正确
	//请在下面做您的业务
	//如使用应答机制请正确回写ok）
	if( $hao_state == "1" && $mySign==$hao_sign){ 
		echo "ok";
		$res=$db->query("select p.status,p.g_name,u.g_money_yes from g_payrecord p left join g_user u on p.g_name=u.g_name where p.ordernum='{$hao_sdcustomno}'",0);
		 
		if($res[0]['status']=="3"){
			$db->query("UPDATE g_payrecord set status=1 where ordernum='{$hao_sdcustomno}'",0);
			$db->query("UPDATE g_user SET g_money_yes=g_money_yes+$hao_ordermoney where g_name='".$res[0]['g_name']."'",0);
		}
		
		$valueList = array();
		$valueList['g_name'] = $res[0]['g_name'];
		$valueList['g_f_name'] = $_SESSION['sName'];
		$valueList['g_initial_value'] = $res[0]['g_money_yes'];
		$valueList['g_up_value'] = $res[0]['g_money_yes']+$hao_ordermoney;
		$valueList['g_up_type'] = '充值';
		$valueList['g_s_id'] = 1;
		insertLogValue($valueList);
		
		echo "<BR>支付成功!";
		echo "<BR>商户订单号: $hao_sdcustomno"; 
		echo "<BR>支付金额: $hao_ordermoney"; 
	}else{
		echo "<BR>支付失败!";
		echo "<BR>商户订单号: $hao_sdcustomno";
		echo "<BR>p8_cardStatus=$hao_des";
	}
?>
