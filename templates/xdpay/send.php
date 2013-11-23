<?php
	error_reporting(E_ALL^E_WARNING^E_NOTICE);
	include("config.php");
	$hao_customerid=$MerId;// '商户ID
	$hao_orderNumber=$_REQUEST["orderNumber"];// '商户流水号
	$hao_ordermoney=$_REQUEST["ordermoney"];//  '订单总金额
	$hao_key=$merchantKey;//  '商户密钥
	$hao_cardNo=$_REQUEST["cardNo"];//  '通道代码
	$hao_faceNo=$_REQUEST["faceNo"];// '卡面值编号
	$hao_cardNum=$_REQUEST["cardnum"];// '充值卡号
	$hao_cardPass=$_REQUEST["cardpass"];// '充值卡密码
	$hao_Mark=$_REQUEST["Mark"];// '商户自定义
	$hao_reMarks=$_REQUEST["reMarks"];// '商户备注
	$hao_getawayurl="http://www.xdpay.com/service/GateWay.aspx";//  '请求地址，即请求星点支付的地址，本地址是服务器间点对点提交方式地址  
	$str_sign="customerid=$hao_customerid&orderNumber=$hao_orderNumber&key=$hao_key";   //拼凑加密串 
	$hao_sign=strtoupper(md5($str_sign)) ;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body onLoad="get_FORM.submit()">
<form action="<?php echo $hao_getawayurl?>" method="post" name="get_FORM" > 
  <!--以下几项为网上支付重要信息，信息必须正确无误，信息会影响支付进行！-->   
  <input type="hidden"  name="customerid"        value="<?php echo $hao_customerid?>"><!--商户ID-->
  <input type="hidden"  name="orderNumber"        value="<?php echo $hao_orderNumber?>"><!--商户流水号-->
  <input type="hidden"  name="ordermoney"        value="<?php echo $hao_ordermoney?>"><!--订单金额-->
  <input type="hidden"  name="cardNo"        value="<?php echo $hao_cardNo?>"><!--通道代码-->
  <input type="hidden"  name="sign"        value="<?php echo $hao_sign?>"><!--MD5签名-->
  <input type="hidden"  name="faceNo"        value="<?php echo $hao_faceNo?>"><!--卡面值编号-->
  <input type="hidden"  name="cardNum"        value="<?php echo $hao_cardNum?>"><!--充值卡号-->
  <input type="hidden"  name="cardPass"        value="<?php echo $hao_cardPass?>"><!--充值卡密码-->
  <input type="hidden"  name="Mark"        value="<?php echo $hao_Mark?>"><!--商户自定义-->
  <input type="hidden"  name="reMarks"        value="<?php echo $hao_reMarks?>"><!--商户备注--> 
</form>
</body>
</html>