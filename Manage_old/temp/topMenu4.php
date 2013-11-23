<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'Manage/ExistUser.php';
global $Users, $LoginId;

$news = null;
$db=new DB();
$text = $db->query("SELECT g_text FROM g_news WHERE g_rank_show = 1 ORDER BY g_id DESC LIMIT 1 ", 0);
if ($text){
	$news = strip_tags($text[0][0]);
}
$name = isset($Users[0]['g_lock_1']) ? $Users[0]['g_s_name'] : $Users[0]['g_name'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="/page/Index.css">
<link type="text/css" rel="stylesheet" href="/page/Top.css">
<style>
<!--
#But_Html #a_span{
    display: inline;
    float: left;
    height: 45px;
    line-height: 18px;
    margin-top: 1px;
}
#But_Html #a_span a{
    display: inline;
    float: left;
    margin-left: 4px;
    padding: 1px 6px;
    color:#FFFF00;
    text-decoration:none;
}
#But_Html #a_span a:hover{
	background:url(/page/bg.gif) repeat-x;
}
/*
#But_Html #a_span a{
	border-right:1px solid #FFFF00;
	margin-top: 2px;
    padding: 1px 6px;
}
*/
-->
</style>
<script type="text/javascript" src="/js/actiontop.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/Manage/temp/js/sc.js"></script>
<script type="text/javascript">
<!--
	$(function(){
		$("#a_span").html(setHtml[2]);
	});
	var setHtml = new Array();
	var target = "mainFrame";
	var rul = "oddsFile.php";
	var rulgx = "oddsFile_gx.php";
	var rulpk = "oddsFilepk.php";
	var rulnc = "oddsFilenc.php";
    setHtml[0] = '<a href="'+rul+'?cid=1" target="'+target+'">第一球</a>'+
						'<a href="'+rul+'?cid=2" target="'+target+'">第二球</a>'+
						'<a href="'+rul+'?cid=3" target="'+target+'">第三球</a>'+
						'<a href="'+rul+'?cid=4" target="'+target+'">第四球</a>'+
						'<a href="'+rul+'?cid=5" target="'+target+'">第五球</a>'+
						'<a href="'+rul+'?cid=6" target="'+target+'">第六球</a>'+
						'<a href="'+rul+'?cid=7" target="'+target+'">第七球</a>'+
						'<a href="'+rul+'?cid=8" target="'+target+'">第八球</a>'+
						'<a href="oddsFile_LH.php?cid=9" target="'+target+'">總和、龍虎</a>'+
						'<a href="oddsFile_LM.php?cid=10" target="'+target+'">連碼</a>' +
						'<a href="Reckoning.php?tid=1" target="'+target+'">帳單</a>';
	setHtml[5] = '<a href="'+rulgx+'?cid=1" target="'+target+'">第一球</a>'+
						'<a href="'+rulgx+'?cid=2" target="'+target+'">第二球</a>'+
						'<a href="'+rulgx+'?cid=3" target="'+target+'">第三球</a>'+
						'<a href="'+rulgx+'?cid=4" target="'+target+'">第四球</a>'+
						'<a href="'+rulgx+'?cid=5" target="'+target+'">特码</a>'+
						'<a href="oddsFile_LH_gx.php?cid=9" target="'+target+'">總和、龍虎</a>'+
						'<a href="oddsFile_LM_gx.php?cid=10" target="'+target+'">連碼</a>' +
						'<a href="Reckoning.php?tid=3" target="'+target+'">帳單</a>';
	setHtml[7] = '<a href="'+rulnc+'?cid=1" target="'+target+'">第一球</a>'+
						'<a href="'+rulnc+'?cid=2" target="'+target+'">第二球</a>'+
						'<a href="'+rulnc+'?cid=3" target="'+target+'">第三球</a>'+
						'<a href="'+rulnc+'?cid=4" target="'+target+'">第四球</a>'+
						'<a href="'+rulnc+'?cid=5" target="'+target+'">第五球</a>'+
						'<a href="'+rulnc+'?cid=6" target="'+target+'">第六球</a>'+
						'<a href="'+rulnc+'?cid=7" target="'+target+'">第七球</a>'+
						'<a href="'+rulnc+'?cid=8" target="'+target+'">第八球</a>'+
						'<a href="oddsFile_LH_nc.php?cid=9" target="'+target+'">總和、家禽野兽</a>'+
						'<a href="oddsFile_LM_nc.php?cid=10" target="'+target+'">連碼</a>' +
						'<a href="Reckoning.php?tid=5" target="'+target+'">帳單</a>';
						
	setHtml[8] = '<a href="'+rulpk+'?cid=1" target="'+target+'">冠、亞軍 組合</a>'+
						'<a href="'+rulpk+'?cid=2" target="'+target+'">三、四、伍、六名</a>'+
						'<a href="'+rulpk+'?cid=3" target="'+target+'">七、八、九、十名</a>'+
						'<a href="Reckoning.php?tid=6" target="'+target+'">帳單</a>';
						
    setHtml[1] = <?php if ($LoginId==89){?>'<a href="Actfor.php?cid=1" target="'+target+'">分公司</a>'+<?php }?>
    					<?php if ($LoginId==89||$LoginId==56){?>'<a href="Actfor.php?cid=2" target="'+target+'">股東</a>'+<?php }?>
    					<?php if ($LoginId==89||$LoginId==56||$LoginId==22){?>'<a href="Actfor.php?cid=3" target="'+target+'">總代理</a>'+<?php }?>
    					<?php if ($LoginId==89||$LoginId==56||$LoginId==22||$LoginId==78){?>'<a href="Actfor.php?cid=4" target="'+target+'">代理</a>'+<?php }?>
						'<a href="Actfor.php?cid=5" target="'+target+'">會員</a>'+
						<?php if (!isset($Users[0]['g_lock_6'])){?>
						'<a href="AccountSon_List.php" target="'+target+'">子帳號</a>'+
						<?php }else if (isset($Users[0]['g_lock_6']) && $Users[0]['g_lock_6'] ==1){?>
						'<a href="AccountSon_List.php" target="'+target+'">子帳號</a>'+
						<?php }?>
						'';
	setHtml[2] = 
    <?php if (($LoginId==22||$LoginId==78||$LoginId==48) && !isset($Users[0]['g_lock_2'])) {?>
    					'<a href="CreditInfo.php" target="'+target+'">信用資料</a>'+
    					<?php }?>
						<?php if ($LoginId==89 && !isset($Users[0]['g_lock_1'])) {?>
						'<a href="SaveCode.php" target="'+target+'">安全码设置</a>'+
						<?php }?>
					    '<a href="LoginLog.php" target="'+target+'">登錄日記</a>'+
						'<a href="UpdatePwd.php" target="'+target+'">變更密碼</a>'
						<?php  if ($LoginId!=89 && $LoginId!=56 && $Users[0]['g_Immediate_lock'] == 1 && !isset($Users[0]['g_lock_3'])){?>
						+
						'<a href="AutoLet.php" target="'+target+'" style="color:red">自動補倉設定</a>'+
						'<a href="Amend_Log.php" target="'+target+'">自動補倉更變記錄</a>';
					    <?php } else if ($LoginId!=89 && $LoginId!=56 && isset($Users[0]['g_lock_3']) && $Users[0]['g_lock_3'] == 1) {?>
					    +
						'<a href="AutoLet.php" target="'+target+'" style="color:red">自動補倉設定</a>'+
						'<a href="Amend_Log.php" target="'+target+'">自動補倉更變記錄</a>';
					    <?php echo ';';}?>
	<?php if ($LoginId==89){?>
	setHtml[3] = 
						<?php if (!isset($Users[0]['g_lock_1_1'])){?>	 
						 '<a href="Manages.php" target="'+target+'">系統設置</a>'+
						  	
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_1'] == 1){?>
						 '<a href="Manages.php" target="'+target+'">系統設置</a> '+
							
						 <?php }?>

						 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="oddsInfo.php" target="'+target+'">賠率設置</a>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_2'] == 1){?>
						 '<a href="oddsInfo.php" target="'+target+'">賠率設置</a>'+
						 <?php }?>
						 
						  <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="OddsBC.php" target="'+target+'">盘賠率差設置</a>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_2'] == 1){?>
						 '<a href="OddsBC.php" target="'+target+'">盘賠率差設置</a>'+
						 <?php }?>

						 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="newsInfo.php" target="'+target+'">公告設置</a>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_3'] == 1){?>
						 '<a href="newsInfo.php" target="'+target+'">公告設置</a>'+
						 <?php }?>

						 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="CrystalInfo.php" target="'+target+'">注單設置</a>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_4'] == 1){?>
						 '<a href="CrystalInfo.php" target="'+target+'">注單設置</a>'+
						 <?php }?>

						 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="NumbeInclude.php" target="'+target+'">開獎設置</a>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_5'] == 1){?>
						 '<a href="NumbeInclude.php" target="'+target+'">開獎設置</a>'+
						 <?php }?>

						 <?php if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="NumberInclude.php" target="'+target+'">開盤設置</a>'+
						 	 <?php if($iscash){?> 
							 '<a href="payrecordEX.php?payway=0" target="'+target+'">会员充值记录</a> '+ 
							 '<a href="tixian.php" target="'+target+'">会员提现记录</a>'+
							 <?php }?>
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_6'] == 1){?>
						 '<a href="NumberInclude.php" target="'+target+'">開盤設置</a>'+
						 <?php }?>

						 <?php /* if (!isset($Users[0]['g_lock_1_1'])){?>
						 '<a href="dataBak.php" target="'+target+'">數據備份</a>'+
						 <?php }else if (isset($Users[0]['g_lock_1_1']) && $Users[0]['g_lock_1_7'] == 1){?>
						 '<a href="dataBak.php" target="'+target+'">數據備份</a>'+
						 <?php } */?>
						 '';
	 					 <?php }?>
	setHtml[4] = '<a href="oddsFilecq.php" target="'+target+'">總項盤口</a>'+
							   '<a href="Reckoning.php?tid=2" target="'+target+'">帳單</a>';
	
	setHtml[9] = '<a href="oddsFilelhc_zt.php" target="'+target+'">特碼/正碼</a>'+
				 '<a href="oddsFilelhc_zm.php" target="'+target+'">正碼1-6</a>'+ 
				 '<a href="oddsFilelhc_o.php" target="'+target+'">其他</a>'+ 
				'<a href="Reckoning.php?tid=2" target="'+target+'">帳單</a>';
	
	setHtml[10] = '<a href="oddsFilexj.php" target="'+target+'">總項盤口</a>'+
							   '<a href="Reckoning.php?tid=2" target="'+target+'">帳單</a>';
	function Loading_But (str){
		var a_span = $("#a_span");
		switch (str) {
			case 1 :
				var lt = document.getElementById("LT");
				if (lt.value == 1){
					a_span.html(setHtml[0]); 
				} else  if(lt.value == 3){
					a_span.html(setHtml[5]); 
				}else if(lt.value == 5){
					a_span.html(setHtml[7]); 
				}else if(lt.value == 6){
					a_span.html(setHtml[8]); 
				}else if(lt.value == 7){
					a_span.html(setHtml[9]); 
				}else if(lt.value == 8){
					a_span.html(setHtml[10]); 
				}else {
					a_span.html(setHtml[4]); 
				}
				break;
			case 8 :
			case 2 :a_span.html(setHtml[1]); break;
			case 3 :a_span.html(setHtml[2]); break;
			<?php if ($LoginId==89){?>
			case 4 :a_span.html(setHtml[3]); break;
			<?php }?>
		}
		$("#But_Html #a_span a").after('<span style="float:left;color:#FFFF00;margin-top:1px;" >|</span>');
		$("#But_Html #a_span a:last").next().remove();
	}
	function GoForm (url){
	var f=document.createElement("form");
			f.action=url;
			f.target="mainFrame";
			f.method="get";
			document.body.appendChild(f);
			f.submit();
	}
	function selectType(p_type){
		$("#LT").val(p_type); 
		$("#bST_1").removeClass("bST_3_s");
		$("#bST_2").removeClass("bST_3_s");
		$("#bST_3").removeClass("bST_3_s");
		$("#bST_6").removeClass("bST_3_s");
		$("#bST_9").removeClass("bST_3_s");
		$("#bST_"+p_type).addClass("bST_3_s");
		$.post("/Manage/temp/ajax/json.php", {typeid : "gameCode", id : p_type }, function(data){
			Loading_But (1);
		});
	}
