<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'templates_cn/offGamepk.php';
$ConfigModel = configModel("`g_pk_game_lock`, `g_mix_money`");
if ($ConfigModel['g_pk_game_lock'] !=1)exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$_SESSION['cq'] = false;
$_SESSION['nc'] = false;
//获取当前盘口
	$name = base64_decode($_COOKIE['g_user']);
	$db=new DB();
	$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
	$result = $db->query($sql, 1);

 $pan = explode(',', $result[0]['g_panlus']); 
$_SESSION['cq'] = false;
$_SESSION['nc'] = false;
$_SESSION['jsk3'] = false;
$_SESSION['gd'] = false;
$_SESSION['pk'] = true;


$g = $_GET['g'];
$abc = $_GET['abc'];
if($abc==null) {$abc=$result[0]['g_panlu'];
}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/sc.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="./js/odds_sm_pk.js"></script>
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
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr height="24">
        <td class="bolds wanfa">北京赛车(PK10) <span style="color:#0033FF; font-weight:bold; margin-left:10px;" id="tys">两面盘</span></td>
        <td align="left" class="bolds" style="color:#FF0000">
        	<div id="row1" style="FONT-FAMILY: Arial; color: red;"> <span>今天输赢：</span></div>
            <div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div>
        </td>
        <td  class="bolds bjschm" align="right" colspan="2" >
            <span id="number" style="line-height:25px;"></span>期开奖<div id="a" class="nc1" style="margin:0px 1px;">&nbsp;</div><div id="b" style="margin:0px 1px;">&nbsp;</div><div id="c" style="margin:0px 1px;">&nbsp;</div><div id="d" style="margin:0px 1px;">&nbsp;</div><div id="e" style="margin:0px 1px;">&nbsp;</div><div id="f" style="margin:0px 1px;">&nbsp;</div><div id="g" style="margin:0px 1px;">&nbsp;</div><div id="h" style="margin:0px 1px;">&nbsp;</div><div id="j" style="margin:0px 1px;">&nbsp;</div><div id="k" style="margin:0px 1px;">&nbsp;</div>
        </td>
    </tr>
    <tr height="25">
        <td width="25%"><span id="o" style="color:#009900; font-weight:bold;top:1px"></span>期</td>
        <td width="28%">距离封盘：<span style="font-size:104%" id="endTime">00:00</span></td>
      	<td width="21%" style="text-indent:44px;">距离开奖：<span style="color:red;font-size:104%" id="endTimes">00:00</span></td>
        <td align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>
