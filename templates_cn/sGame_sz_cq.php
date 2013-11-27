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
$_SESSION['nc'] = false;
$_SESSION['jsk3'] = false;
$_SESSION['gd'] = false;
$_SESSION['pk'] = false;
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
<script type="text/javascript" src="./js/odds_sz_cq.js"></script>
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
div#row1 { float: left;}
div#row2 {}
</style>
</head>
<body class="<?php echo $_COOKIE['g_skin']; ?>">
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr height="24">
        <td class="bolds wanfa">重庆时时彩 <span style="color:#0033FF; font-weight:bold; margin-left:10px;" id="tys">整合盘</span></td>
        <td align="left" class="bolds" style="color:#FF0000">
        	<div id="row1" style="FONT-FAMILY: Arial; color: red;"> <span>今天输赢：</span></div>
            <div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div>
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
<form id="dp" action="" method="post" target="leftFrame" onsubmit="return submitforms()">
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
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


<table border="0" cellpadding="0" cellspacing="0" class="Full_table">
	<tr>
		<td class="w17">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:66.66%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="2">第一球</td>                    
                </tr>
				<tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td>
                    	<span class="o" id="ah11">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah11">&nbsp;</span>
                    </td>                    
                </tr>  
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td>
                    	<span class="o" id="ah12">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah12">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td>
                    	<span class="o" id="ah13">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah13">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td>
                    	<span class="o" id="ah14">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah14">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq0">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ah1">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah1">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq1">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ah2">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah2">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                     <td class="caption_1"><span class="No_cq2">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ah3">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah3">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq3">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ah4">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah4">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq4">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ah5">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah5">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq5">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ah6">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah6">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq6">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ah7">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah7">&nbsp;</span>
                    </td>                    
                </tr>  
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq7">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ah8">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah8">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq8">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ah9">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah9">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq9">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ah10">&nbsp;</span><br/>
                        <span class="loads" id="Ball_1mah10">&nbsp;</span>
                    </td>                    
                </tr>                                                           
            </table>
        </td>
        <td class="w17">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:66.66%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="2">第二球</td>                    
                </tr>
				<tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td>
                    	<span class="o" id="bh11">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh11">&nbsp;</span>
                    </td>                    
                </tr>  
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td>
                    	<span class="o" id="bh12">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh12">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td>
                    	<span class="o" id="bh13">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh13">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td>
                    	<span class="o" id="bh14">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh14">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq0">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="bh1">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh1">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq1">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="bh2">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh2">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                     <td class="caption_1"><span class="No_cq2">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="bh3">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh3">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq3">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="bh4">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh4">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq4">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="bh5">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh5">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq5">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="bh6">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh6">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq6">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="bh7">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh7">&nbsp;</span>
                    </td>                    
                </tr>  
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq7">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="bh8">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh8">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq8">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="bh9">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh9">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq9">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="bh10">&nbsp;</span><br/>
                        <span class="loads" id="Ball_2mbh10">&nbsp;</span>
                    </td>                    
                </tr>                                                           
            </table>
        </td>
        <td class="w17">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:66.66%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="2">第三球</td>                    
                </tr>
				<tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td>
                    	<span class="o" id="ch11">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch11">&nbsp;</span>
                    </td>                    
                </tr>  
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td>
                    	<span class="o" id="ch12">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch12">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td>
                    	<span class="o" id="ch13">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch13">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td>
                    	<span class="o" id="ch14">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch14">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq0">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ch1">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch1">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq1">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ch2">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch2">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                     <td class="caption_1"><span class="No_cq2">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ch3">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch3">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq3">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ch4">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch4">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq4">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ch5">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch5">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq5">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ch6">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch6">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq6">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ch7">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch7">&nbsp;</span>
                    </td>                    
                </tr>  
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq7">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ch8">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch8">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq8">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ch9">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch9">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq9">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="ch10">&nbsp;</span><br/>
                        <span class="loads" id="Ball_3mch10">&nbsp;</span>
                    </td>                    
                </tr>                                                           
            </table>
        </td>
        <td class="w17">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:66.66%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="2">第四球</td>                    
                </tr>
				<tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td>
                    	<span class="o" id="dh11">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh11">&nbsp;</span>
                    </td>                    
                </tr>  
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td>
                    	<span class="o" id="dh12">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh12">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td>
                    	<span class="o" id="dh13">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh13">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td>
                    	<span class="o" id="dh14">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh14">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq0">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="dh1">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh1">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq1">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="dh2">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh2">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                     <td class="caption_1"><span class="No_cq2">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="dh3">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh3">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq3">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="dh4">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh4">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq4">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="dh5">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh5">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq5">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="dh6">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh6">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq6">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="dh7">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh7">&nbsp;</span>
                    </td>                    
                </tr>  
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq7">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="dh8">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh8">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq8">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="dh9">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh9">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq9">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="dh10">&nbsp;</span><br/>
                        <span class="loads" id="Ball_4mdh10">&nbsp;</span>
                    </td>                    
                </tr>                                                           
            </table>
        </td>
        <td class="w17">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:66.66%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="2">第五球</td>                    
                </tr>
				<tr class="t_td_text">
                    <td class="caption_1">大</td>
                    <td>
                    	<span class="o" id="eh11">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh11">&nbsp;</span>
                    </td>                    
                </tr>  
                <tr class="t_td_text">
                    <td class="caption_1">小</td>
                    <td>
                    	<span class="o" id="eh12">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh12">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">单</td>
                    <td>
                    	<span class="o" id="eh13">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh13">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">双</td>
                    <td>
                    	<span class="o" id="eh14">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh14">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq0">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="eh1">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh1">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq1">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="eh2">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh2">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                     <td class="caption_1"><span class="No_cq2">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="eh3">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh3">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq3">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="eh4">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh4">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq4">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="eh5">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh5">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq5">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="eh6">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh6">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq6">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="eh7">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh7">&nbsp;</span>
                    </td>                    
                </tr>  
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq7">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="eh8">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh8">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq8">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="eh9">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh9">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1"><span class="No_cq9">&nbsp;</span></td>
                    <td>
                    	<span class="o" id="eh10">&nbsp;</span><br/>
                        <span class="loads" id="Ball_5meh10">&nbsp;</span>
                    </td>                    
                </tr>                                                           
            </table>
        </td>
        <td class="w17" valign="top">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:66.66%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="2">总和-龙虎和</td>                    
                </tr>
				<tr class="t_td_text">
                    <td class="caption_1">总和 大</td>
                    <td>
                    	<span class="o" id="fh1">&nbsp;</span><br/>
                        <span class="loads" id="Ball_6mfh1">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1">总和 小</td>
                    <td>
                    	<span class="o" id="fh2">&nbsp;</span><br/>
                        <span class="loads" id="Ball_6mfh2">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1">总和 单</td>
                    <td>
                    	<span class="o" id="fh3">&nbsp;</span><br/>
                        <span class="loads" id="Ball_6mfh3">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1">总和 双</td>
                    <td>
                    	<span class="o" id="fh4">&nbsp;</span><br/>
                        <span class="loads" id="Ball_6mfh4">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1">龙</td>
                    <td>
                    	<span class="o" id="fh5">&nbsp;</span><br/>
                        <span class="loads" id="Ball_6mfh5">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1">虎</td>
                    <td>
                    	<span class="o" id="fh6">&nbsp;</span><br/>
                        <span class="loads" id="Ball_6mfh6">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1">和</td>
                    <td>
                    	<span class="o" id="fh7">&nbsp;</span><br/>
                        <span class="loads" id="Ball_6mfh7">&nbsp;</span>
                    </td>                    
                </tr>  
            </table>
            <table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%; margin-top:5px;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">              
                </colgroup>
                <tr class="t_list_caption">
                    <td class="nv_ab"><a class="nv_a" id="qs" onclick="qs()" href="#this">前三</a></td>
					<td class="nv_a"><a class="nv" id="zs" onclick="zs()" href="#this">中三</a></td>
					<td class="nv_a"><a class="nv" id="hs" onclick="hs()" href="#this">后三</a></td> 	 	                 
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">豹子</td>
                    <td colspan="2">
                    	<span class="o" id="gh1">&nbsp;</span><br/>
                        <span class="loads" id="Ball_7mgh1">&nbsp;</span>
                    </td>                    
                </tr> 
                <tr class="t_td_text">
                    <td class="caption_1">顺子</td>
                    <td colspan="2">
                    	<span class="o" id="gh2">&nbsp;</span><br/>
                        <span class="loads" id="Ball_7mgh2">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">对子</td>
                    <td colspan="2">
                    	<span class="o" id="gh3">&nbsp;</span><br/>
                        <span class="loads" id="Ball_7mgh3">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">半顺</td>
                    <td colspan="2">
                    	<span class="o" id="gh4">&nbsp;</span><br/>
                        <span class="loads" id="Ball_7mgh4">&nbsp;</span>
                    </td>                    
                </tr>
                <tr class="t_td_text">
                    <td class="caption_1">杂六</td>
                    <td colspan="2">
                    	<span class="o" id="gh5">&nbsp;</span><br/>
                        <span class="loads" id="Ball_7mgh5">&nbsp;</span>
                    </td>                    
                </tr>
            </table>
            <script language="javascript">
			function qs(){
				$('td[title=gh]').each(function(){
					var id = $(this).attr('id');
					if(id.indexOf('Ball_')>=0){
						id=id.replace('Ball_8mh','Ball_7mg').replace('Ball_9mi','Ball_7mg');
						$(this).find('input').attr('name',id);
					}else{
						id=id.replace('hh','gh').replace('ih','gh');
						var href = $(this).find('a').attr('href');
						href = href.replace('hid=hh','hid=gh').replace('hid=ih','hid=gh').replace('Ball_8','Ball_7').replace('Ball_9','Ball_7');
						$(this).find('a').attr('href',href);
					}
					$(this).attr('id',id);
				})
				$('#qs').removeClass("nv").addClass("nv_a"); 
				$("#zs").addClass("nv").removeClass("nv_a");
				$("#hs").addClass("nv").removeClass("nv_a");
				
				$('#qs').parent().addClass("nv_ab");
				$('#zs').parent().removeClass("nv_ab");
				$('#hs').parent().removeClass("nv_ab");
			}
			function zs(){
				$('td[title=gh]').each(function(){
					var id = $(this).attr('id');
					if(id.indexOf('Ball_')>=0){
						id=id.replace('Ball_7mg','Ball_8mh').replace('Ball_9mi','Ball_8mh');
						$(this).find('input').attr('name',id);
					}else{
						id=id.replace('gh','hh').replace('ih','gh');
						var href = $(this).find('a').attr('href');
						href = href.replace('hid=gh','hid=hh').replace('hid=ih','hid=hh').replace('Ball_9','Ball_8').replace('Ball_7','Ball_8');
						$(this).find('a').attr('href',href);
					}
					$(this).attr('id',id);
				})
				
				$("#qs").addClass("nv").removeClass("nv_a");
				$('#zs').removeClass("nv").addClass("nv_a"); 
				$("#hs").addClass("nv").removeClass("nv_a");
				
				$('#qs').parent().removeClass("nv_ab");
				$('#zs').parent().addClass("nv_ab"); 
				$('#hs').parent().removeClass("nv_ab");
			}
			function hs(){
				$('td[title=gh]').each(function(){
					var id = $(this).attr('id');
					if(id.indexOf('Ball_')>=0){
						id=id.replace('Ball_7mg','Ball_9mi').replace('Ball_8mh','Ball_9mi');
						$(this).find('input').attr('name',id);
					}else{
						id=id.replace('gh','ih').replace('hh','ih');
						var href = $(this).find('a').attr('href');
						href = href.replace('hid=gh','hid=ih').replace('hid=hh','hid=ih').replace('Ball_7','Ball_9').replace('Ball_8','Ball_9');
						$(this).find('a').attr('href',href);
					}
					$(this).attr('id',id);
				})
				$("#qs").addClass("nv").removeClass("nv_a");
				$('#hs').removeClass("nv").addClass("nv_a"); 
				$("#zs").addClass("nv").removeClass("nv_a");
				
				$('#qs').parent().removeClass("nv_ab");
				$('#hs').parent().addClass("nv_ab"); 
				$('#zs').parent().removeClass("nv_ab");
			}
			</script>
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
<table class="wqs" border="0" cellpadding="0" cellspacing="0"  style="margin-top:10px;">
	<tr class="t_list_caption" style="color:#0066FF">
    	<td width="10%">0</td>
    	<td width="10%">1</td>
        <td width="10%">2</td>
        <td width="10%">3</td>
        <td width="10%">4</td>
        <td width="10%">5</td>
        <td width="10%">6</td>
        <td width="10%">7</td>
        <td width="10%">8</td>
        <td>9</td>
    </tr>
    <tr class="t_td_text" id="su">
    	<td colspan="10">&nbsp;</td>
    </tr>
</table>

<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px">
	<tr class="t_list_caption">
        <td><a class="nv_a" <?php echo $onclick?>>第1球</a></td>
        <td><a class="nv" <?php echo $onclick?>>第2球</a></td>
        <td><a class="nv" <?php echo $onclick?>>第3球</a></td>
        <td><a class="nv" <?php echo $onclick?>>第4球</a></td>
        <td><a class="nv" <?php echo $onclick?>>第5球</a></td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px;">
   <tr class="t_td_text" id="z_cl"><td>&nbsp;</td></tr>
</table>
<div class="blank10">&nbsp;</div>
<div id="look" style="display:none"></div>
<?php 
	include_once 'inc/cl_filesz.php';?>
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