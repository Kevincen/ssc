<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$ConfigModel = configModel("`g_kg_game_lock`, `g_game_1`, `g_game_2`, `g_game_3`, `g_game_4`, `g_game_5`, `g_game_6`, `g_game_7`, `g_game_8`");

if ($ConfigModel['g_kg_game_lock'] !=1)
exit(href('right.php'));

$g = $_GET['g'];
$onclick = 'onclick="getResult(this)" href="javascript:void(0)" ';
$getResult = 'class="nv_a" '.$onclick;


//获取当前盘口
$name = base64_decode($_COOKIE['g_user']);
$db=new DB();
$sql = "SELECT g_panlu,g_panlus FROM g_user where g_name='$name' LIMIT 1";
$result = $db->query($sql, 1);

$pan = explode (',', $result[0]['g_panlus']); 
 
 
 //$abc = $_GET['abc'];
//if($abc==null) $abc=$pan[0];
//$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
//$result1 = $db->query($sql, 2);

switch ($g) {
	case 'g1':
		if ($ConfigModel['g_game_1'] !=1)exit(href('right.php'));
		$types = '第一球';
		$aHtml = '<a '.$getResult.'>第1球</a>';
		break;
	case 'g2':
		if ($ConfigModel['g_game_2'] !=1)exit(href('right.php'));
		$types = '第二球';
		$aHtml = '<a '.$getResult.'>第2球</a>';
		break;
	case 'g3':
		if ($ConfigModel['g_game_3'] !=1)exit(href('right.php'));
		$types = '第三球';
		$aHtml = '<a '.$getResult.'>第3球</a>';
		break;
	case 'g4':
		if ($ConfigModel['g_game_4'] !=1)exit(href('right.php'));
		$types = '第四球';
		$aHtml = '<a '.$getResult.'>第4球</a>';
		break;
	case 'g5':
		if ($ConfigModel['g_game_5'] !=1)exit(href('right.php'));
		$types = '第五球';
		$aHtml = '<a '.$getResult.'>第5球</a>';
		break;
	case 'g6':
		if ($ConfigModel['g_game_6'] !=1)exit(href('right.php'));
		$types = '第六球';
		$aHtml = '<a '.$getResult.'>第6球</a>';
		break;
	case 'g7':
		if ($ConfigModel['g_game_7'] !=1)exit(href('right.php'));
		$types = '第七球';
		$aHtml = '<a '.$getResult.'>第7球</a>';
		break;
	case 'g8':
		if ($ConfigModel['g_game_8'] !=1)exit(href('right.php'));
		$types = '第八球';
		$aHtml = '<a '.$getResult.'>第8球</a>';
		break;
	default:exit;
}
?>
<?php include_once 'inc/top.php';?>
<table class="ths" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px">
    <tr height="24">
        <td class="bolds wanfa">广东快乐十分 <span style="color:#0033FF; font-weight:bold; margin-left:10px;" id="tys"><?=$types?></span></td>
        <td align="left" class="bolds" style="color:#FF0000">
        	<div id="row1" style="FONT-FAMILY: Arial; color: red;"> <span>今天输赢：</span></div>
            <div id="row2"><span id="sy" style="font-size:14px;position:relative; top:-2px">0</span></div>
        </td>
        <td  class="bolds klsfhm" align="right" colspan="2">
            <span id="n" style="line-height:25px;"></span>期开奖<div id="a" class="nc1">&nbsp;</div><div id="b">&nbsp;</div><div id="c">&nbsp;</div><div id="d">&nbsp;</div><div id="e">&nbsp;</div><div id="f">&nbsp;</div><div id="g">&nbsp;</div><div id="h">&nbsp;</div>
        </td>
    </tr>
    <tr height="25">
        <td width="25%"><span id="o" style="color:#009900; font-weight:bold;top:1px"></span>期</td>
        <td width="29%">距离封盘：<span style="font-size:104%" id="endTime">00:00</span></td>
      	<td width="25%">距离开奖：<span style="color:red;font-size:104%" id="endTimes">00:00</span></td>
        <td width="21%" align="right"><span id="endTimea"></span>秒</td>
    </tr>
