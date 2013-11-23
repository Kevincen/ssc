<?php

/*
 * @Description 易宝支付产品通用接口范例 
 * @V3.0
 * @Author rui.xin
 */

#	商户编号p1_MerId,以及密钥merchantKey 需要从易宝支付平台获得
$p1_MerId			= "10012058179";																										#测试使用
$merchantKey	= "YVM0U6f72F4Gr9yG8G64377454C740069H3FixDTzg7nQ7d3GkggTy818ZT6";		#测试使用
$returnurl = "http://".$_SERVER['SERVER_NAME']."/templates/yibao/callback.php";
$logName	= "YeePay_HTML.log";

?> 