<?php
define('Copyright', '作者QQ：，唯一聯繫電話：');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';
$db = new DB();
$result=$db->query("select g_ck_limitcash from g_config limit 0,1",0);
$g_ck_limitcash=$result[0][0];
$bank = $db->query("select * from g_paycard",1);
function get_splitpage($table,$where=false,$par="",$method='GET'){
	global $mysql,$pagenum,$pagesize,$db;
	$_pagenum=1;
	$_pagesize=15;
	if(!empty($pagenum) && $pagenum>0){
		$_pagenum=$pagenum;
	}
	if(!empty($pagesize) && $pagesize>0){
		$_pagesize=$pagesize;
	}
	
	if(is_string($where)){
		$_recordtotal=$db->query("select * from {$table} where {$where}",3);
	}else{
		$_recordtotal=$db->query("select * from $table where $where",3);
	}
	
	$_pagetotal=(int)($_recordtotal/$_pagesize);
	if($_recordtotal%$_pagesize >0){
		$_pagetotal++;
	}
	if($_pagenum<=1)$_pagenum=1;
	if($_pagenum>$_pagetotal)$_pagenum=$_pagetotal;
	if($_pagenum>1){
		$_prepage=$_pagenum-1;
	}else{
		$_prepage=1;
	}
	if($_pagenum<$_pagetotal){
		$_nextpage=$_pagenum+1;
	}else{
		$_nextpage=$_pagetotal;
	}
	if($_recordtotal>$_pagesize){
		if($method=="GET"){
			$str="<div class='splitpage'>";	
			$str.="<a href='?pagenum={$_prepage}&pagesize={$pagesize}&{$par}'>".("上一页")."</a>&nbsp;";
			$str.="<a href='?pagenum={$_nextpage}&pagesize={$pagesize}&{$par}'>".("下一页")."</a>&nbsp;";
			$str.="Total Of {$_recordtotal}; {$_pagenum}/{$_pagetotal},GoTo<input type=text size=3 id=pagenum >&nbsp;<input type=button value=GO onclick=\"location.href='?pagesize={$_pagesize}&pagenum='+document.getElementById('pagenum').value+'&$par'\" />";
			return $str;	
		}else{
			$str="<div class='splitpage'>";	
			$str.="<a href='javascript:zh(\"pagenum={$_prepage}&pagesize={$pagesize}&{$par}\")'>".("上一页")."</a>&nbsp;";
			$str.="<a href='javascript:zh(\"pagenum={$_nextpage}&pagesize={$pagesize}&{$par}\")'>".("下一页")."</a>&nbsp;";
			$str.="Total Of {$_recordtotal}; {$_pagenum}/{$_pagetotal},GoTo<input type=text size=3 id=pagenum >&nbsp;<input type=button value=GO onclick=\"javascript:zh('pagesize={$_pagesize}&pagenum='+document.getElementById('pagenum').value+'&$par')\" />";
			return $str;	
		}
	}
}

if($_REQUEST['act']=='paybank'){
	if( $_REQUEST['Money']*1<1 ){
		echo '<script>alert("請輸充值金額");</script>';
	}else if($_REQUEST['BankName']==""){
		echo '<script>alert("請选择付款银行");</script>';
	}else if($_REQUEST['Money']<$g_ck_limitcash){
		echo '<script>alert("单次支付至少'.$g_ck_limitcash.'元");</script>';
	}else{
		$ordernum = date("YmdHis");
		$sql="INSERT INTO g_payrecord SET PayWay=0, g_name='".$user[0]['g_name']."',Money='".$_REQUEST['Money']."',BankName='".$_REQUEST['BankName']."',ordernum='".$ordernum."',optdt='".date("Y-m-d H:i:s")."',status='3',IsBank='1' ";
		$db->query($sql,0);
		
		
				
		header("Location:yibao/send.php?ordermoney=".$_REQUEST['Money']."&cardNo=".$_REQUEST['cardNo']."&orderNumber=".$ordernum);
	}
	exit;
}

