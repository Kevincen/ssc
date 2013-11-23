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

if($_REQUEST['act']=='pay'){
	if( $_REQUEST['Money']*1<1 ){
		echo '<script>alert("請輸入存款金額");</script>';
	}else if($_REQUEST['BankName']==""){
		echo '<script>alert("請輸入銀行名稱");</script>';
	}else if($_REQUEST['BankNumber']==""){
		echo '<script>alert("請輸入銀行帳號");</script>';
	}else if($_REQUEST['Money']<$g_ck_limitcash){
		echo '<script>alert("单次转账至少'.$g_ck_limitcash.'元");</script>';
	}else{
		$sql="INSERT INTO g_payrecord SET PayWay=0, g_name='".$user[0]['g_name']."',Money='".$_REQUEST['Money']."',BankName='".$_REQUEST['BankName']."',BankNumber='".$_REQUEST['BankNumber']."',ordernum='".date("YmdHis")."',optdt='".date("Y-m-d H:i:s")."',status=3,v_code='".$_REQUEST['v_code']."'";
		$db->query($sql,0);
		include("payway_l.php"); 
	}
	exit;
}

if($_REQUEST['act']=='loadpay'){
	$pagesize=18;
	if($pagenum=="")$pagenum=1; 
	$sql="select  * from g_payrecord  where g_name='".$user[0]['g_name']."'  And payWay=0  order by id desc limit ".(($pagenum-1)*$pagesize).",".$pagesize;  
	$list=$db->query($sql,1); 
	$splitpage=get_splitpage("g_payrecord","g_name='".$user[0]['g_name']."' And payWay=0 ","act=loadpay","");
	include("payway_s.php");
	exit;
}

