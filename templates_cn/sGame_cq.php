<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'templates/offGamecq.php';
$ConfigModel = configModel("`g_cq_game_lock`, `g_mix_money`");
if ($ConfigModel['g_cq_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" '.$onclick;
//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);
 
 $pan = explode (',', $result[0]['g_panlus']); 

	
$_SESSION['cq'] = true;
$g = $_GET['g'];
$abc = $_GET['abc'];
if($abc==null) {$abc=$result[0]['g_panlu'];
}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}



switch ($g) {
	case 'g1':
		$types = '第一球';
		$aHtml = '<a '.$getResult.'>第1球</a>';
		break;
	case 'g2':
		$types = '第二球';
		$aHtml = '<a '.$getResult.'>第2球</a>';
		break;
	case 'g3':
		$types = '第三球';
		$aHtml = '<a '.$getResult.'>第3球</a>';
		break;
	case 'g4':
		$types = '第四球';
		$aHtml = '<a '.$getResult.'>第4球</a>';
		break;
	case 'g5':
		$types = '第五球';
		$aHtml = '<a '.$getResult.'>第5球</a>';
		break;
	default:exit;
} 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
<script type="text/javascript" src="./js/sGame_cq.js"></script>
<title></title>
<script type="text/javascript">
var s = window.parent.frames.leftFrame.location.href.split('/');
		s = s[s.length-1];
if (s !== "left.php")
    window.parent.frames.leftFrame.location.href = "/templates_cn/left.php";

			function soundset(sod){
if(sod.value=="on"){
sod.src="images/soundoff.png";
sod.value="off";
}
else{
sod.src="images/soundon.png";
sod.value="on";
}
SetCookie("soundbut",sod.value);
}
</script>
<style type="text/css">
div#row1 { float: left;  }
div#row2 { }
</style>
</head>
<body class="<?php echo $_COOKIE['g_skin']; ?>">
<input type="hidden" id="hiden" value="<?php echo $g?>" /> 
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr height="24">
        <td class="bolds wanfa">重庆时时彩 <span style="color:#0033FF; font-weight:bold; margin-left:10px;" id="tys"><?=$types?></span></td>
        <td align="left" class="bolds" style="color:#FF0000">
        	<div id="row1" style="FONT-FAMILY: Arial; color: red;"> <span>今天输赢：</span></div>
            <div id="row2"><span id="sy" style="position:relative; top:-1px">0</span></div>
        </td>
        <td  class="bolds klsfhm" align="right" colspan="2" >
            <span id="number" style="line-height:25px;"></span>期开奖<div id="a" class="nc1" style="margin:0px 1px;">&nbsp;</div><div id="b" style="margin:0px 1px;">&nbsp;</div><div id="c" style="margin:0px 1px;">&nbsp;</div><div id="d" style="margin:0px 1px;">&nbsp;</div><div id="e" style="margin:0px 1px;">&nbsp;</div>
        </td>
    </tr>
    <tr height="25">
        <td width="25%"><span id="o" style="color:#009900; font-weight:bold;top:1px"></span>期</td>
        <td width="38%">距离封盘：<span style="font-size:104%" id="endTime">00:00</span></td>
      	<td width="25%">距离开奖：<span style="color:red;font-size:104%" id="endTimes">00:00</span></td>
        <td width="12%" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>
<form id="dp" action="" method="post" target="leftFrame" >
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr>
        <td width="60" class="tz_title" valign="top">投注类型：</td>
        <td width="115"><a href="#this" class="intype_normal" id="kuijie">快捷</a><a href="#this" class="intype_hover" id="yiban">一般</a></td>
        <td align="left">
        	<table border="0" width="339" >
                <tr height="26">
					<td align="center">
                    	<span id="td_input_money"><font class="tz_title">金额</font>&nbsp;<input type="text"  id="AllMoney"  onkeydown="return IsNumeric()"  class="myAllMoney"  value=""  /></span>
                        <input type="button" onclick="submitforms()" id="submits1" class="inputs ti" value="确定" />
                        <input type="button" onclick="MyReset()" class="inputs ti" value="重置" />
                    </td>                   
                </tr>
            </table>
         </td>
    </tr>
</table> 
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<div class="actiionn"></div>
<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0">
	<colgroup>
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
    </colgroup>
	<tr class="t_list_caption">
    	<td>号</td>
    	<td>赔率</td>
    	<td class="je">金额</td>
    	<td>号</td>
    	<td>赔率</td>
    	<td class="je">金额</td>
    	<td>号</td>
    	<td>赔率</td>
    	<td class="je">金额</td>
    	<td>号</td>
    	<td>赔率</td>
    	<td class="je">金额</td>
    	<td>号</td>
    	<td>赔率</td>
    	<td class="je">金额</td>
    </tr>
   <tr class="t_td_text">
    	<td class="caption_1"><span class="No_cq0">&nbsp;</span></td>
    	<td class="o" id="ah1">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1"><span class="No_cq1">&nbsp;</span></td>
    	<td class="o" id="ah2">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1"><span class="No_cq2">&nbsp;</span></td>
    	<td class="o" id="ah3">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1"><span class="No_cq3">&nbsp;</span></td>
    	<td class="o" id="ah4">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1"><span class="No_cq4">&nbsp;</span></td>
    	<td class="o" id="ah5">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td class="caption_1"><span class="No_cq5">&nbsp;</span></td>
    	<td class="o" id="ah6">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1"><span class="No_cq6">&nbsp;</span></td>
    	<td class="o" id="ah7">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1"><span class="No_cq7">&nbsp;</span></td>
    	<td class="o" id="ah8">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1"><span class="No_cq8">&nbsp;</span></td>
    	<td class="o" id="ah9">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td class="caption_1"><span class="No_cq9">&nbsp;</span></td>
    	<td class="o" id="ah10">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td  class="caption_1 ah11">大</td>
    	<td class="o" id="ah11">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 ah12">小</td>
    	<td class="o" id="ah12">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 ah13">单</td>
   	  	<td class="o" id="ah13">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 ah14">双</td>
   	  	<td class="o" id="ah14">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
        <td class="caption_1">&nbsp;</td>
     	<td class="o">&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
	<colgroup>
        <col style="width:8.33%">
        <col style="width:8.33%">
        <col style="width:8.33%">
        <col style="width:8.33%">
        <col style="width:8.33%">
        <col style="width:8.33%">
        <col style="width:8.33%">
        <col style="width:8.33%">
        <col style="width:8.33%">
        <col style="width:8.33%">
        <col style="width:8.33%">
        <col style="width:8.33%">
    </colgroup>
    <tr class="t_td_text">
    	<td class="caption_1 bh1" width="80">总和 大</td>
   	 	<td class="o" id="bh1">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    	<td class="caption_1 bh2" width="80">总和 小</td>
   	  	<td class="o" id="bh2">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    	<td class="caption_1 bh3" width="80">总和 单</td>
   	  	<td class="o" id="bh3">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    	<td class="caption_1 bh4" width="80">总和 双</td>
   	  	<td class="o" id="bh4">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td class="caption_1 bh5">龙</td>
   	  	<td class="o" id="bh5">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    	<td class="caption_1 bh6">虎</td>
    	<td class="o" id="bh6">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    	<td class="caption_1 bh7">和</td>
    	<td class="o" id="bh7">&nbsp;</td>
    	<td class="loads" width="80">&nbsp;</td>
    	<td class="caption_1">&nbsp;</td>
     	<td class="o">&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>
<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
	<colgroup>
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
    </colgroup>
	<tr class="t_list_caption">
        <td colspan="15">前三</td>
	</tr>
    <tr class="t_td_text">
    	<td class="caption_1 ch1">豹子</td>
    	<td class="o" id="ch1">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 ch2">顺子</td>
   	  <td class="o" id="ch2">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 ch3">对子</td>
   	  <td class="o" id="ch3">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 ch4">半顺</td>
   	  <td class="o" id="ch4">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 ch5">杂六</td>
   	  <td class="o" id="ch5">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    </tr>
</table>
<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
	<colgroup>
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
    </colgroup>
	<tr class="t_list_caption">
        <td colspan="15">中三</td>
	</tr>
    <tr class="t_td_text">
    	<td  class="caption_1 dh1">豹子</td>
    	<td class="o" id="dh1">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 dh2">顺子</td>
   	  <td class="o" id="dh2">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 dh3">对子</td>
   	  <td class="o" id="dh3">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 dh4">半顺</td>
   	  <td class="o" id="dh4">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 dh5">杂六</td>
   	  <td class="o" id="dh5">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    </tr>
</table>
<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
	<colgroup>
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
        <col style="width:6.66%">
    </colgroup>
	<tr class="t_list_caption">
        <td colspan="15">后三</td>
	</tr>
    <tr class="t_td_text">
    	<td  class="caption_1 eh1">豹子</td>
    	<td class="o" id="eh1">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 eh2">顺子</td>
   	  <td class="o" id="eh2">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 eh3">对子</td>
   	  <td class="o" id="eh3">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 eh4">半顺</td>
   	  <td class="o" id="eh4">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    	<td  class="caption_1 eh5">杂六</td>
   	  <td class="o" id="eh5">&nbsp;</td>
    	<td class="loads">&nbsp;</td>
    </tr>
</table>
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
    <tr>
        <td width="65" class="tz_title" valign="top">&nbsp;</td>
        <td width="115">&nbsp;</td>
        <td align="left">
        	<table border="0" width="278" >
                <tr height="26">
					<td align="center">
                    	<span id="td_input_money1"><font class="tz_title">金额</font>&nbsp;<input type="text"  id="AllMoney1"  onkeydown="return IsNumeric()"  class="myAllMoney"  value=""  /></span>
                        <input type="button" onclick="submitforms()" id="submits" class="inputs ti" value="确定" />
                        <input type="button" onclick="MyReset()" class="inputs ti" value="重置" />
                    </td>                   
                </tr>
            </table>
         </td>
    </tr>
</table> 
</form>
<table class="wqs" border="0" cellpadding="0" cellspacing="0"  style="margin-top:10px;">
	<tr class="t_list_caption" style="color:#0066FF">
    	<td widtd="10%">0</td>
    	<td widtd="10%">1</td>
        <td widtd="10%">2</td>
        <td widtd="10%">3</td>
        <td widtd="10%">4</td>
        <td widtd="10%">5</td>
        <td widtd="10%">6</td>
        <td widtd="10%">7</td>
        <td widtd="10%">8</td>
        <td>9</td>
    </tr>
    <tr class="t_td_text" id="su">
    	<td colspan="10">&nbsp;</td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0"  style="margin-top:10px;">
	<tr class="t_list_caption">
        <td width="16%" class="nv_ab" ><?php echo$aHtml?></td>
        <td width="16%"><a class="nv" <?php echo $onclick?>>大小</a></td>
        <td width="16%"><a class="nv" <?php echo $onclick?>>单双</a></td>
        <td width="17%"><a class="nv" <?php echo $onclick?>>总和大小</a></td>
        <td width="17%"><a class="nv" <?php echo $onclick?>>总和单双</a></td>
        <td><a class="nv" <?php echo $onclick?>>龙虎和</a></td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px;">
   <tr class="t_td_text" id="z_cl"><td>&nbsp;</td></tr>
</table>
<div class="blank10">&nbsp;</div>
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<div id="look" style="display:none"></div>
<div id="player" style="display: none">
</div>
<?php include './popup.html'?>
<?php include_once 'inc/cl_file.php';?>
<?php 
$name = base64_decode($_COOKIE['g_user']);
 
$db = new DB();
$text =$db->query("SELECT g_text FROM g_set_user_news WHERE g_name = '{$name}' LIMIT 1", 0); 
if ($text){
	alert($text[0][0]);
}
?>
</body>
</html>