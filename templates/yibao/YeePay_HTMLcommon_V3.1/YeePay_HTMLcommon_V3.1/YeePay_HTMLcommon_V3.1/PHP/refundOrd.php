<?php

/*
 * @Description 易宝支付产品通用接口范例 
 * @V3.0
 * @Author rui.xin
 */
 	
include 'yeepayCommon.php';
require_once 'HttpClient.class.php';

#退款接口正式请求地址
#$reqURL_RefOrd	= "https://www.yeepay.com/app-merchant-proxy/command";								
#退款接口测试请求地址
$reqURL_RefOrd	= "http://tech.yeepay.com:8080/robot/debug.action";
$p0_Cmd 	= "RefundOrd";	            #接口类型
$pb_TrxId = $_POST['pb_TrxId'];				#易宝支付交易流水号
$p3_Amt		= $_POST['p3_Amt'];					#退款金额
$p4_Cur		=	"CNY";										#交易币种,固定值"CNY".
$p5_Desc  = $_POST['p5_Desc'];			  #详细描述退款原因的信息.
    
#	进行签名处理，一定按照文档中标明的签名顺序进行
$sbOld ="";
#	加入订单查询请求，固定值"QueryOrdDetail"
$sbOld = $sbOld.$p0_Cmd;
#	加入商户编号
$sbOld = $sbOld.$p1_MerId;
#	加入易宝支付交易流水号
$sbOld = $sbOld.$pb_TrxId;
#	加入退款金额
$sbOld = $sbOld.$p3_Amt;
#	加入交易币种
$sbOld = $sbOld.$p4_Cur;
#	加入退款说明
$sbOld = $sbOld.$p5_Desc;
      
$hmac	 = null;
$hmac	 = HmacMd5($sbOld,$merchantKey);     
           
	logstr($pb_TrxId,$sbOld,HmacMd5($sbOld,$merchantKey));
           
#	进行签名处理，一定按照文档中标明的签名顺序进行
#	加入订单查询请求，固定值"QueryOrdDetail"
$params = array('p0_Cmd' => $p0_Cmd,
#	加入商户编号
'p1_MerId'	=>  $p1_MerId,
#	加入易宝支付交易流水号
'pb_TrxId'	=>  $pb_TrxId,
#	加入易宝支付交易流水号
'p3_Amt'		=>  $p3_Amt,
#	加入易宝支付交易流水号
'p4_Cur'		=>  $p4_Cur,
#	加入易宝支付交易流水号
'p5_Desc'		=>  $p5_Desc,
#	加入校验码
'hmac' 			=>  $hmac);

$pageContents = HttpClient::quickPost($reqURL_RefOrd, $params);
$result = explode("\n",$pageContents);

## 声明查询结果
	$r0_Cmd					= "";			#	业务类型
	$r1_Code				= "";     #	退款申请结果
	$r2_TrxId				= "";			#	易宝支付交易流水号
	$r3_Amt					= "";			#	退款金额
	$r4_Cur					= "";			#	交易币种
	$hmac						= "";     #	签名数据
  #echo "result.count:".count($result);
	for($index = 0;$index < count($result);$index++){//数组循环
		$result[$index] = trim($result[$index]);
		if (strlen($result[$index]) == 0) {
			continue;
		}
		$aryReturn = explode("=",$result[$index]);
		$sKey = $aryReturn[0];
		$sValue = $aryReturn[1];
		if($sKey=="r0_Cmd"){											#业务类型 
			$r0_Cmd = $sValue;
		}elseif($sKey=="r1_Code"){								#退款申请结果  
			$r1_Code = $sValue;
		}elseif($sKey == "r2_TrxId"){			        #易宝支付交易流水号
			$r2_TrxId = $sValue;
		}elseif($sKey == "r3_Amt"){			          #退款金额
			$r3_Amt = $sValue;
		}elseif($sKey == "r4_Cur"){			          #交易币种
			$r4_Cur = $sValue;
		}elseif($sKey == "hmac"){									#取得签名数据
			$hmac = $sValue;	      
		}else{
			echo $result[$index];
			return;
		}
	}
		

	#进行校验码检查 取得加密前的字符串
	$sbOld="";
	#加入业务类型
	$sbOld = $sbOld.$r0_Cmd;
	#加入退款申请是否成功
	$sbOld = $sbOld.$r1_Code;
	#加入易宝支付交易流水号
	$sbOld = $sbOld.$r2_TrxId;
	#加入退款金额
	$sbOld = $sbOld.$r3_Amt;	
	#加入交易币种
	$sbOld = $sbOld.$r4_Cur;	
            	 
	$sNewString = HmacMd5($sbOld,$merchantKey);
	
	logstr($r2_TrxId,$sbOld,HmacMd5($sbOld,$merchantKey));
	//校验码正确
	if($sNewString==$hmac) {
	  if($r1_Code=="1"){
	      echo "<br>订单退款请求成功!";
	      echo "<br>易宝支付交易流水号:".$r2_TrxId;
	      echo "<br>退款金额:".$r3_Amt;
	  } else{
	      echo "<br>订单退款请求失败";	
	      exit;       
	  }
	} else{
		echo "<br>localhost::".$sNewString;	
		echo "<br>YeePay:".$hmac;
		echo "<br>交易签名无效.";
		exit; 
	}
?> 