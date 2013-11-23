<?php
define('Copyright', '作者QQ：，唯一聯繫電話：');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$db = new DB();
$db = new DB();
include_once (dirname(__FILE__)."/yeepayCommon.php");
/*
 * @Description 易宝支付B2C在线支付接口范例 
 * @V3.0
 * @Author rui.xin
 */ 
	
#	只有支付成功时易宝支付才会通知商户.
##支付成功回调有两次，都会通知到在线支付请求参数中的p8_Url上：浏览器重定向;服务器点对点通讯.

#	解析返回参数.
$return = getCallBackValue($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);

#	判断返回签名是否正确（True/False）
$bRet = CheckHmac($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
#	以上代码和变量不需要修改.
	 	
#	校验码正确.
if($bRet){
	if($r1_Code=="1"){
		
	#	需要比较返回的金额与商家数据库中订单的金额是否相等，只有相等的情况下才认为是交易成功.
	#	并且需要对返回的处理进行事务控制，进行记录的排它性处理，在接收到支付结果通知后，判断是否进行过业务逻辑处理，不要重复进行业务逻辑处理，防止对同一条交易重复发货的情况发生.  
		if($r9_BType=="2"){ 
			echo "success"; 
		}
		$hao_sdcustomno=$r6_Order; 
		$hao_ordermoney = $r3_Amt;
		$res=$db->query("select p.status,p.g_name,u.g_money_yes from g_payrecord p left join g_user u on p.g_name=u.g_name where p.ordernum='{$hao_sdcustomno}'",1); 
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
	}
	
}else{
	echo "交易信息被篡改";
}
   
?> 