if($_REQUEST['act']=='paycard'){
	if( $_REQUEST['cardtype']=="" ){
		echo '<script>alert("请选择卡类");</script>';
	}else if($_REQUEST['faceno']==""){
		echo '<script>alert("請选择面值");</script>';
	}else if($_REQUEST['cardnum']=="" || $_REQUEST['cardpass']==""){
		echo '<script>alert("请输入充值卡卡号和卡密");</script>';
	}else{
		$ordernum = date("YmdHis");
		$faceno = $_REQUEST['faceno']*1;
		if($faceno<1){
			echo '<script>alert("面值错误");</script>';exit;
		}
		$f="";
		if(strlen($faceno)==1){
			$f=$_REQUEST['cardtype']."00".$faceno;
		}else if(strlen($faceno)==2){
			$f=$_REQUEST['cardtype']."0".$faceno;
		}else{
			$f=$_REQUEST['cardtype'].$faceno;
		}
		$sql="INSERT INTO g_payrecord SET PayWay=0, g_name='".$user[0]['g_name']."',Money='".$_REQUEST['faceno']."',BankName='".$_REQUEST['cardname']."',ordernum='".$ordernum."',optdt='".date("Y-m-d H:i:s")."',status='3',IsBank='0',cardnum='".$_REQUEST['cardnum']."',cardpass='".$_REQUEST['cardpass']."' ";
		$db->query($sql,0); 
		header("Location:xdpay/send.php?ordermoney=".$_REQUEST['faceno']."&cardNo=".$_REQUEST['cardtype']."&faceNo={$f}&orderNumber=".$ordernum."&cardnum=".$_REQUEST['cardnum']."&cardpass=".$_REQUEST['cardpass']);
	}
	exit;
}

if($_REQUEST['act']=='loadpay'){
	$pagesize=18;
	if($pagenum=="")$pagenum=1; 
	$sql="select  * from g_payrecord  where g_name='".$user[0]['g_name']."'  And payWay=0  order by id desc limit ".(($pagenum-1)*$pagesize).",".$pagesize;  
	$list=$db->query($sql,1); 
	$splitpage=get_splitpage("g_payrecord","g_name='".$user[0]['g_name']."' And payWay=0 ","act=loadpay","");
	include("paywayEX_s.php");
	exit;
}
 