if($_REQUEST['act']=='zhuan'){
	if($_REQUEST['v_code']==$_SESSION['yzcode']){
		$sql="INSERT INTO g_payrecord SET PayWay=1,g_name='".$user[0]['g_name']."',Money='".$_REQUEST['Money']."',BankName='".$_REQUEST['BankName']."',optdt='".$_REQUEST['date1']." ".$_REQUEST['HH'].":".$_REQUEST['MMM'].":".$_REQUEST['SS']."',
		InType='".($_REQUEST['InType']=="0" ? $_REQUEST['v_type'] : $_REQUEST['InType'])."',v_Name='".$_REQUEST['v_Name']."',
		v_site='".$_REQUEST['v_site']."',v_remark='".$_REQUEST['v_remark']."',status=3,ordernum='".date("YmdHis")."'	";
		$db->query($sql,0);
		echo '<script>alert("添加記錄成功，請進入存款信息回查查看狀態");parent.showDiv(5,"a5")</script>';
	}else{
		echo '<script>alert("驗證碼錯誤")</script>';
	}
	exit;
}
if($_REQUEST['act']=='loadzhuan'){
	$pagesize=18;
	if($pagenum=="")$pagenum=1; 
	$sql="select  * from g_payrecord  where g_name='".$user[0]['g_name']."'  And payWay=1  order by id desc limit ".(($pagenum-1)*$pagesize).",".$pagesize;  
	$list=$db->query($sql,1); 
	$splitpage=get_splitpage("g_payrecord","g_name='".$user[0]['g_name']."' And payWay=1 ","act=loadzhuan","");
	include("payway_z.php");
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
			<a href="#this" onclick="showDiv(1,'a1')" id="a1" class="hover"><span>会员存款帮组</span></a>
			<a href="#this" onclick="showDiv(2,'a2')" id="a2"><span>网银自助转账</span></a>
			<a href="#this" onclick="showDiv(3,'a3')" id="a3"><span>网银自助回查</span></a> 
			<a href="#this" onclick="showDiv(4,'a4')" id="a4"><span>存款信息提交</span></a> 
			<a href="#this" onclick="showDiv(5,'a5')" id="a5"><span>存款信息回查</span></a> 
			<a href="#this" onclick="showDiv(6,'a6')" id="a6"><span>申请提现</span></a> 
			<a href="#this" onclick="showDiv(7,'a7')" id="a7"><span>提现信息回查</span></a> 
		</td>
		<td class="sclass-title-right">&nbsp;</td>
	</tr>
</table>
<table cellpadding="5"  cellspacing="0"  class="list-box" id="con1">
<tr>
<td>
		<table width="100%" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td width="100%" colspan="3" align="left" bgcolor="#FFFFFF" style="padding:5px;"> 
                                              
                                                    
          <!-- 支付说明 开始 -->
                                                   <p>&nbsp;
	</p>
<p>
	<font color="#000000" face="楷体_GB2312"><strong>尊敬的会员，您好！</strong></font></p>
<p>&nbsp;
	</p>
<p>
	<font face="楷体_GB2312"><br />
	<strong><font color="#000000">会员充值请通过网银转账/银行汇款/ATM转帐/ATM现金等方式充值！！！</font></strong></font><br />
	<font color="#9611ee" face="楷体_GB2312"><br />
	<strong>会员充值目前分为两种操作步骤：(一)(二)</strong></font></p>
<p>
	<br />
	<font color="#f70909" face="楷体_GB2312"><strong><font color="#9900ff">(一).《网银转账》操作步骤说明：</font> </strong></font><font color="#000000" face="楷体_GB2312"><strong>有开通网上银行的会员只需要点击 <font color="#ff0000"><img border="0" src="/images/20120811140750.png" /></font>按照提示进行转帐操作。无需提交汇款信息,功能类似在线支付,成功转帐后,系统将自动添加金额到网站的帐号.具体细节请看图解演示 <font color="#f70909"><font color="#000000"><a href="#this" onclick='showBZ()'><img align="absBottom" alt="" border="0" height="24" src="/images/play-01.jpg" width="68" /></a></font> </font></strong></font></p>
<p>&nbsp;
	</p>
<p>&nbsp;
	</p>
<p>
	<br />
	<font color="#f70909" face="楷体_GB2312"><strong><font color="#9900ff">(二).《银行柜台》《ATM卡转》《ATM现金》存款操作步骤说明:</font> </strong></font><font color="#000000" face="楷体_GB2312"><strong>没有开通网上银行的会员需要先成功存款后,再登录网站帐号提交存款信息,具体细节如下: <font color="#000000"><a href="#this" onclick='showBZ()'><img align="absBottom" alt="" border="0" height="24" src="/images/play-01.jpg" width="68" /></a></font><br />
	</strong></font></p>
<p>&nbsp;
	</p>
<p>
	<font face="楷体_GB2312"><br />
	1.索取网站提供的银行帐号，可以通过《银行柜台》《ATM卡转》《ATM现金》办理存款！</font></p>
<p>&nbsp;
	</p>
<p>
	<font face="楷体_GB2312">2.成功存款后，请点击<img border="0" src="/images/20120811141024.jpg" />按提示填写您存款信息!</font></p>
<p>
	<font face="楷体_GB2312"><br />
	3.成功提交存款信息后，工作人员将会在2分钟至15分钟内为您添加金额！</font></p>
<p>&nbsp;
	</p>
<p>
	<font color="#ff0000" face="楷体_GB2312"><strong><font color="#ff0000" face="楷体_GB2312"><strong>最新会员存款银行帐户:</strong></font></strong></font></p>
<p>
	<font color="#ff0000" face="楷体_GB2312"><strong>&nbsp;</strong></font></p>
<p>
	<font color="#ff0000" face="楷体_GB2312"><strong><strong><font color="#ff0000" face="楷体_GB2312">工商银行: 6222022502016441050 开户名: 吴永敏 开户地区: 云南省</font></strong></strong></font></p>
<p>&nbsp;
	</p>
<p>
	<font color="#cc00ff"><strong>温馨提示：</strong></font></p>
<p>
	<br />
	1.会员存款银行账户信息将会实时更新于此页面，请您在每次存款之前先登录会员账户查询该页面是否有新的存款银行账户信息通知，感谢您的支持和配合！！</p>
<p>
	2.烦请会员尽可能在赛前做好您的存款安排，在存款之时尽量在金额后面加个尾数(例如：转账金额 300.15 或 300.27)，对于恶意重复提交虚假入款信息的会员(包括多次出现未存款先提交等)，我们将会进行冻结账号处理!</p>
<p>
	3.本公司最低存款金额为100元。</p>
<p>
	4.本公司不支持跨行转账方式进行存款。</p>

                                                    <!-- 支付说明 结束 -->
                                                    
                                          
  		</td>
		</tr>
		</table>
</td>
</tr>    
</table>
 
<iframe name="getdata" style="display:none"></iframe>
<table cellpadding="5"  cellspacing="0"  class="list-box" id="con2" style="display:none">
<tr>
<td>		
						<table width="100%" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="100%" colspan="3" align="left" bgcolor="#FFFFFF" id="td1">  
                                    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#EFEFEF">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" align="right" bgcolor="#FFFFFF">
                                                <table width="200" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="146" height="18" align="center">
                                                            <a href="#this" class="font-bluemini" onclick='showBZ()'>网银自助转账帮助</a></td>
                                                        <td width="54">&nbsp;
                                                            </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr> 
										<form name="myform" method="post"  target="getdata" onsubmit="return yzm()">
										
										<input type="hidden" name="act" value="pay" /> 
                                        <tr>
                                            <td width="26%" align="right" bgcolor="#FFFFFF">
                                                用户帐号:</td>
                                            <td width="74%" align="left" bgcolor="#FFFFFF" class="font-redmini">&nbsp;&nbsp;<?php echo $user[0]['g_name']?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 存款金额:</td>
                                            <td align="left" bgcolor="#FFFFFF" style="padding-left: 6px;">
                                                <input size="15" id="Money" name="Money" maxlength="10" class="TranTextbox"
                                                    onkeyup="clearNoNum(this);" />&nbsp;不可低于<font color="#FF0000"><?=$g_ck_limitcash?></font>元</td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 转账银行:</td>
                                            <td align="left" bgcolor="#FFFFFF" style="padding-left: 5px;">
                                                 <select name="BankName" >
												 <?php
												 foreach($bank as $line){
												 	echo "<option value='".$line['BankName']."'>".$line['BankName']."</option>";
												 }
												 ?>
												 </select>
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
                                            <td height="35" align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 验 证 码:</td>
                                            <td align="left" valign="middle" bgcolor="#FFFFFF">
												<table cellpadding="0" cellspacing="0">
												<tr>
												<td>
                                                <input id="v_code" name="v_code" style="margin-left:3px;" maxlength="4" class="TranTextbox" size="8" onkeyup="clearNoNum(this);" />
												</td>
												<td>
                                                <span id="scode"  style="color:#0000CC; border:#FFFFCC solid 1px;  font-size:14px; font-weight:bold"><?php
												$r="";
												for($i=0;$i<4;$i++){
													$r.=rand(0,9999)%10;  
												}
												echo $r;
												?></span></td>
												</tr>
												</table>   
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
                                                                value="提交信息" /></td>
                                                        <td align="center">
                                                            <input id="Button1" type="reset" onclick="" class="button" value="重置信息" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
										</form>
										<script language="javascript">
										function yzm(){
											var v = $('#v_code').val();
											var vv = $('#scode').text();
											if(v!=vv){
												alert('验证码错误');
											}else{
												return false;
											}
										}
										</script>
                                    </tbody>
                                </table>
                            </td>  
                        </tr>
                        <tr>
                            <td colspan="3" align="center" valign="top" bgcolor="#fffcf4"  style="padding:10px;">
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
                        </tr>
                    </table>
  
</td>
</tr>    
</table>


<table cellpadding="5"  cellspacing="0"  class="list-box" id="con3" style="display:none">
<tr>
<td >		
	<table width="100%" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="100%" colspan="3" align="left" bgcolor="#FFFFFF"  style="height:450px;" valign="top" id="payinfo">   
			
		</td>
	</tr>
	</table>			 
  	<iframe id="loadpayinfo"    style="display:none" src="?act=loadpay" onload="$('#payinfo').html( $(this).contents().find('body').html() )"></iframe>
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
									<form name="xform" method="post" target="getdata"> 
									<input type="hidden" name="act" value="zhuan" />
                                    <tbody>
                                        <tr>
                                            <td colspan="2" align="right" bgcolor="#FFFFFF">
                                                <table width="200" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="146" height="18" align="center">
                                                            <a href="#this" class="font-bluemini" onclick='showBZ()'>存款帮助</a></td>
                                                        <td width="54">&nbsp;
                                                            </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="26%" align="right" bgcolor="#FFFFFF">
                                                用户帐号:</td>
                                            <td width="74%" align="left" bgcolor="#FFFFFF" class="font-redmini">
                                                <?php echo $user[0]['g_name']?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 存款金额:</td>
                                            <td align="left" bgcolor="#FFFFFF">
                                                <input id="Money" name="Money" type="text" size="15" style="border: 1px solid #CCCCCC;
                                                    height: 18px; line-height: 20px;" onkeyup="clearNoNum(this);" /></td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 汇款银行:</td>
                                            <td align="left" bgcolor="#FFFFFF">
                                                 <select name="BankName" >
												 <?php
												 foreach($bank as $line){
												 	echo "<option value='".$line['BankName']."'>".$line['BankName']."</option>";
												 }
												 ?>
												 </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 汇款日期:</td>
                                            <td align="left" bgcolor="#FFFFFF"> 
                                                <input type="text" name="date1" id="date1" size="14"  onclick="J('#date1').calendar({ format:'yyyy-MM-dd' });" value="yyyy-mm-dd" class="" />    
                                                时间:<span id="dateDDL"></span>
 
                                                <script language="javascript" type="text/javascript">
                                var dateHtml = new Array();
                                dateHtml.push('<select id="HH" name="HH">');
                                for(var h=0;h<24;h++){
                                    if(h<10) h='0'+h;
                                    dateHtml.push('<option value="'+h+'">'+h+'</option>');
                                }
                                dateHtml.push('</select>时');
                                dateHtml.push('<select id="MMM" name="MMM">');
                                for(var m=0;m<60;m++){
                                    if(m<10) m='0'+m;
                                    dateHtml.push('<option value="'+m+'">'+m+'</option>');
                                }
                                dateHtml.push('</select>分');
                                dateHtml.push('<select id="SS" name="SS">');
                                for(var s=0;s<60;s++){
                                    if(s<10) s='0'+s;
                                    dateHtml.push('<option value="'+s+'">'+s+'</option>');
                                }
                                dateHtml.push('</select>秒');
                                document.getElementById('dateDDL').innerHTML = dateHtml.join("");
                                                </script> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 汇款方式:</td>
                                            <td align="left" bgcolor="#FFFFFF">
                                                <select id="InType" name="InType" onchange="showType();">
                                                    <option value="">请选择汇款方式</option>
                                                    <option value="银行柜台">银行柜台</option>
                                                    <option value="ATM现金">ATM现金</option>
                                                    <option value="ATM卡转">ATM卡转</option>
                                                    <option value="网银转账">网银转账</option>
                                                    <option value="手机银行">手机银行</option>
                                                    <option value="0">其它[手动输入]</option>
                                                </select>
                                                <input id="v_type" name="v_type" type="text" size="19" value="请输入其它汇款方式" onfocus="javascript:this.select();"
                                                    class="font-hhblack" style="border: 1px solid #CCCCCC; height: 18px; line-height: 20px;
                                                    font-size: 12px; display: none;" />
                                                </td>
                                        </tr>
                                        <tr id="tr_v" style="display: none;">
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 持卡人姓名:</td>
                                            <td align="left" bgcolor="#FFFFFF">
                                                <input id="v_Name" name="v_Name" type="text" size="34" onfocus="javascript:if(this.value=='请输入持卡人姓名'){this.value='';}"
                                                    style="border: 1px solid #CCCCCC; height: 18px; line-height: 20px;" /></td>
                                        </tr>
                                        <tr>
                                            <td align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 汇款地点:</td>
                                            <td align="left" bgcolor="#FFFFFF">
                                                <input id="v_site" name="v_site" type="text" size="34" style="border: 1px solid #CCCCCC;
                                                    height: 18px; line-height: 20px;" /></td>
                                        </tr>
                                        <tr style="display: none;">
                                            <td align="right" bgcolor="#FFFFFF">
                                                备注:</td>
                                            <td align="left" bgcolor="#FFFFFF">
                                                <textarea id="v_remark" name="v_remark" cols="40" rows="4" style="border: 1px solid #CCCCCC;
                                                    line-height: 20px;"></textarea></td>
                                        </tr>

                                        
                                        <tr>
                                            <td height="35" align="right" bgcolor="#FFFFFF">
                                                <span class="font-redmini">*</span> 验 证 码:</td>
                                            <td align="left" valign="middle" bgcolor="#FFFFFF">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input name="v_code" id="v_code" type="text" size="10" maxlength="4" style="border: 1px solid #CCCCCC;
                                                                    height: 18px; line-height: 20px;" onkeyup="clearNoNum(this);" />
                                                            </td>
                                                            <td>
                                                                <img src="/includes/chkcode.php" name="pSNsrc" id="pSNsrc" style="cursor: pointer;" alt="点击刷新验证码"
                                                                    onclick="this.src+='?'" /></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="35" align="right" bgcolor="#FFFFFF">&nbsp;
                                          </td>
                                            <td height="40" align="left" valign="middle" bgcolor="#FFFFFF">
                                                <input id="SubTran" name="SubTran" type="button" onclick="SubInfo();" class="button"
                                                    value="提交信息" />
                                            </td>
                                        </tr>
                                    </tbody>
									</form>
									<script language="javascript">
									function SubInfo(){
										if(document.forms['xform'].Money.value=='' || document.forms['xform'].Money.value*1<0){
											alert('请输入存款金额');
											return false;
										}
										if(document.forms['xform'].BankName.value==''){
											alert('请选择汇款银行');
											return false;
										}
										if(document.forms['xform'].date1.value=='yyyy-mm-dd' || document.forms['xform'].HH.value=='00'){
											alert('为了更快确认你的转账，请选择详细汇款时间');
											return false;
										}
										if(document.forms['xform'].InType.value==''){
											alert('为了更快确认你的转账，请选择汇款方式');
											return false;
										}
										if(document.forms['xform'].v_site.value==''){ 
											alert('为了更快确认你的转账，请输入汇款地点');
											return false;
										}
										if($('#InType')[0].value=='网银转账' || $('#InType')[0].value=='ATM卡转' || $('#InType')[0].value=='手机银行'){
											if(document.forms['xform'].v_Name.value=='请输入持卡人姓名'){
												alert('请输入持卡人姓名');return false;
											}
										}
										if($('#InType')[0].value=='0' ){
											if(document.forms['xform'].v_type.value=='请输入其它汇款方式'){
												alert('请输入其它汇款方式');return false;
											}
										}
										document.forms['xform'].submit();
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
									
									
									function showType(){
										if($('#InType')[0].value=='0'){
											$('#v_type')[0].style.display='';
											$('#tr_v')[0].style.display='none';
										}else if($('#InType')[0].value=='网银转账' || $('#InType')[0].value=='ATM卡转' || $('#InType')[0].value=='手机银行'){
											$('#tr_v')[0].style.display='';
											$('#v_Name')[0].value='请输入持卡人姓名';
											$('#v_type')[0].style.display='none'; 
										}else{
											$('#v_type')[0].style.display='none'; 
											$('#tr_v')[0].style.display='none';
										}
									} 
									</script>
                              </table>
                            </td>
                        </tr>
                        <tr>
                             <td colspan="3" align="center" valign="top" bgcolor="#fffcf4"  style="padding:10px;">
                                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="history-lable">
                                    <tbody>
                                        <tr>
                                            <td align="left" class="moregameplaytr">
                                                汇款信息提交说明：</td>
                                        </tr>
                                        <tr>
                                            <td height="67" align="left" class="moregameplaytr">
                                                (1).请按表格填写准确的汇款转账信息,确认提交后相关财务人员会即时为您查询入款情况,充值成功后将会有客服中心给您回复!<br />
                                                (2).请您在转账金额后面加个尾数,例如:转账金额 300.15 或 300.27 等,以便相关财务人员更快确认您的转账金额并充值!<br />
                                                (3).如有任何疑问,您可以联 客服中心 人员或拨打客服电话,E乐博为您提供365天×24小时不间断的友善和专业客户咨询服务!</td>
                                        </tr>
                                    </tbody>
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
		<td width="100%" colspan="3" align="left" bgcolor="#FFFFFF"  style="height:450px;" valign="top" id="zhuaninfo">   
			
		</td>
	</tr>
	</table>			 
  	<iframe id="loadzhuaninfo"    style="display:none" src="?act=loadzhuan&uid=<{$uid}>" onload="$('#zhuaninfo').html( $(this).contents().find('body').html() )"></iframe>
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
		<td width="100%" colspan="3" align="left" bgcolor="#FFFFFF"  style="height:450px;" valign="top" id="xianinfo">   
			
		</td>
	</tr>
	</table>			 
  	<iframe id="loadxianinfo"    style="display:none" src="?act=loadxian" onload="$('#xianinfo').html( $(this).contents().find('body').html() )"></iframe>
</td>
</tr>    
</table> 


<table cellpadding="5"  cellspacing="0"  class="list-box" id="con8">
<tr>
<td>
 			<table width="100%" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="100%" colspan="3" align="left" bgcolor="#FFFFFF" style="padding:5px;"> 
                                              
							 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="700" height="420">
															  <param name="movie" value="/images/bank.swf" />
															  <param name="quality" value="high" />
															  <embed src="/images/bank.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="700" height="420"></embed>
							</object>

                                          
  		</td>
		</tr>
		</table>
</td>
</tr>    
</table>

 </body>
</html>