//-->
</script>
<title></title>
<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
.but_1,.but_1_m{
	cursor:pointer;
}
-->
</style>
</head>
<body onselectstart="return false" oncut="return false" oncopy="return false">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody><tr>
    <td width="20%" rowspan="2" align="left" ><img width="219" height="67" src="/page/WebLogo_163.jpg"></td>
    <td width="80%" height="10" >
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tbody><tr>
            <td width="15%"><span style="position: relative; top: 2px" class="Font_New F_bold" id="BeLine_User"></span></td>
            <td width="60%"><marquee whdth="100%" onmouseout="this.start()" onmouseover="this.stop()" scrolldelay="120" scrollamount="5" style="position: relative; top: 2px"><a target="content" href="News.aspx"><font class="Font_Count" id="Affiche"><?php echo $news?></font></a></marquee></td>
            <td width="25%" height="10" class="f_right"><span style="position: relative; top: 2px; left: -7px" class="Font_New F_bold">
            <?php echo $Users[0]['g_Lnid'][0].'：'.$name?></span></td>
          </tr>
        </tbody></table>
    </td>
  </tr>
  <tr>
    <td valign="bottom" height="26" align="left"  >
<table width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
  <tbody><tr>
    <td height="3"></td>
  </tr>
  <tr>
    <td height="26" style="text-align:left;">
	
                        	<?php if (($Users[0]['g_Immediate2_lock'] == 1 || $Users[0]['g_login_id']==89) && !isset($Users[0]['g_lock_4'])) {?>
	<input type="button" value="即時註單" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(1);" name="but_1" class="but_1">
                            <?php }else if ($Users[0]['g_lock_4'] == 1){?>
	<input type="button" value="即時註單" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(1);" name="but_1" class="but_1">
                            <?php }?>
                        	<?php if (isset($Users[0]['g_lock_2'])) {
                            	if ($Users[0]['g_lock_2'] == 1){
                            	?>
	<input type="button" value="用戶管理" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(2);" name="but_2" class="but_1">
                            <?php }}else{?>
	<input type="button" value="用戶管理" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(2);" name="but_2" class="but_1">
                            <?php }?>
	<input type="button" value="個人管理" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(3);" name="but_3" class="but_1">
	
    <?php if ($LoginId==89 && !isset($Users[0]['g_lock_1'])){?>
	<input type="button" value="内部管理" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(4);" name="but_4" class="but_1">
    <?php }else if (isset($Users[0]['g_lock_1']) && $Users[0]['g_lock_1'] == 1){?>
	<input type="button" value="内部管理" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="Loading_But(4);" name="but_4" class="but_1">
    <?php }?>
    	
                            <?php if (isset($Users[0]['g_lock_5'])) {
                            	if ($Users[0]['g_lock_5'] == 1){?>
	<input type="button" value="報表查詢" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('Report_Center.php');" name="but_5" class="but_1">
                            	<?php }}else {?>
	<input type="button" value="報表查詢" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('Report_Center.php');" name="but_5" class="but_1">
                            	<?php }?>
	<input type="button" value="歷史開獎" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('Lottery_Result.php');" name="but_6" class="but_1">
	<input type="button" value="站內消息" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('newFile.php');" name="but_7" class="but_1">
	<?php if ($LoginId==89 && !isset($Users[0]['g_lock_1'])){?>
	<input type="button" value="在线人数" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('online.php');" name="but_9" class="but_1">
	<?php }else if (isset($Users[0]['g_lock_1']) && $Users[0]['g_lock_1'] == 1){?>
	<input type="button" value="在线人数" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('online.php');" name="but_9" class="but_1">
	<?php }?>
							<?php /* if($Users[0]['g_login_id']==89){?>
	<input type="button" value="客服中心" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('gkfzx.php');" name="but_10" class="but_1">
							<?php } else{
							?>
	<input type="button" value="客服中心" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('kfzx.php');" name="but_10" class="but_1">
							<?php
							} */?>
    <?php /* if ($LoginId==89 && !isset($Users[0]['g_lock_1'])){?>
	<input type="button" value="客服中心" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('gkfzx.php');" name="but_10" class="but_1">
    <?php }else if (isset($Users[0]['g_lock_1']) && $Users[0]['g_lock_1'] == 1){?>
	<input type="button" value="客服中心" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="GoForm('gkfzx.php');" name="but_10" class="but_1">
    <?php } */?>
	<input type="button" value="退 出" onmouseover="this.className='but_1_m'" onmouseout="this.className='but_1'" onclick="top.location.href='Quit.php';" name="but_8" class="but_1"></td>
  </tr>
