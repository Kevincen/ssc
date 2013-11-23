<?php

/*
 * @Description 易宝支付产品通用支付接口范例 
 * @V3.0
 * @Author rui.xin
 */
 	
include 'yeepayCommon.php';
require_once 'HttpClient.class.php';
 		
$p0_Cmd 	= "QueryOrdDetail";	            #接口类型
$p2_Order = $_POST['p2_Order'];						#商户订单号
#正式请求地址
#$QueryOrdURL_onLine	= "https://www.yeepay.com/app-merchant-proxy/command";			
#测试请求地址					
$QueryOrdURL_onLine	= "http://tech.yeepay.com:8080/robot/debug.action";									
    
#	进行签名处理，一定按照文档中标明的签名顺序进行
$sbOld ="";
#	加入订单查询请求，固定值"QueryOrdDetail"
$sbOld = $sbOld.$p0_Cmd;
#	加入商户编号
$sbOld = $sbOld.$p1_MerId;
#	加入商户订单号
$sbOld = $sbOld.$p2_Order;
                   
$hmac	 = null;
$hmac	 = HmacMd5($sbOld,$merchantKey);     
           
	logstr($p2_Order,$sbOld,HmacMd5($sbOld,$merchantKey));
           
#	进行签名处理，一定按照文档中标明的签名顺序进行
#	加入订单查询请求，固定值"QueryOrdDetail"
$params = array('p0_Cmd' => $p0_Cmd,
#	加入商户编号
'p1_MerId'	=>  $p1_MerId,
#	加入商户订单号
'p2_Order'	=>  $p2_Order,
#	加入校验码
'hmac' 			=>  $hmac);


$pageContents = HttpClient::quickPost($QueryOrdURL_onLine, $params);

$result = explode("\n",$pageContents);

## 声明查询结果
	$r0_Cmd					= "";			#	取得业务类型
	$r1_Code				= "";     #	查询结果状态码
	$r2_TrxId				= "";			#	易宝支付交易流水号
	$r3_Amt					= "";			#	支付金额
	$r4_Cur					= "";			#	交易币种
	$r5_Pid					= "";			#	商品名称
	$r6_Order				= "";			#	商户订单号
	$r8_MP					= "";			#	商户扩展信息
	$rb_PayStatus		= "";			#	支付状态
	$rc_RefundCount	= "";			#	已退款次数
	$rd_RefundAmt		= "";			#	已退款金额
	$hmac						= "";     #	查询返回数据的签名串
    		
	for($index=0;$index<count($result);$index++){//数组循环
		$result[$index] = trim($result[$index]);
		if (strlen($result[$index]) == 0) {
			continue;
		}
		$aryReturn = explode("=",$result[$index]);
		$sKey = $aryReturn[0];
		$sValue = $aryReturn[1];
		if($sKey=="r0_Cmd"){											#业务类型 
			$r0_Cmd = $sValue;
		}elseif($sKey=="r1_Code"){								#查询结果状态码  
			$r1_Code = $sValue;
		}elseif($sKey == "r2_TrxId"){			        #易宝支付交易流水号
			$r2_TrxId = $sValue;
		}elseif($sKey == "r3_Amt"){			          #支付金额
			$r3_Amt = $sValue;
		}elseif($sKey == "r4_Cur"){			          #交易币种
			$r4_Cur = $sValue;
		}elseif($sKey == "r5_Pid"){								#商品名称
			$r5_Pid = $sValue;
		}elseif($sKey == "r6_Order"){							#商户订单号
			$r6_Order = $sValue;
		}elseif($sKey == "r8_MP"){							  #商户扩展信息
			$r8_MP = $sValue;
		}elseif($sKey == "rb_PayStatus"){					#支付状态
			$rb_PayStatus = $sValue;
		}elseif($sKey == "rc_RefundCount"){				#已退款次数
			$rc_RefundCount = $sValue;
		}elseif($sKey == "rd_RefundAmt"){					#已退款金额
			$rd_RefundAmt = $sValue;
		}elseif($sKey == "hmac"){									#取得校验码
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
	#加入查询操作是否成功
	$sbOld = $sbOld.$r1_Code;
	#加入易宝支付交易流水号
	$sbOld = $sbOld.$r2_TrxId;
	#加入支付金额
	$sbOld = $sbOld.$r3_Amt;	
	#加入交易币种
	$sbOld = $sbOld.$r4_Cur;	
	#加入商品名称
	$sbOld = $sbOld.$r5_Pid;	
	#加入商户订单号
	$sbOld = $sbOld.$r6_Order;	
	#加入商户扩展信息
	$sbOld = $sbOld.$r8_MP;		              
	#加入支付状态
	$sbOld = $sbOld.$rb_PayStatus;		              
	#加入已退款次数
	$sbOld = $sbOld.$rc_RefundCount;		              
	#加入已退款金额
	$sbOld = $sbOld.$rd_RefundAmt;		              
            	
  echo "[".$sbOld."]";
  
  //echo $sNewString;  
  //echo $sNewString;
  
	$sNewString = HmacMd5($sbOld,$merchantKey);
	
	logstr($r6_Order,$sbOld,HmacMd5($sbOld,$merchantKey));
	//校验码正确
	if($sNewString==$hmac) {
	  if($r1_Code=="1"){
	      echo "<br>查询成功!";
	      echo "<br>订单号:".$r6_Order;
	      echo "<br>易宝支付交易流水号:".$r2_TrxId;
		    echo "<br>商品名称:".$r5_Pid;
	      echo "<br>支付金额:".$r3_Amt;
	      echo "<br>商户扩展信息:".$r8_MP;
	      echo "<br>订单状态:".$rb_PayStatus;
	      echo "<br>已退款次数:".$rc_RefundCount;
	      echo "<br>已退款金额:".$rd_RefundAmt;
	  } else if($r1_Code=="50"){
	      echo "<br>该订单不存在";
	      exit; 
	  } else{
	      echo "<br>查询失败";	
	      exit;       
	  }
	} else{
		echo "<br>localhost:".$sNewString;	
		echo "<br>YeePay:".$hmac;
		echo "<br>交易信息被篡改";
		exit; 
	}
 
     
?> 
<html>
<head>
<title>To YeePay Page</title>
</head>
<body>
</html>