</table>

<input type="hidden" id="mix" value="<?php echo$ConfigModel['g_mix_money']?>"><div id="look" style="display:none"></div>
<form id="dp" action="" method="post" target="leftFrame">
<table class="ths" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td><span style="float:left">投注类型：</span><a href="#this" class="intype_normal" id="kuijie">快捷</a><a href="#this" class="intype_hover" id="yiban">一般</a></td>
    </tr>
</table> 
<input type="hidden" name="actions" value="fn1" />
<input type="hidden" name="gtypes" value="1" />
<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:5px;">
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
    	<td class="caption_1"><div class="No_gd1"></div></td>
        <td class="o" id="h1"></td>
        <td class="tt" id="t1"></td>
        <td class="caption_1"><div class="No_gd6"></div></td>
        <td class="o" id="h6"></td>
        <td class="tt" id="t6"></td>
        <td class="caption_1"><div class="No_gd11"></div></td>
        <td class="o" id="h11"></td>
        <td class="tt" id="t11"></td>
        <td class="caption_1"><div class="No_gd16"></div></td>
        <td class="o" id="h16"></td>
        <td class="tt" id="t16"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="caption_1" ><div class="No_gd2"></div></td>
        <td class="o" id="h2"></td>
        <td class="tt" id="t2"></td>
        <td class="caption_1"><div class="No_gd7"></div></td>
        <td class="o" id="h7"></td>
        <td class="tt" id="t7"></td>
        <td class="caption_1"><div class="No_gd12"></div></td>
        <td class="o" id="h12"></td>
        <td class="tt" id="t12"></td>
        <td class="caption_1"><div class="No_gd17"></div></td>
        <td class="o" id="h17"></td>
        <td class="tt" id="t17"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="caption_1"  ><div class="No_gd3"></div></td>
        <td class="o" id="h3"></td>
        <td class="tt" id="t3"></td>
        <td class="caption_1"><div class="No_gd8"></div></td>
        <td class="o" id="h8"></td>
        <td class="tt" id="t8"></td>
        <td class="caption_1"><div class="No_gd13"></div></td>
        <td class="o" id="h13"></td>
        <td class="tt" id="t13"></td>
        <td class="caption_1"><div class="No_gd18"></div></td>
        <td class="o" id="h18"></td>
        <td class="tt" id="t18"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="caption_1" ><div class="No_gd4"></div></td>
        <td class="o" id="h4"></td>
        <td class="tt" id="t4"></td>
        <td class="caption_1"><div class="No_gd9"></div></td>
        <td class="o" id="h9"></td>
        <td class="tt" id="t9"></td>
        <td class="caption_1"><div class="No_gd14"></div></td>
        <td class="o" id="h14"></td>
        <td class="tt" id="t14"></td>
        <td class="caption_1"><div class="No_gd19"></div></td>
        <td class="o" id="h19"></td>
        <td class="tt" id="t19"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="caption_1" ><div class="No_gd5"></div></td>
        <td class="o" id="h5"></td>
        <td class="tt" id="t5"></td>
        <td class="caption_1"><div class="No_gd10"></div></td>
        <td class="o" id="h10"></td>
        <td class="tt" id="t10"></td>
        <td class="caption_1"><div class="No_gd15"></div></td>
        <td class="o" id="h15"></td>
        <td class="tt" id="t15"></td>
        <td class="caption_1"><div class="No_gd20"></div></td>
        <td class="o" id="h20"></td>
        <td class="tt" id="t20"></td>
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
    	<td class="caption_1">大</td>
        <td class="o" id="h21"></td>
        <td class="tt" id="t21"></td>
        <td class="caption_1">单</td>
      <td class="o" id="h23"></td>
        <td class="tt" id="t23"></td>
        <td class="caption_1">尾大</td>
        <td class="o" id="h25"></td>
        <td class="tt" id="t25"></td>
        <td class="caption_1">合数单</td>
    <td class="o" id="h27"></td>
        <td class="tt" id="t27"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="caption_1">小</td>
        <td class="o" id="h22"></td>
        <td class="tt" id="t22"></td>
        <td class="caption_1">双</td>
      <td class="o" id="h24"></td>
        <td class="tt" id="t24"></td>
        <td class="caption_1">尾小</td>
        <td class="o" id="h26"></td>
        <td class="tt" id="t26"></td>
        <td class="caption_1">合数双</td>
    <td class="o" id="h28"></td>
        <td class="tt" id="t28"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="caption_1">东</td>
      <td class="o" id="h29"></td>
        <td class="tt" id="t29"></td>
        <td class="caption_1">南</td>
        <td class="o" id="h30"></td>
        <td class="tt" id="t30"></td>
        <td class="caption_1">西</td>
        <td class="o" id="h31"></td>
        <td class="tt" id="t31"></td>
        <td class="caption_1">北</td>
        <td class="o" id="h32"></td>
        <td class="tt" id="t32"></td>
    </tr>
    <tr class="t_td_text">
    	<td class="caption_1">中</td>
        <td class="o" id="h33"></td>
        <td class="tt" id="t33"></td>
        <td class="caption_1">发</td>
      <td class="o" id="h34"></td>
        <td class="tt" id="t34"></td>
        <td class="caption_1">白</td>
        <td class="o" id="h35"></td>
        <td class="tt" id="t35"></td>
        <td class="caption_1">&nbsp;</td>
     	<td class="o">&nbsp;</td>
        <td class="tt">&nbsp;</td>
    </tr>
    <tr class="t_td_text">
    	<td class="caption_1">龙</td>
        <td class="o" id="">无</td>
        <td class="tt" id=""></td>
        <td class="caption_1">虎</td>
     	<td class="o" id="">无</td>
        <td class="tt" id=""></td>
        <td class="caption_1">&nbsp;</td>
     	<td class="o">&nbsp;</td>
        <td class="tt">&nbsp;</td>
        <td class="caption_1">&nbsp;</td>
     	<td class="o">&nbsp;</td>
        <td class="tt">&nbsp;</td>
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
                    	<span id="td_input_money"><font class="tz_title">金额</font>&nbsp;<input type="text"  id="AllMoney"  onkeydown="return IsNumeric()"  class="myAllMoney"  value=""  /></span>
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
	<tr class="t_list_caption td-w4" style="color:#0066FF">
    	<td style="width:8%;">今天</td>
    	<td>01</td>
        <td>02</td>
        <td>03</td>
        <td>04</td>
        <td>05</td>
        <td>06</td>
        <td>07</td>
        <td>08</td>
        <td>09</td>
        <td>10</td>
        <td>11</td>
        <td>12</td>
        <td>13</td>
        <td>14</td>
        <td>15</td>
        <td>16</td>
        <td>17</td>
        <td>18</td>
        <td>19</td>
        <td>20</td>
    </tr>
    <tr class="t_td_text" id="su">
    	<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr class="t_td_text" id="se">
    	<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
	<tr class="t_list_caption">
    	<td class="nv_ab" ><?php echo $aHtml?></td>
        <td><a class="nv" <?php echo $onclick?>>大小</a></td>
        <td><a class="nv" <?php echo $onclick?>>单双</a></td>
        <td><a class="nv" <?php echo $onclick?>>尾数大小</a></td>
        <td><a class="nv" <?php echo $onclick?>>合数单双</a></td>
        <td><a class="nv" <?php echo $onclick?>>方位</a></td>
        <td><a class="nv" <?php echo $onclick?>>中发白</a></td>
        <td><a class="nv" <?php echo $onclick?>>总和大小</a></td>
        <td><a class="nv" <?php echo $onclick?>>总和单双</a></td>
        <td><a class="nv" <?php echo $onclick?>>总和尾数大小</a></td>
        <td><a class="nv" <?php echo $onclick?>>龙虎</a></td>
    </tr>
</table>
<table class="wqs" border="0" cellpadding="0" cellspacing="0" style="margin-top:0px;">
   <tr class="t_td_text" id="z_cl"><td>&nbsp;</td></tr>
</table>
<div class="blank10">&nbsp;</div>
<?php include_once 'inc/cl_file.php';?>
</body>
</html>