</tbody></table>

	</td>
  </tr>
  <tr>
    <td height="28" colspan="2"><table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tbody><tr>
       <td  nowrap width="420" height="30" style="text-align:left">&nbsp;
	 <!--  <select onchange="selectType(this.value)" style="color:#000000">
	   		<option value="1">廣東快樂十分</option>
			<option value="2">重慶時時彩</option>
			<option value="3">廣西快樂十分</option>
			<option value="6">北京賽車(PK10)</option>
			<option value="7">六合彩</option>
			<option value="5">幸运农场</option>
			<option value="8">新疆時時彩</option>
			<option value="9">江苏骰寶(快3)</option>
	   </select>-->
	   <input type="button" style="cursor: pointer;" onclick="selectType(1);" name="bST_1" id="bST_1" class="bST_3" value="廣東快樂十分"><input type="button" style="cursor: pointer;" onclick="selectType(2);" name="bST_2" id="bST_2"  class="bST_3" value="重慶時時彩"><input type="button" style="cursor: hand;display:none;" onclick="selectType(3);" name="bST_3" id="bST_3" class="bST_3" value="廣西快樂十分"><input type="button" style="cursor: pointer;" onclick="selectType(6);" name="bST_6" id="bST_6" class="bST_3" value="北京賽車(PK10)"><input type="button" style="cursor: pointer;" onclick="selectType(9);" name="bST_9" id="bST_9" class="bST_3" value="江苏骰寶(快3)"></td>
        <td id="But_Html" rowspan="2"><span id="a_span" ></span></td>
      </tr>
      <tr>
        <td height="23"><span class="font_w F_bold" id="clock_Html" style="position: relative; top: 1px">&nbsp;</span>&nbsp;&nbsp;&nbsp;</td>
        </tr>
    </tbody></table></td>
  </tr>
</tbody></table>
		<input type="hidden" id="LT" name="LT" value="1" />
<script type="text/javascript">
selectType(1);
</script>

</body>
</html>