if($_REQUEST['act']=='tixian'){
	$YE = $user[0]['g_money_yes'];
	$Money = $_REQUEST['Money'];
	$v_Name =$_REQUEST['v_Name'];
	$BankName = $_REQUEST['BankName'];
	$BankNumber=$_REQUEST['BankNumber'];
	 
	if( $Money*1<1 ){
		echo '<script>alert("請輸入提现金額");</script>';
	}else if($_REQUEST['BankName']==""){
		echo '<script>alert("請輸入銀行名稱");</script>';
	}else if($_REQUEST['BankNumber']==""){
		echo '<script>alert("請輸入銀行帳號");</script>';
	}else if($_REQUEST['v_Name']==""){
		echo '<script>alert("請輸入姓名");</script>';
	}else if($Money>$YE){
		echo '<script>alert("提现金额超过可用额度");</script>';
	}else if($Money<$g_ck_limitcash){
		echo '<script>alert("提现金额不得低于'.$g_ck_limitcash.'");</script>';
	}else{
		$sql="INSERT INTO g_tixian SET g_name='".$user[0]['g_name']."',Money='".$_REQUEST['Money']."',BankName='".$_REQUEST['BankName']."',BankNumber='".$_REQUEST['BankNumber']."',ordernum='".date("YmdHis")."',optdt='".date("Y-m-d H:i:s")."',status=3,v_Name='".$_REQUEST['v_Name']."'"; 
		$db->query($sql,0);
		$db->query("UPDATE g_user set g_money_yes=g_money_yes-$Money where g_name='".$user[0]['g_name']."'",0);
		
		$valueList = array();
		$valueList['g_name'] = $user[0]['g_name'];
		$valueList['g_f_name'] = $_SESSION['sName'];
		$valueList['g_initial_value'] = $user[0]['g_money_yes'];
		$valueList['g_up_value'] = $user[0]['g_money_yes']-$Money;
		$valueList['g_up_type'] = '提现';
		$valueList['g_s_id'] = 1;
		insertLogValue($valueList);
		
		echo '<script>alert("提现申请成功，請進入提现信息回查查看狀態");parent.showDiv(7,"a7")</script>';
	}
	exit;
}
if($_REQUEST['act']=='loadxian'){
	$pagesize=18;
	if($pagenum=="")$pagenum=1; 
	$sql="select  * from g_tixian  where g_name='".$user[0]['g_name']."'  order by id desc limit ".(($pagenum-1)*$pagesize).",".$pagesize;  
	$list=$db->query($sql,1); 
	$splitpage=get_splitpage("g_tixian","g_name='".$user[0]['g_name']."'  ","act=loadxian","");
	include("payway_x.php"); 
	exit;
}

 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>在线冲值</title>
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script> 
<script language="javascript" src="../js/date/lhgcore.min.js"   ></script>
<script language="javascript" src="../js/date/lhgcalendar.min.js"   ></script>
<style type="text/css">
.list-box{width:750px; border:#e9ba84 solid 1px; border-top:0px; background:#FFFF99}
body{ background-image:none}
</style>
<script language="javascript">
function showDiv(index,id){
	$('.list-box').hide();
	$('#con'+index).show();
	$('#t1').find('a').attr('class','');
	$('#'+id).attr('class','hover');
	if(index==3){
		$('#loadpayinfo').attr('src',$('#loadpayinfo').attr('src')+'&');
	}
	if(index==5){
		$('#loadzhuaninfo').attr('src',$('#loadzhuaninfo').attr('src')+'&');
	}
	if(index==7){
		$('#loadxianinfo').attr('src',$('#loadxianinfo').attr('src')+'&');
	}
}
function  showBZ(){
	var index=8;
	$('.list-box').hide();
	$('#con'+index).show();
	$('#t1').find('a').attr('class','');
	$('#a1').attr('class','hover');
}
function clearNoNum(obj){
	//先把非数字的都替换掉，除了数字和.
	obj.value = obj.value.replace(/[^\d.]/g,"");
	//必须保证第一个为数字而不是.
	obj.value = obj.value.replace(/^\./g,"");
	//保证只有出现一个.而没有多个.
	obj.value = obj.value.replace(/\.{2,}/g,".");
	//保证.只出现一次，而不能出现两次以上
	obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
	if(obj.value != ''){
	var re=/^\d+\.{0,1}\d{0,2}$/;
		if(!re.test(obj.value))   
		{   
		  obj.value = obj.value.substring(0,obj.value.length-1);
		  return false;
		} 
	}
}
function doTab(){
	var p="<?=$_REQUEST['p']?>";
	if(p!=""){
		showDiv(p,'a'+p);
	}else{
		showDiv(1,'a1');
	}
}

</script>
</head>
<body onload="doTab()">
<table border="0" cellpadding="0" cellspacing="0"      id="payBox" style="border:#e9ba84 solid 1px;background-color:#e9ba84; border-bottom:0px;width:750px;"> 
	 <tr class="t_list_caption">
		<td class="sclass-title-left"></td>
		<td class="sclass-title-center" id="t1"> 
			<!--<a href="#this" onclick="showDiv(3,'a3')" id="a3"><span>卡类充值</span></a> -->
			<a href="#this" onclick="showDiv(4,'a4')" id="a4"><span>网银充值</span></a> 
			<a href="#this" onclick="showDiv(5,'a5')" id="a5"><span>充值信息回查</span></a> 
			<a href="#this" onclick="showDiv(6,'a6')" id="a6"><span>申请提现</span></a> 
			<a href="#this" onclick="showDiv(7,'a7')" id="a7"><span>提现信息回查</span></a> 
		</td>
		<td class="sclass-title-right">&nbsp;</td>
	</tr>
</table> 
<iframe name="getdata"   style="display:none"></iframe>  
<table cellpadding="5"  cellspacing="0"  class="list-box" id="con3" style="display:none">
<tr>
<td >	

					<table  width="100%"  align="center" cellpadding="0" cellspacing="0" bgcolor="#e0efdc">
                        <tr>
                            <td width="100%" colspan="3" align="left" bgcolor="#AABFAE" class="memberbottomline">
                                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#EAF4E8">
									<form name="paycform" method="post" target="_target"> 
									<input type="hidden" name="act" value="paycard" />
									<input type="hidden" name="cardname" value="" />
                                    <tbody> 
                                        <tr>
                                            <td width="26%" align="right" bgcolor="#FFFFFF">
                                                用户帐号:</td>
                                            <td width="74%" align="left" bgcolor="#FFFFFF" class="font-redmini">
                                                <?php echo $user[0]['g_name']?>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 选择卡类:</td>
                                            <td align="left" bgcolor="#FFFFFF">
                                                <select name="cardtype">
													<!--<option value="">请选择充值卡</option>
													<option value="sdk">盛大卡</option>
													<option value="szx">神州行</option>
													<option value="ztk">征途卡 </option>
													<option value="qbk">Q币卡  </option>
													<option value="ltk">联通卡 </option>
													<option value="jyk">久游卡 </option>
													<option value="wyk">网易卡  </option>
													<option value="wmk">完美卡 </option>
													<option value="dxk">电信卡 </option>
													<option value="shk">搜狐卡  </option>
													<option value="zyk">纵游卡 </option>
													<option value="gyk">光宇卡 </option>
													<option value="jwk">骏网卡 </option> -->
													
													<option value="ICBC-NET-B2C">工商银行</option> 
													<option value="CMBCHINA-NET-B2C">招商银行</option>
													<option value="ABC-NET-B2C">中国农业银行</option> 
													<option value="CCB-NET-B2C">建设银行</option>
													<option value="BCCB-NET-B2C">北京银行</option> 
													<option value="BOCO-NET-B2C">交通银行</option>
													<option value="CIB-NET-B2C">兴业银行</option> 
													<option value="NJCB-NET-B2C">南京银行</option>
													<option value="CMBC-NET-B2C">中国民生银行</option> 
													<option value="CEB-NET-B2C">光大银行</option>
													<option value="BOC-NET-B2C">中国银行</option> 
													<option value="PINGANBANK-NET">平安银行</option> 
													<option value="CBHB-NET-B2C">渤海银行</option> 
													<option value="HKBEA-NET-B2C">东亚银行</option>
													<option value="NBCB-NET-B2C">宁波银行</option> 
													<option value="ECITIC-NET-B2C">中信银行</option>
													<option value="SDB-NET-B2C">深圳发展银行</option> 
													<option value="GDB-NET-B2C">广发银行</option>
													<option value="SHB-NET-B2C">上海银行</option> 
													<option value="SPDB-NET-B2C">上海浦东发展银行</option>
													<option value="POST-NET-B2C">中国邮政</option>
												</select>
                                            </td>
                                        </tr>  
										
										 <tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 面值:</td>
                                            <td align="left" bgcolor="#FFFFFF">
                                                <select name="faceno">
													<option value="">请先选择充值卡</option>
												</select></td>
                                        </tr>
										
										<tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 卡号:</td>
                                            <td align="left" bgcolor="#FFFFFF">
                                                <input type="text" name="cardnum"  value=""/></td>
                                        </tr>
										
										<tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 卡密:</td>
                                            <td align="left" bgcolor="#FFFFFF">
                                                <input type="text" name="cardpass"  value=""/></td>
                                        </tr>
										
                                        
                                        <tr>
                                            <td height="35" align="right" bgcolor="#FFFFFF">&nbsp;
                                          </td>
                                            <td height="40" align="left" valign="middle" bgcolor="#FFFFFF">
                                                <input id="SubTran" name="SubTran" type="submit"   class="button"
                                                    value="立即充值" />
                                            </td>
                                        </tr>
                                    </tbody>
									</form>
									 
                              </table>
                            </td>
                        </tr>
                         
                    </table>
</td>
</tr>    
</table> 



<table cellpadding="5"  cellspacing="0"  class="list-box" id="con4" style="display:none">
<tr>
<td >	

					<table  width="100%"  align="center" cellpadding="0" cellspacing="0" bgcolor="#e0efdc">
                        <tr>
                            <td width="100%" colspan="3" align="left" bgcolor="#AABFAE" class="memberbottomline">
                                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#EAF4E8">
									<form name="payform" method="post" target="_target"> 
									<input type="hidden" name="act" value="paybank" />
									<input type="hidden" name="BankName" value="" />
                                    <tbody> 
                                        <tr>
                                            <td width="26%" align="right" bgcolor="#FFFFFF">
                                                用户帐号:</td>
                                            <td width="74%" align="left" bgcolor="#FFFFFF" class="font-redmini">
                                                <?php echo $user[0]['g_name']?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 支付金额:</td>
                                            <td align="left" bgcolor="#FFFFFF">
                                                <input id="Money" name="Money" type="text" size="15" style="border: 1px solid #CCCCCC;
                                                    height: 18px; line-height: 20px;" onkeyup="clearNoNum(this);" />金额不可以小于<?=$g_ck_limitcash?></td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 汇款银行:</td>
                                            <td align="left" bgcolor="#FFFFFF">
                                                 <select name="cardNo" >
												 	<option value="ICBC">工商银行</option>
													<option value="ABC">农业银行</option>
													<option value="CMBCHINA">招商银行</option>
													<option value="CCB">建设银行</option>
													<option value="BOCO">交通银行</option>
													<option value="post">中国邮政</option>
													<option value="CMBC">民生银行</option>
													<option value="SDB">深圳发展银行</option>
													<option value="BOC">中国银行</option>
													<option value="ECITIC">中信银行</option>
													<option value="CIB">兴业银行</option>
													<option value="SPDB">浦发银行</option>
													<option value="CEB">光大银行</option>
													<option value="CBHB">渤海银行</option>
													<option value="GDB">广东发展银行</option>
													<option value="HXB">华夏银行</option>
													<option value="NJCB">南京银行</option> 
												 </select>
                                            </td>
                                        </tr>  
                                         
                                        <tr>
                                            <td height="35" align="right" bgcolor="#FFFFFF">&nbsp;
                                          </td>
                                            <td height="40" align="left" valign="middle" bgcolor="#FFFFFF">
                                                <input id="SubTran" name="SubTran" type="button" onclick="SubInfo();" class="button"
                                                    value="立即充值" />
                                            </td>
                                        </tr>
                                    </tbody>
									</form>
									<script language="javascript">
									function SubInfo(){
										if(document.forms['payform'].Money.value=='' || document.forms['payform'].Money.value*1<0){
											alert('请输入支付金额');
											return false;
										} 
										$('input[name=BankName]').val( $('select[name=cardNo]').find('option:selected').text() );
										document.forms['payform'].submit();
									}
									
									 //数字验证 过滤非法字符
									function clearNoNum(obj){
										//先把非数字的都替换掉，除了数字和.
										obj.value = obj.value.replace(/[^\d.]/g,"");
										//必须保证第一个为数字而不是.
										obj.value = obj.value.replace(/^\./g,"");
										//保证只有出现一个.而没有多个.
										obj.value = obj.value.replace(/\.{2,}/g,".");
										//保证.只出现一次，而不能出现两次以上
										obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");
										if(obj.value != ''){
										var re=/^\d+\.{0,1}\d{0,2}$/;
											  if(!re.test(obj.value))   
											  {   
												  obj.value = obj.value.substring(0,obj.value.length-1);
												  return false;
											  } 
										}
									} 
									</script>
                              </table>
                            </td>
                        </tr>
                         
                    </table>
</td>
</tr>    
</table> 

<table cellpadding="5"  cellspacing="0"  class="list-box" id="con5" style="display:none">
<tr>
<td >		
	<table width="100%" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="100%" colspan="3" align="left" bgcolor="#FFFFFF"    valign="top" id="zhuaninfo">   
			
		</td>
	</tr>
	</table>			 
  	<iframe id="loadzhuaninfo"    style="display:none" src="?act=loadpay&uid=<{$uid}>" onload="$('#zhuaninfo').html( $(this).contents().find('body').html() )"></iframe>
</td>
</tr>    
</table> 


<table cellpadding="5"  cellspacing="0"  class="list-box" id="con6" style="display:none">
<tr>
<td>		
						<table width="100%" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="100%" colspan="3" align="left" bgcolor="#FFFFFF" style="display:<{$sty1}>">  
                                    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#EFEFEF">
                                    <tbody> 
										<form name="tixianform" method="post"  target="getdata"> 
										<input type="hidden" name="act" value="tixian" /> 
                                        <tr>
                                            <td width="26%" align="right" bgcolor="#FFFFFF">
                                                用户帐号:</td>
                                            <td width="74%" align="left" bgcolor="#FFFFFF" class="font-redmini">&nbsp;&nbsp;<?php echo $user[0]['g_name']?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 可用余额:</td>
                                            <td align="left" bgcolor="#FFFFFF" style="padding-left: 6px; color:#FF0000">
                                                <?php echo is_Number($user[0]['g_money_yes'])?>￥</td>
                                        </tr>
										
										<tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 姓名:</td>
                                            <td align="left" bgcolor="#FFFFFF" style="padding-left: 5px;">
                                                 <input type="text" name="v_Name" class="TranTextbox"/>必须和银行卡对应的姓名一致
                                            </td>
                                        </tr> 
										<tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 提现金额:</td>
                                            <td align="left" bgcolor="#FFFFFF" style="padding-left: 5px;">
                                                 <input type="text" name="Money" class="TranTextbox"/>不可低于<font color="red"><?=$g_ck_limitcash?></font>元
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 转账银行:</td>
                                            <td align="left" bgcolor="#FFFFFF" style="padding-left: 5px;">
                                                 <input type="text" name="BankName" class="TranTextbox"/>如招商银行
                                            </td>
                                        </tr> 
										<tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 转账帳號:</td>
                                            <td align="left" bgcolor="#FFFFFF" style="padding-left: 5px;">
                                                 <input type="text" name="BankNumber" class="TranTextbox" style="width:250px;"/> 
                                            </td>
                                        </tr> 
                                         
                                        <tr>
                                            <td height="35" align="right" bgcolor="#FFFFFF">&nbsp;
                                                
                                            </td>
                                            <td height="40" align="left" valign="middle" bgcolor="#FFFFFF">
                                                <table width="126" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td align="center">
                                                            <input id="SubTran" name="SubTran" type="submit"  class="button"
                                                                value="申请提现" /></td>
                                                        <td align="center">
                                                            <input id="Button1" type="reset" onclick="" class="button" value="重置信息" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
										</form>
                                    </tbody>
                                </table>
                            </td>  
                        </tr>
                       <!-- <tr>
                            <td colspan="3" align="center" valign="top" bgcolor="#fffcf4"  style="padding:10px; display:none">
                                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="history-lable">
                                    <tbody>
                                        <tr>
                                            <td align="left" class="moregameplaytr">
                                                网银自助转账注意事项：</td>
                                        </tr>
                                        <tr>
                                            <td height="67" align="left" class="moregameplaytr" style="line-height: 18px; letter-spacing: 1px;">
                                                (1).请把您要存款的金额以及转账使用的卡号和开户名填写后,提交转账申请,获得系统生成的验证码,然后登录网银进行转账!<br />
                                                (2).以便财务人员更快确认您的转账金额并充值,转账金额必须与您提交的存款金额相同!<br />
                                                (3).对[中国工商银行]转账时,在"给收款人附言"处填写本站生成的四位数"验证码".<br />
                                                (4).对[中国农业银行]转账时,在"转账用途"处填写本站生成的四位数"验证码".<br />
                                                (5).对[中国建设银行]转账时,必须使用与申请时的填写持卡人姓名相同的账户进行转账.<br />
                                                (6).必须通过[同行转账]进行转账,暂支持[中国工商银行][中国农业银行][中国建设银行].<br />
                                                (7).如有任何疑问,您可以联系 <a href="/online.html" class="font-bluemini">客服中心</a> 人员或拨打客服电话,E乐博为您提供365天×24小时不间断的友善和专业客户咨询服务!</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>-->
                    </table>
  
</td>
</tr>    
</table>


<table cellpadding="5"  cellspacing="0"  class="list-box" id="con7" style="display:none">
<tr>
<td >		
	<table width="100%" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="100%" colspan="3" align="left" bgcolor="#FFFFFF"    valign="top" id="xianinfo">   
			
		</td>
	</tr>
	</table>			 
  	<iframe id="loadxianinfo"    style="display:none" src="?act=loadxian" onload="$('#xianinfo').html( $(this).contents().find('body').html() )"></iframe>
</td>
</tr>    
</table> 
 
<script language="javascript">

var facoNo=new Array();
facoNo['sdk']=new Array(5,10,15,25,30,35,45,50,100,300,350,1000);
facoNo['szx']=new Array(10,30,50,100,300,500);
facoNo['ztk']=new Array(10,15,20,25,30,50,60,100,300,468,500);
facoNo["qbk"]=new Array(5,10,15,30,60,100);
facoNo["ltk"]=new Array(20,30,50,100,300,500);
facoNo["jyk"]=new Array(5,10,15,20,25,30,50,100);
facoNo["wyk"]=new Array(5,19,15,20,30,50);
facoNo["wmk"]=new Array(15,30,50,100);
facoNo["dxk"]=new Array(50,100);
facoNo["shk"]=new Array(5,10,15,30,40,100);
facoNo["zyk"]=new Array(10,15,30,50,100);
facoNo["gyk"]=new Array(5,10,15,30,100);
facoNo["jwk"]=new Array(5,6,9,10,14,15,20,30,50,100,200,300,500,1000) 
$('select[name=cardtype]').bind('change',function(){
	var val = $(this).val();
	$('select[name=faceno]').find('option').remove();
	if(val!=""){
		for(var key in facoNo){
			 
			if(key==val){
				for(var f in facoNo[key]){
					$('select[name=faceno]').append('<option value='+facoNo[key][f]+'>'+facoNo[key][f]+'元</option>');	
				}
			}	
		}	
	}else{
		$('select[name=faceno]').append('<option value="">请选择充值卡</option>');		
	}
	$('input[name=cardname]').val(  $(this).find("option:selected").text() );
})
</script>
 </body>
</html>