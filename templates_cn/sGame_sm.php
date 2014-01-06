<?php
//快乐十分前台
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');

include_once ROOT_PATH.'templates_cn/offGame.php';

$ConfigModel = configModel("`g_kg_game_lock`, `g_mix_money`");
if ($ConfigModel['g_kg_game_lock'] !=1) exit(href('right.php'));
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$_SESSION['cq'] = false;
$_SESSION['nc'] = false;
$_SESSION['pk'] = false;
$_SESSION['gd'] = true;
$_SESSION['jsk3'] = false;


//获取当前盘口
$name = base64_decode($_COOKIE['g_user']);
$db=new DB();
$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
$result = $db->query($sql, 1);
$pan = explode (',', $result[0]['g_panlus']); 
$g = $_GET['g'];
$abc = $_GET['abc'];
if($abc==null) 
{
	$abc=$result[0]['g_panlu'];
}
else
{
	$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
	$result1 = $db->query($sql, 2);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广东快乐十分</title>
<link href="css/sGame.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
<script type="text/javascript" src="js/sc.js"></script>
    <script type="text/javascript" src="js/funcions.js"></script>
<script type="text/javascript" src="js/odds_sm.js"></script>
<script type="text/javascript">
var s = window.parent.frames.leftFrame.location.href.split('/');
	s = s[s.length-1];
	if (s !== "left.php?type=廣東快樂十分")
        window.parent.frames.leftFrame.location.href = "/templates_cn/left.php?type=廣東快樂十分";
function soundset(sod)
{
	if(sod.value=="on")
	{
		sod.src="images/soundoff.png";
		sod.value="off";
	}
	else
	{
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
        <td class="bolds wanfa">广东快乐十分 <span style="color:#0033FF; font-weight:bold; margin-left:10px;" id="tys">两面盘</span></td>
        <td align="left" class="bolds" style="color:#FF0000">
        	<div id="row1" style="FONT-FAMILY: Arial; color: red;"> <span>今天输赢：</span></div>
            <div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div>
        </td>
        <td  class="bolds klsfhm" align="right" colspan="2" >
            <span id="number" style="line-height:25px;"></span>期开奖<div id="a" class="nc1">&nbsp;</div><div id="b">&nbsp;</div><div id="c">&nbsp;</div><div id="d">&nbsp;</div><div id="e">&nbsp;</div><div id="f">&nbsp;</div><div id="g">&nbsp;</div><div id="h">&nbsp;</div>
        </td>
    </tr>
    <tr height="25">
        <td width="25%"><span id="o" style="color:#009900; font-weight:bold;top:1px"></span>期</td>
        <td width="29%">距离封盘：<span style="font-size:104%" id="endTime">00:00</span></td>
      	<td width="25%">距离开奖：<span style="color:red;font-size:104%" id="endTimes">00:00</span></td>
        <td width="21%" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>

<form id="dp" action="" method="post" target="leftFrame" onsubmit="">
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr>
        <td width="65" class="tz_title" valign="top">投注类型：</td>
        <td width="115"><a href="#this" class="intype_normal" id="kuijie">快捷</a><a href="#this" class="intype_hover" id="yiban">一般</a></td>
        <td align="left">
        	<table border="0" width="278" >
                <tr height="26">
					<td align="center">
                    	<span id="td_input_money"><font class="tz_title">金额</font>&nbsp;<input type="text"  id="AllMoney"  onkeydown="return IsNumeric()"  class="myAllMoney"  value=""  /></span>
                        <input type="button" id="submits1" class="inputs ti" value="确定" onclick="return submitforms();"/>
                        <input type="button" onclick="MyReset()" class="inputs ti" value="重置" />
                    </td>                   
                </tr>
            </table>
         </td>
    </tr>
</table>
<input type="hidden" name="type" value="ordinary" id="touzhu_type"/><!--判断是快捷投注还是一般投注-->
<input type="hidden" name="actions" value="fn3" />
<input type="hidden" name="gtypes" value="1" />
<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>" />
<div class="actiionn">

</div>
<table class="wqs" border="0" cellpadding="0" cellspacing="0">
	<colgroup>
        <col style="width:12.5%">
        <col style="width:12.5%">
        <col style="width:12.5%">
        <col style="width:12.5%">
        <col style="width:12.5%">
        <col style="width:12.5%">
        <col style="width:12.5%">
        <col style="width:12.5%">
        <col style="width:12.5%">
<!--        <col style="width:12.5%">
        <col style="width:12.5%">
        <col style="width:12.5%">-->
    </colgroup>
	<tr class="t_list_caption">
    	<td colspan="12">总和</td>
    </tr>
    <tr class="t_td_text" selected="false">
        <td class="caption_1">总和大</td>
        <td class="o" id="h1"></td>
        <td class="loads"></td>
        <td class="caption_1">总和单</td>
        <td class="o" id="h2"></td>
        <td class="loads"></td>
        <td class="caption_1">总和尾大</td>
        <td class="o" id="h5"></td>
        <td class="loads"></td>
<!--        <td class="caption_1" style="display: none">龙</td>
        <td class="o" id="h6" style="display: none"></td>
        <td class="loads" style="display: none"></td>-->
    </tr>
    <tr class="t_td_text" selected="false">
    	<td class="caption_1">总和小</td>
   	  	<td class="o" id="h3"></td>
    	<td class="loads"></td>
    	<td class="caption_1">总和双</td>
   	  	<td class="o" id="h4"></td>
    	<td class="loads"></td>
    	<td class="caption_1">总和尾小</td>
   	  	<td class="o" id="h7"></td>
    	<td class="loads"></td>
<!--    	<td class="caption_1" style="display: none">虎</td>
    	<td class="o" id="h8" style="display: none"></td>
    	<td class="loads" style="display: none"></td>-->
    </tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="Full_table">
	<tr>
		<td class="w25">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="3">第一球</td>
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">大</td>
                    <td class="o" id="ah21"></td>
                    <td class="loads"></td>                                       
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">小</td>
                    <td class="o" id="ah22"></td>
                    <td class="loads"></td>                                     
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">单</td>
                    <td class="o" id="ah23"></td>
                    <td class="loads"></td>                                       
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">双</td>
                    <td class="o" id="ah24"></td>
                    <td class="loads"></td>
                                          
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾大</td>
                    <td class="o" id="ah25"></td>
                    <td class="loads"></td>
                    
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾小</td>
                    <td class="o" id="ah26"></td>
                    <td class="loads"></td>
                                                
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数单</td>
                    <td class="o" id="ah27"></td>
                    <td class="loads"></td>
                                                 
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数双</td>
                    <td class="o" id="ah28"></td>
                    <td class="loads"></td>
                                               
                </tr>  
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">龙</td>
                    <td class="o" id="ah36"></td>
                    <td class="loads"></td>
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">虎</td>
                    <td class="o" id="ah37"></td>
                    <td class="loads"></td>
                </tr>  
                                                               
            
            </table>
        </td> 
        <td class="w25">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="3">第二球</td>
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">大</td>
                    <td class="o" id="bh21"></td>
                    <td class="loads"></td>                                 
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">小</td>
                    <td class="o" id="bh22"></td>
                    <td class="loads"></td>                          
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">单</td>
                    <td class="o" id="bh23"></td>
                    <td class="loads"></td>                                
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">双</td>

                    <td class="o" id="bh24"></td>
                    <td class="loads"></td>
                                               
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾大</td>
                    <td class="o" id="bh25"></td>
                    <td class="loads"></td>
                                                                                  
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾小</td>
                    <td class="o" id="bh26"></td>
                    <td class="loads"></td>
                                                     
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数单</td>
                    <td class="o" id="bh27"></td>
                    <td class="loads"></td>
                                                    
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数双</td>
                    <td class="o" id="bh28"></td>
                    <td class="loads"></td>
                                                  
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">龙</td>
                    <td class="o" id="bh36"></td>
                    <td class="loads"></td>
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">虎</td>
                    <td class="o" id="bh37"></td>
                    <td class="loads"></td>
                </tr>               
            </table>
        </td> 
        <td class="w25">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="3">第三球</td>
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">大</td>
                    <td class="o" id="ch21"></td>
                    <td class="loads"></td>                              
                </tr>   
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">小</td>
                    <td class="o" id="ch22"></td>
                    <td class="loads"></td>                           
                </tr>  
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">单</td>
                    <td class="o" id="ch23"></td>
                    <td class="loads"></td>                         
                </tr>  
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">双</td>
                    <td class="o" id="ch24"></td>
                    <td class="loads"></td>
                                                                
                </tr>  
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾大</td>
                    <td class="o" id="ch25"></td>
                    <td class="loads"></td>
                                                
                </tr>  
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾小</td>
                    <td class="o" id="ch26"></td>
                    <td class="loads"></td>
                                                 
                </tr>  
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数单</td>
                    <td class="o" id="ch27"></td>
                    <td class="loads"></td>
                                             
                </tr>  
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数双</td>
                    <td class="o" id="ch28"></td>
                    <td class="loads"></td>
                                                      
                </tr>   
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">龙</td>
                    <td class="o" id="ch36"></td>
                    <td class="loads"></td>
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">虎</td>
                    <td class="o" id="ch37"></td>
                    <td class="loads"></td>
                </tr>             
            </table>
        </td>  
        <td class="w25">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="3">第四球</td>
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">大</td>
                    <td class="o" id="dh21"></td>
                    <td class="loads"></td>               
                </tr>   
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">小</td>
                    <td class="o" id="dh22"></td>
                    <td class="loads"></td>             
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">单</td>
                    <td class="o" id="dh23"></td>
                    <td class="loads"></td>       
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">双</td>
                    <td class="o" id="dh24"></td>
                    <td class="loads"></td>               
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾大</td>
                    <td class="o" id="dh25"></td>
                    <td class="loads"></td>       
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾小</td>
                    <td class="o" id="dh26"></td>
                    <td class="loads"></td>              
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数单</td>
                    <td class="o" id="dh27"></td>
                    <td class="loads"></td>                   
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数双</td>
                    <td class="o" id="dh28"></td>
                    <td class="loads"></td>               
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">龙</td>
                    <td class="o" id="dh36"></td>
                    <td class="loads"></td>
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">虎</td>
                    <td class="o" id="dh37"></td>
                    <td class="loads"></td>
                </tr>              
            </table>        
        </td>        
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="Full_table">
	<tr>
		<td class="w25">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="3">第五球</td>
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">大</td>
                    <td class="o" id="eh21"></td>
                    <td class="loads"></td>
                                                   
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">小</td>
                    <td class="o" id="eh22"></td>
                    <td class="loads"></td>
                                             
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">单</td>
                    <td class="o" id="eh23"></td>
                    <td class="loads"></td>
                                                   
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">双</td>
                    <td class="o" id="eh24"></td>
                    <td class="loads"></td>                  
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾大</td>
                    <td class="o" id="eh25"></td>
                    <td class="loads"></td>
                    
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾小</td>
                    <td class="o" id="eh26"></td>
                    <td class="loads"></td>
                                                
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数单</td>
                    <td class="o" id="eh27"></td>
                    <td class="loads"></td>
                                                 
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数双</td>
                    <td class="o" id="eh28"></td>
                    <td class="loads"></td>
                                               
                </tr>
                <tr class="t_td_text" style="display: none">
                    <td class="caption_1">龙</td>
                    <td class="o" id="eh36"></td>
                    <td class="loads"></td>
                </tr>
                <tr class="t_td_text" style="display: none">
                    <td class="caption_1">虎</td>
                    <td class="o" id="eh37"></td>
                    <td class="loads"></td>
                </tr>
            </table>
        </td> 
        <td class="w25">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="3">第六球</td>
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">大</td>
                    <td class="o" id="fh21"></td>
                    <td class="loads"></td>
                                                  
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">小</td>
                    <td class="o" id="fh22"></td>
                    <td class="loads"></td>
                                          
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">单</td>
                    <td class="o" id="fh23"></td>
                    <td class="loads"></td>
                                               
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">双</td>
                    <td class="o" id="fh24"></td>
                    <td class="loads"></td>
                    
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾大</td>
                    <td class="o" id="fh25"></td>
                    <td class="loads"></td>
                                                                                  
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾小</td>
                    <td class="o" id="fh26"></td>
                    <td class="loads"></td>
                                                     
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数单</td>
                    <td class="o" id="fh27"></td>
                    <td class="loads"></td>
                                                    
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数双</td>
                    <td class="o" id="fh28"></td>
                    <td class="loads"></td>
                                                  
                </tr>
                <tr class="t_td_text" style="display:none">
                    <td class="caption_1">龙</td>
                    <td class="o" id="fh36"></td>
                    <td class="loads"></td>
                </tr>
                <tr class="t_td_text" style="display: none">
                    <td class="caption_1">虎</td>
                    <td class="o" id="fh37"></td>
                    <td class="loads"></td>
                </tr>
            </table>
        </td> 
        <td class="w25">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="3">第七球</td>
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">大</td>
                    <td class="o" id="gh21"></td>
                    <td class="loads"></td>
                                              
                </tr>   
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">小</td>
                    <td class="o" id="gh22"></td>
                    <td class="loads"></td>
                                      
                </tr>  
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">单</td>
                    <td class="o" id="gh23"></td>
                    <td class="loads"></td>
                                       
                </tr>  
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">双</td>
                    <td class="o" id="gh24"></td>
                    <td class="loads"></td>
                    
                                                                
                </tr>  
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾大</td>
                    <td class="o" id="gh25"></td>
                    <td class="loads"></td>
                                                
                </tr>  
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾小</td>
                    <td class="o" id="gh26"></td>
                    <td class="loads"></td>
                                                 
                </tr>  
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数单</td>
                    <td class="o" id="gh27"></td>
                    <td class="loads"></td>
                                             
                </tr>  
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数双</td>
                    <td class="o" id="gh28"></td>
                    <td class="loads"></td>
                                                      
                </tr>
                <tr class="t_td_text" style="display:none">
                    <td class="caption_1">龙</td>
                    <td class="o" id="gh36"></td>
                    <td class="loads"></td>
                </tr>
                <tr class="t_td_text" style="display: none">
                    <td class="caption_1">虎</td>
                    <td class="o" id="gh37"></td>
                    <td class="loads"></td>
                </tr>
            </table>
        </td>  
        <td class="w25">
        	<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="width:99%;">
            	<colgroup>
                    <col style="width:33.33%">
                    <col style="width:33.33%">
                    <col style="width:33.33%">                    
                </colgroup>
                <tr class="t_list_caption">
                    <td colspan="3">第八球</td>
                </tr>
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">大</td>
                    <td class="o" id="hh21"></td>
                    <td class="loads"></td>             
                </tr>   
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">小</td>
                    <td class="o" id="hh22"></td>
                    <td class="loads"></td>             
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">单</td>
                    <td class="o" id="hh23"></td>
                    <td class="loads"></td>          
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">双</td>
                    <td class="o" id="hh24"></td>
                    <td class="loads"></td>
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾大</td>
                    <td class="o" id="hh25"></td>
                    <td class="loads"></td>       
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">尾小</td>
                    <td class="o" id="hh26"></td>
                    <td class="loads"></td>              
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数单</td>
                    <td class="o" id="hh27"></td>
                    <td class="loads"></td>                   
                </tr> 
                <tr class="t_td_text" selected="false">
                    <td class="caption_1">合数双</td>
                    <td class="o" id="hh28"></td>
                    <td class="loads"></td>               
                </tr>
                <tr class="t_td_text" style="display:none">
                    <td class="caption_1">龙</td>
                    <td class="o" id="hh36"></td>
                    <td class="loads"></td>
                </tr>
                <tr class="t_td_text" style="display:none">
                    <td class="caption_1">虎</td>
                    <td class="o" id="hh37"></td>
                    <td class="loads"></td>
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
                        <input type="button" id="submits" class="inputs ti" value="确定" onclick="return submitforms();" />
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
        <td class="nv_ab"><a class="nv_a" <?php echo $onclick?>>总和大小</a></td>
        <td><a class="nv" <?php echo $onclick?>>总和单双</a></td>
        <td><a class="nv" <?php echo $onclick?>>总和尾数大小</a></td>
        <!--<td class="nv_ab" ><a class="nv_a" <?php echo $onclick?>>龙虎</a></td>-->
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px;">
   <tr class="t_td_text" id="z_cl"><td>&nbsp;</td></tr>
</table>
<div class="blank10">&nbsp;</div>
<div id="look" style="display:none"></div>
<?php include './popup.html'?>
<?php include_once 'inc/cl_file.php';?>
</body>
</html>