<form id="dp" action="" method="post" target="leftFrame" onsubmit = "return submitforms()">
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:5px">
    <tr>
        <td width="65" class="tz_title" valign="top">投注类型：</td>
        <td width="115"><a href="#this" class="intype_normal" id="kuijie">快捷</a><a href="#this" class="intype_hover" id="yiban">一般</a></td>
        <td align="left">
        	<table border="0" width="278" >
                <tr height="26">
					<td align="center">
                    	<span id="td_input_money"><font class="tz_title">金额</font>&nbsp;<input type="text"  id="AllMoney"  onkeydown="return IsNumeric()"  class="myAllMoney"  value=""  /></span>
                        <input type="submit" id="submits1" class="inputs ti" value="确定" />
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
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
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
	<tr class="t_list_caption">
    	<td colspan="12">冠、亚军和</td>
    </tr>
   <tr class="t_td_text">
    	<td class="caption_1">冠亚大</td>
   	  	<td class="o" id="kh1"></td>
    	<td class="tt" id="t12_h1"></td>
        <td class="caption_1">冠亚小</td>
   	  	<td class="o" id="kh2"></td>
    	<td class="tt" id="t12_h2"></td>
        <td class="caption_1">冠亚双</td>
   	   	<td class="o" id="kh4"></td>
    	<td class="tt" id="t12_h4"></td>
        <td class="caption_1">冠亚单</td>
   	   	<td class="o" id="kh3"></td>
    	<td class="tt" id="t12_h3"></td>
   	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="Full_table" style="margin-top:0px;">
	<tr>
		<td class="w20">
        	<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px; width:99%">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                </colgroup>
            	<tr class="t_list_caption">
                    <td colspan="3">冠军</td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td class="o" id="ah11"></td>
                    <td class="tt" id="t1_h11"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td class="o" id="ah12"></td>
                    <td class="tt" id="t1_h12"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td class="o" id="ah13"></td>
                    <td class="tt" id="t1_h13"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td class="o" id="ah14"></td>
                    <td class="tt" id="t1_h14"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">龙</td>
                    <td class="o" id="ah15"></td>
                    <td class="tt" id="t1_h15"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">虎</td>
                    <td class="o" id="ah16"></td>
                    <td class="tt" id="t1_h16"></td>
                </tr>
            </table>
        </td>
        <td class="w20">
        	<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px; width:99%">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                </colgroup>
            	<tr class="t_list_caption">
                    <td colspan="3">亚军</td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td class="o" id="bh11"></td>
                    <td class="tt" id="t2_h11"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td class="o" id="bh12"></td>
                    <td class="tt" id="t2_h12"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td class="o" id="bh13"></td>
                    <td class="tt" id="t2_h13"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td class="o" id="bh14"></td>
                    <td class="tt" id="t2_h14"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">龙</td>
                    <td class="o" id="bh15"></td>
                    <td class="tt" id="t2_h15"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">虎</td>
                    <td class="o" id="bh16"></td>
                    <td class="tt" id="t2_h16"></td>
                </tr>
            </table>
        </td>
        <td class="w20">
        	<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px; width:99%">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                </colgroup>
            	<tr class="t_list_caption">
                    <td colspan="3">第三名</td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td class="o" id="ch11"></td>
                    <td class="tt" id="t3_h11"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td class="o" id="ch12"></td>
                    <td class="tt" id="t3_h12"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td class="o" id="ch13"></td>
                    <td class="tt" id="t3_h13"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td class="o" id="ch14"></td>
                    <td class="tt" id="t3_h14"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">龙</td>
                    <td class="o" id="ch15"></td>
                    <td class="tt" id="t3_h15"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">虎</td>
                    <td class="o" id="ch16"></td>
                    <td class="tt" id="t3_h16"></td>
                </tr>
            </table>
        </td>
        <td class="w20">
        	<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px; width:99%">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                </colgroup>
            	<tr class="t_list_caption">
                    <td colspan="3">第四名</td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td class="o" id="dh11"></td>
                    <td class="tt" id="t4_h11"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td class="o" id="dh12"></td>
                    <td class="tt" id="t4_h12"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td class="o" id="dh13"></td>
                    <td class="tt" id="t4_h13"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td class="o" id="dh14"></td>
                    <td class="tt" id="t4_h14"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">龙</td>
                    <td class="o" id="dh15"></td>
                    <td class="tt" id="t4_h15"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">虎</td>
                    <td class="o" id="dh16"></td>
                    <td class="tt" id="t4_h16"></td>
                </tr>
            </table>
        </td>
        <td class="w20">
        	<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px; width:99%">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                </colgroup>
            	<tr class="t_list_caption">
                    <td colspan="3">第五名</td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td class="o" id="eh11"></td>
                    <td class="tt" id="t5_h11"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td class="o" id="eh12"></td>
                    <td class="tt" id="t5_h12"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td class="o" id="eh13"></td>
                    <td class="tt" id="t5_h13"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td class="o" id="eh14"></td>
                    <td class="tt" id="t5_h14"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">龙</td>
                    <td class="o" id="eh15"></td>
                    <td class="tt" id="t5_h15"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">虎</td>
                    <td class="o" id="eh16"></td>
                    <td class="tt" id="t5_h16"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="Full_table" style="margin-top:0px;">
	<tr>
		<td class="w20">
        	<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px; width:99%">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                </colgroup>
            	<tr class="t_list_caption">
                    <td colspan="3">第六名</td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td class="o" id="fh11"></td>
                    <td class="tt" id="t6_h11"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td class="o" id="fh12"></td>
                    <td class="tt" id="t6_h12"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td class="o" id="fh13"></td>
                    <td class="tt" id="t6_h13"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td class="o" id="fh14"></td>
                    <td class="tt" id="t6_h14"></td>
                </tr>
                
            </table>
        </td>
        <td class="w20">
        	<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px; width:99%">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                </colgroup>
            	<tr class="t_list_caption">
                    <td colspan="3">第七名</td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td class="o" id="gh11"></td>
                    <td class="tt" id="t7_h11"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td class="o" id="gh12"></td>
                    <td class="tt" id="t7_h12"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td class="o" id="gh13"></td>
                    <td class="tt" id="t7_h13"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td class="o" id="gh14"></td>
                    <td class="tt" id="t7_h14"></td>
                </tr>
               
            </table>
        </td>
        <td class="w20">
        	<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px; width:99%">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                </colgroup>
            	<tr class="t_list_caption">
                    <td colspan="3">第八名</td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td class="o" id="hh11"></td>
                    <td class="tt" id="t8_h11"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td class="o" id="hh12"></td>
                    <td class="tt" id="t8_h12"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td class="o" id="hh13"></td>
                    <td class="tt" id="t8_h13"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td class="o" id="hh14"></td>
                    <td class="tt" id="t8_h14"></td>
                </tr>
                
            </table>
        </td>
        <td class="w20">
        	<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px; width:99%">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                </colgroup>
            	<tr class="t_list_caption">
                    <td colspan="3">第九名</td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td class="o" id="ih11"></td>
                    <td class="tt" id="t9_h11"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td class="o" id="ih12"></td>
                    <td class="tt" id="t9_h12"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td class="o" id="ih13"></td>
                    <td class="tt" id="t9_h13"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td class="o" id="ih14"></td>
                    <td class="tt" id="t9_h14"></td>
                </tr>
                
            </table>
        </td>
        <td class="w20">
        	<table class="wqs ssc_input" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px; width:99%">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                </colgroup>
            	<tr class="t_list_caption">
                    <td colspan="3">第十名</td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td class="o" id="jh11"></td>
                    <td class="tt" id="t10_h11"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td class="o" id="jh12"></td>
                    <td class="tt" id="t10_h12"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td class="o" id="jh13"></td>
                    <td class="tt" id="t10_h13"></td>
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td class="o" id="jh14"></td>
                    <td class="tt" id="t10_h14"></td>
                </tr>
            </table>
        </td>
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
                        <input type="submit" id="submits" class="inputs ti" value="确定" />
                        <input type="button" onclick="MyReset()" class="inputs ti" value="重置" />
                    </td>                   
                </tr>
            </table>
         </td>
    </tr>
</table> 
</form>
<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
	<tr class="t_list_caption">
        <td class="nv_ab" ><a class="nv_a" <?php echo $onclick?>>冠、亚军和</a></td>
        <td><a class="nv" <?php echo $onclick?>>冠、亚军和 大小</a></td>
        <td><a class="nv" <?php echo $onclick?>>冠、亚军和 单双</a></td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px;">
   <tr class="t_td_text" id="z_cl"><td>&nbsp;</td></tr>
</table>
<div class="blank10">&nbsp;</div>
<div id="look" style="display:none"></div>
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